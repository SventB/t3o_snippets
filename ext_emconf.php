<?php
########################################################################
# Extension Manager/Repository config file for ext: "t3o_snippets"
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Snippets',
    'description' => 'Snippets with list, details, GeSHi syntax highlighter, submitting and editing via frontend. Demo: http://typo3.org/documentation/snippets/',
    'category' => 'plugin',
    'author' => 'Sven Burkert',
    'author_email' => 'bedienung@sbtheke.de',
    'author_company' => 'SBTheke web development',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '',
    'constraints' => array(
        'depends' => array(
            'typo3' => '7.6.0-7.6.99',
            'extbase' => '',
            'fluid' => '',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);