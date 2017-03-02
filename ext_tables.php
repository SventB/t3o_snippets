<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Main',
    'Snippets'
);

$TCA['tt_content']['types']['list']['subtypes_addlist']['t3osnippets_main'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('t3osnippets_main', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForm/Main.xml');
// remove some fields from the plugin
$TCA['tt_content']['types']['list']['subtypes_excludelist']['t3osnippets_main'] = 'layout,select_key';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Snippets (setup)');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/JsCss', 'Snippets (js and css)');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3osnippets_domain_model_snippet', 'EXT:t3o_snippets/Resources/Private/Language/locallang_csh_snippet.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3osnippets_domain_model_snippet');
$TCA['tx_t3osnippets_domain_model_snippet'] = array(
    'ctrl' => array(
        'title'	=> 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xlf:tx_t3osnippets_domain_model_snippet',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'title,category,description,author,code,tags',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Snippet.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/snippet.gif'
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3osnippets_domain_model_category');
$TCA['tx_t3osnippets_domain_model_category'] = array(
    'ctrl' => array(
        'title'	=> 'LLL:EXT:t3o_snippets/Resources/Private/Language/locallang_db.xlf:tx_t3osnippets_domain_model_category',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'title',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/snippet.gif'
    ),
);