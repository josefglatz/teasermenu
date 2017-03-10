<?php
namespace JosefGlatz\Teasermenu\ViewHelpers;

use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Frontend\Resource\FileCollector;

/**
 * Class FalViewHelper
 *
 * = Example =
 *
 * <code title="register namespace in fluid first">
 * xmlns:theme="http://typo3.org/ns/JosefGlatz/Theme/ViewHelpers"
 * </code>
 *
 * <code title="default notation">
 * <theme:fal table="pages" field="image" id="{row.uid}" as="references">
 * <f:if condition="{references}">
 *  <f:then>
 *    <f:media file="{references.0}" class="foobar" title="{references.0.propertiesOfFileReference.title}"/>
 *  </f:then>
 *  <f:else>
 *    <img class="dummy" src="https://dummyimage.com/600x600/444/fff" alt="">
 *  </f:else>
 * </f:if>
 * </theme:fal>
 * </code>
 *
 */
class RecordViewHelper extends AbstractViewHelper
{

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @param string $table
     * @param string $id
     * @param string $as
     */
    public function render(string $table = 'pages', string $id, string $as = 'targetPage')
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

        $this->templateVariableContainer->add($as, $row);
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        // @TODO: Only for TYPO3 < 8.x
        return $GLOBALS['TYPO3_DB'];
    }
}
