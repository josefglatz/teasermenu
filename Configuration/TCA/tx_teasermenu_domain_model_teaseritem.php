<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem',
        'label' => 'type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'type' => 'type',
        'sortby' => 'sorting',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'type,target_page,custom_label,custom_image,layout',
        'iconfile' => 'EXT:teasermenu/Resources/Public/Icons/tx_teasermenu_domain_model_teaseritem.gif',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, target_page, custom_label, custom_image, layout',
    ],
    'types' => [
        // Default
        '0' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, type, target_page, custom_label, custom_image, hidden, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
        // Spacer
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, type, layout, custom_image, hidden, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'parent' => [
            'label' => 'parent',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple',
                    ],
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_teasermenu_domain_model_teaseritem',
                'foreign_table_where' => 'AND tx_teasermenu_domain_model_teaseritem.pid=###CURRENT_PID### AND tx_teasermenu_domain_model_teaseritem.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled',
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
        ],
        'type' => [
            'exclude' => false,
            'label' => 'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem.type.default',
                        0,
                    ],
                    [
                        'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem.type.spacer',
                        1,
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required',
            ],
        ],
        'target_page' => [
            'exclude' => false,
            'label' => 'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem.target_page',
            'config' => [
                'type' => 'input',
                'size' => 6,
                'max' => 255,
                'eval' => 'trim,required',
                'wizards' => [
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'actions-wizard-link',
                        'blindLinkOptions' => 'file,mail,spec,url',
                        'module' => [
                            'name' => 'wizard_link',
                        ],
                        'JSopenParams' => 'height=600,width=800,status=0,menubar=0,scrollbars=1',
                        'params' => [
                            'blindLinkOptions' => 'folder,file,mail,url',
                        ],
                    ],
                ],
                'softref' => 'typolink',
            ],
        ],
        'custom_label' => [
            'exclude' => true,
            'label' => 'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem.custom_label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'custom_image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem.custom_image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'custom_image',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                    ],
                    'foreign_types' => [
                        '0' => [
                            'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette',
                        ],
                    ],
                    'maxitems' => 1,
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'layout' => [
            'exclude' => true,
            'label' => 'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem.layout',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'LLL:EXT:teasermenu/Resources/Private/Language/locallang_db.xlf:tx_teasermenu_domain_model_teaseritem.layout.select',
                        0,
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ],
        ],
    ],
];
