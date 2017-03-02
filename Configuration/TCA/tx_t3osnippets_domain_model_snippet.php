<?php
defined('TYPO3_MODE') or die();

$llGeneral = 'LLL:EXT:lang/locallang_general.xlf:';
$ll = 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => $TCA['tx_t3osnippets_domain_model_snippet']['ctrl'],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, category, description, author, code, tags',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, category, description, author, code, tags,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => $llGeneral . 'LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        $llGeneral . 'LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => $llGeneral . 'LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_t3osnippets_domain_model_snippet',
                'foreign_table_where' => 'AND tx_t3osnippets_domain_model_snippet.pid=###CURRENT_PID### AND tx_t3osnippets_domain_model_snippet.sys_language_uid IN (-1,0)',
                'showIconTable' => false
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => ''
            ]
        ],
        't3ver_label' => [
            'label' => $llGeneral . 'LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => $llGeneral . 'LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'cruser_id' => [
            'label' => 'cruser_id',
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'pid' => [
            'label' => 'pid',
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'crdate' => [
            'label' => 'crdate',
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'sorting' => [
            'label' => 'sorting',
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => $llGeneral . 'LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 16,
                'max' => 20,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => $llGeneral . 'LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 16,
                'max' => 20,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'fe_group' => [
            'exclude' => 1,
            'label' => $llGeneral . 'LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
                    [
                        $llGeneral . 'LGL.hide_at_login',
                        -1,
                    ],
                    [
                        $llGeneral . 'LGL.any_login',
                        -2,
                    ],
                    [
                        $llGeneral . 'LGL.usergroups',
                        '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
                'foreign_table_where' => 'ORDER BY fe_groups.title',
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label' => $ll . 'tx_t3osnippets_domain_model_snippet.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'category' => [
            'exclude' => 0,
            'label' => $ll . 'tx_t3osnippets_domain_model_snippet.category',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_t3osnippets_domain_model_category',
                'foreign_table_where' => 'ORDER BY tx_t3osnippets_domain_model_category.title',
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'int,required'
            ],
        ],
        'description' => [
            'exclude' => 0,
            'label' => $ll . 'tx_t3osnippets_domain_model_snippet.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim,required',
                'wizards' => [
                    'RTE' => [
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'type' => 'script',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
                        'icon' => 'actions-wizard-rte',
                        'module' => [
                            'name' => 'wizard_rte',
                        ],
                    ],
                ]
            ],
            'defaultExtras' => 'richtext[]',
        ],
        'author' => [
            'exclude' => 0,
            'label' => $ll . 'tx_t3osnippets_domain_model_snippet.author',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'foreign_table_where' => 'ORDER BY fe_users.username',
                'items' => [
                    ['', 0]
                ],
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'eval' => 'int'
            ],
        ],
        'code' => [
            'exclude' => 0,
            'label' => $ll . 'tx_t3osnippets_domain_model_snippet.code',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim,required'
            ]
        ],
        'tags' => [
            'exclude' => 0,
            'label' => $ll . 'tx_t3osnippets_domain_model_snippet.tags',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ],
        ],
    ],
];