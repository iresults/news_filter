<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Iresults.' . $_EXTKEY,
	'Newsfilter',
	array(
		'SearchConfiguration' => 'show',
	),
	// non-cacheable actions
	array(
		'SearchConfiguration' => 'show',
	)
);

/**
 * Hook for EXT:news
 */
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Domain/Repository/AbstractDemandedRepository.php']['findDemanded'][$_EXTKEY]
    = 'Iresults\\NewsFilter\\Hooks\\RepositoryHook->modify';
