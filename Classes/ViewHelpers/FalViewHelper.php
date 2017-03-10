<?php
namespace JosefGlatz\Teasermenu\ViewHelpers;

use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Frontend\Resource\FileCollector;

/**
 * Class FalViewHelper
 *
 * = Example =
 *
 * <code title="register namespace in fluid first">
 * xmlns:tm="http://typo3.org/ns/JosefGlatz/Teasermenu/ViewHelpers"
 * </code>
 *
 * <code title="default notation">
 * <tm:fal table="pages" field="image" id="{targetPage.uid}" as="targetPageImages">
 * <f:if condition="{targetPageImages}">
 *  <f:then>
 *    <f:media file="{targetPageImages.0}" class="foobar" title="{targetPageImages.0.propertiesOfFileReference.title}"/>
 *  </f:then>
 *  <f:else>
 *    <img class="dummy" src="https://dummyimage.com/600x600/444/fff" alt="">
 *  </f:else>
 * </f:if>
 * </tm:fal>
 * </code>
 *
 */
class FalViewHelper extends AbstractViewHelper
{
    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * @param string $table
     * @param string $field
     * @param string $id
     * @param string $as
     *
     * @return string
     */
    public function render(string $table, string $field, string $id, string $as = 'references')
    {
        if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 8005000) {
            // create query builder object
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
                ->getQueryBuilderForTable($table);
            // query
            $row = $queryBuilder
                ->select('*')
                ->from($table)
                ->where('uid=' . (int)$id)
                ->execute()
                ->fetch();
        } else {
            $row = $this->getDatabaseConnection()->exec_SELECTgetSingleRow('*', $table, 'uid=' . (int)$id);
        }
        if (!$row) {
            return '';
        }
        $fileCollector = GeneralUtility::makeInstance(FileCollector::class);
        $fileCollector->addFilesFromRelation($table, $field, $row);
        $this->templateVariableContainer->add($as, $fileCollector->getFiles());
        $output = $this->renderChildren();
        $this->templateVariableContainer->remove($as);

        return $output;
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        // @TODO: Doctrine dbal rewrite
        return $GLOBALS['TYPO3_DB'];
    }
}
