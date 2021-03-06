<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Iresults.' . $_EXTKEY,
	'Newsfilter',
	'News Filter'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'News-Filter');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_newsfilter_domain_model_searchconfiguration', 'EXT:news_filter/Resources/Private/Language/locallang_csh_tx_newsfilter_domain_model_searchconfiguration.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_newsfilter_domain_model_searchconfiguration');

$pluginSignature = str_replace('_', '', $_EXTKEY).'_'.'newsfilter';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/news_filter.xml'
);
