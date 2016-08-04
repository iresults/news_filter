<?php

namespace Iresults\NewsFilter\Hooks;

use GeorgRinger\News\Domain\Model\Dto\NewsDemand;
use GeorgRinger\News\Domain\Repository\DemandedRepositoryInterface;
use Iresults\NewsFilter\Domain\Model\SearchConfiguration;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

abstract class AbstractRepositoryHook
{
    /**
     * @param SearchConfiguration $configuration
     * @param NewsDemand          $demand
     * @param bool                $respectEnableFields
     * @param QueryInterface      $query
     * @param array               $constraints
     */
    abstract protected function updateConstraints(
        SearchConfiguration $configuration,
        NewsDemand $demand,
        $respectEnableFields,
        QueryInterface $query,
        array &$constraints
    );

    /**
     * @param array                       $params
     * @param DemandedRepositoryInterface $newsRepository
     */
    abstract public function modify(array $params, DemandedRepositoryInterface $newsRepository);
}