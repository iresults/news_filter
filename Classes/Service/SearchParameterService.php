<?php
/*
 *  Copyright notice
 *
 *  (c) 2016 Andreas Thurnheer-Meier <tma@iresults.li>, iresults
 *  Daniel Corn <cod@iresults.li>, iresults
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 */

/**
 * @author COD
 * Created 04.08.16 15:11
 */


namespace Iresults\NewsFilter\Service;

use Iresults\NewsFilter\Constants;
use Iresults\NewsFilter\Domain\Model\SearchConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Service to detect search parameters in the query
 */
class SearchParameterService
{
    /**
     * Returns all sent search terms for the given configuration
     *
     * @param SearchConfiguration $configuration
     * @return array
     */
    public function getSearchTerms(SearchConfiguration $configuration)
    {
        $searchTerms = [];
        $arguments = GeneralUtility::_GP(Constants::PARAMETER_PREFIX);

        if (!$arguments) {
            return [];
        }

        foreach ($configuration->getFields() as $field) {
            $searchTerms[$field] = isset($arguments[$field]) ? trim($arguments[$field]) : '';
        }

        return $searchTerms;
    }

    /**
     * Returns the search term for the general search parameter key
     *
     * @return string
     */
    public function getGeneralSearchTerm()
    {
        $arguments = GeneralUtility::_GP(Constants::PARAMETER_PREFIX);

        return ($arguments && isset($arguments[Constants::GENERAL_SEARCH_KEY]))
            ? trim($arguments[Constants::GENERAL_SEARCH_KEY])
            : '';
    }
}