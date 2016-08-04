<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Iresults.' . $_EXTKEY,
	'Newsfilter',
	array(
		'SearchConfiguration' => 'list',
		
	),
	// non-cacheable actions
	array(
		'SearchConfiguration' => '',
		
	)
);
