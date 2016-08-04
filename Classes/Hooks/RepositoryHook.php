<?php

namespace Iresults\NewsFilter\Hooks;

use GeorgRinger\News\Domain\Model\Dto\NewsDemand;
use GeorgRinger\News\Domain\Repository\DemandedRepositoryInterface;
use Iresults\NewsFilter\Domain\Model\SearchConfiguration;
use Iresults\NewsFilter\Service\SearchParameterService;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class RepositoryHook extends AbstractRepositoryHook
{
    /**
     * @var SearchParameterService
     */
    private $searchParameterService;

    /**
     * Repository constructor.
     *
     * @param SearchParameterService $searchParameterService
     */
    public function __construct(SearchParameterService $searchParameterService = null)
    {
        $this->searchParameterService = $searchParameterService ?: new SearchParameterService();
    }

    public function modify(array $params, DemandedRepositoryInterface $newsRepository)
    {
        $configuration = SearchConfiguration::createDefaultConfiguration();

        if ($this->searchParameterService->getGeneralSearchTerm() && $params['demand'] instanceof NewsDemand) {
            $this->updateConstraints(
                $configuration,
                $params['demand'],
                $params['respectEnableFields'],
                $params['query'],
                $params['constraints']
            );
        }
    }

    /**
     * @param SearchConfiguration $configuration
     * @param NewsDemand          $demand
     * @param bool                $respectEnableFields
     * @param QueryInterface      $query
     * @param array               $constraints
     */
    protected function updateConstraints(
        SearchConfiguration $configuration,
        NewsDemand $demand,
        $respectEnableFields,
        QueryInterface $query,
        array &$constraints
    ) {

        $generalSearchTerm = $this->searchParameterService->getGeneralSearchTerm();
        if ($generalSearchTerm) {
            $buildFieldConstraints = function ($field) use ($query, $generalSearchTerm) {
                return $query->like($field, '%' . $generalSearchTerm . '%');
            };
            $constraints[] = $query->logicalOr(array_map($buildFieldConstraints, $configuration->getFields()));
        }
    }
}
