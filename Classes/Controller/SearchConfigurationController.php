<?php
namespace Iresults\NewsFilter\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Andreas Thurnheer-Meier <tma@iresults.li>, iresults gmbh
 *           Daniel Corn <cod@iresults.li>, iresults gmbh
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
 ***************************************************************/

use Iresults\NewsFilter\Constants;
use Iresults\NewsFilter\Domain\Model\SearchConfiguration;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * SearchConfigurationController
 */
class SearchConfigurationController extends ActionController
{
    /**
     * @var \Iresults\NewsFilter\Service\SearchParameterService
     * @inject
     */
    protected $searchParameterService;

    /**
     * action list
     *
     * @return void
     */
    public function showAction()
    {
        $configuration = SearchConfiguration::createDefaultConfiguration();
        $this->view->assign('configuration', $configuration);
        $this->view->assign('searchTerms', $this->searchParameterService->getSearchTerms($configuration));

        $this->view->assign('generalSearchKey', Constants::GENERAL_SEARCH_KEY);
        $this->view->assign('generalSearchTerm', $this->searchParameterService->getGeneralSearchTerm());
    }
}
