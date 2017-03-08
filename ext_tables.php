<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Teaser Menu');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_teasermenu_domain_model_teaseritem', 'EXT:teasermenu/Resources/Private/Language/locallang_csh_tx_teasermenu_domain_model_teaseritem.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_teasermenu_domain_model_teaseritem');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            '<INCLUDE_TYPOSCRIPT: source="DIR: EXT:teasermenu/Configuration/TSConfig/Page" extensions="tsc">'
        );

    },
    $_EXTKEY
);
