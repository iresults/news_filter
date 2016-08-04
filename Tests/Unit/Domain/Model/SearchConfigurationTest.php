<?php

namespace Iresults\NewsFilter\Tests\Unit\Domain\Model;

    /***************************************************************
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
use Iresults\NewsFilter\Domain\Model\SearchConfiguration;

/**
 * Test case for class \Iresults\NewsFilter\Domain\Model\SearchConfiguration.
 *
 * @copyright Copyright belongs to the respective authors
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author    Andreas Thurnheer-Meier <tma@iresults.li>
 * @author    Daniel Corn <cod@iresults.li>
 */
class SearchConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SearchConfiguration
     */
    protected $subject = null;

    public function setUp()
    {
        $this->subject = new SearchConfiguration();
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getFieldsReturnsInitialValueForString()
    {
        $this->assertEmpty($this->subject->getFields());
    }

    /**
     * @test
     */
    public function setFieldsForStringSetsFields()
    {
        $this->subject->setFields(['title', 'bodytext']);

        $this->assertAttributeEquals(
            'title,bodytext',
            'fields',
            $this->subject
        );

        $this->assertAttributeEquals(
            ['title', 'bodytext'],
            'fieldsArray',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function createDefaultConfiguration()
    {
        $this->subject = SearchConfiguration::createDefaultConfiguration();

        $this->assertAttributeEquals(
            'title,alternativeTitle,teaser,bodytext',
            'fields',
            $this->subject
        );

        $this->assertAttributeEquals(
            ['title', 'alternativeTitle', 'teaser', 'bodytext'],
            'fieldsArray',
            $this->subject
        );

    }
}
