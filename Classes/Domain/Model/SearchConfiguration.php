<?php
namespace Iresults\NewsFilter\Domain\Model;


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
use GeorgRinger\News\Domain\Model\News;

/**
 * SearchConfiguration
 */
class SearchConfiguration extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * fields
     *
     * @var string
     */
    protected $fields = '';

    /**
     * @var string[]
     */
    protected $fieldsArray;

    /**
     * Return the configuration with the default fields
     *
     * @return SearchConfiguration
     */
    public static function createDefaultConfiguration()
    {
        return new static(
            [
                'title',
                'alternativeTitle',
                'teaser',
                'bodytext',
                //'author',
                //'authorEmail',
                //'type',
                //'keywords',
                //'description',
            ]
        );
    }

    /**
     * SearchConfiguration constructor.
     *
     * @param string[] $fields
     */
    public function __construct(array $fields = [])
    {
        $this->setFields($fields);
    }

    /**
     * Returns the fields
     *
     * @return string[] $fields
     */
    public function getFields()
    {
        if (null === $this->fieldsArray) {
            $this->fieldsArray = explode(',', $this->fields);
        }

        return $this->fieldsArray;
    }

    /**
     * Sets the fields
     *
     * @param string[] $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $fields = array_map('trim', $fields);
        $this->fieldsArray = $fields;
        $this->fields = implode(',', $fields);

        return $this;
    }

}