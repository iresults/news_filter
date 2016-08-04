<?php
namespace Iresults\NewsFilter\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Andreas Thurnheer-Meier <tma@iresults.li>, iresults gmbh
 *  			Daniel Corn <cod@iresults.li>, iresults gmbh
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

/**
 * Test case for class Iresults\NewsFilter\Controller\SearchConfigurationController.
 *
 * @author Andreas Thurnheer-Meier <tma@iresults.li>
 * @author Daniel Corn <cod@iresults.li>
 */
class SearchConfigurationControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Iresults\NewsFilter\Controller\SearchConfigurationController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Iresults\\NewsFilter\\Controller\\SearchConfigurationController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllSearchConfigurationsFromRepositoryAndAssignsThemToView()
	{

		$allSearchConfigurations = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$searchConfigurationRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$searchConfigurationRepository->expects($this->once())->method('findAll')->will($this->returnValue($allSearchConfigurations));
		$this->inject($this->subject, 'searchConfigurationRepository', $searchConfigurationRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('searchConfigurations', $allSearchConfigurations);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
