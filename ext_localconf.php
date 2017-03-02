<?php
defined('TYPO3_MODE') or die();

Tx_Extbase_Utility_Extension::configurePlugin(
    $_EXTKEY,
    'Main',
    [
        'Snippet' => 'list, listUncached, show, new, create, edit, update, delete, category, tag, author, search',
    ],
    // non-cacheable actions
    [
        'Snippet' => 'new, listUncached, create, edit, update, delete, search',
    ]
);