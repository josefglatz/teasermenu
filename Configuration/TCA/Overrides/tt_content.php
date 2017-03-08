<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function ($extKey) {
        $languageFileCePrefix = 'LLL:EXT:teasermenu/Resources/Private/Language/locallang.xlf:';

        /**
         * Add CE: teasermenu
         */
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
            'tt_content',
            'CType',
            [
                $languageFileCePrefix . 'tx_teasermenu.ncew.title',
                'teasermenu',
                'content-special-menu'
            ],
            'menu',
            'after'
        );


        // Add CType configuration(s)
        $tca = [
            'types' => [
                'teasermenu' => [
                    'showitem' => '
                            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                            header,
                            teasermenuitems,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                            --palette--;;language,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                            --palette--;;hidden,
                            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                            rowDescription,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
                    ',
                    'columnsOverrides' => [

                    ],
                ],
            ],
        ];
        $GLOBALS['TCA']['tt_content'] = array_replace_recursive($GLOBALS['TCA']['tt_content'], $tca);

        // Add additional column configuration(s)
        $additionalColumns = [
            'teasermenuitems' => [
                'label' => $languageFileCePrefix . 'tt_content.fields.teasermenuitems',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_teasermenu_domain_model_teaseritem',
                    'foreign_field' => 'parent',
                    'appearance' => [
                        'useSortable' => true,
                        'showSynchronizationLink' => true,
                        'showAllLocalizationLink' => true,
                        'showPossibleLocalizationRecords' => true,
                        'showRemovedLocalizationRecords' => false,
                        'expandSingle' => true,
                        'enabledControls' => [
                            'localize' => true,
                        ],
                    ],
                    'behaviour' => [
                        'localizationMode' => 'select',
                        'mode' => 'select',
                        'localizeChildrenAtParentLocalization' => true,
                    ],
                ],
            ],
        ];
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);

    },
    'theme'
);
