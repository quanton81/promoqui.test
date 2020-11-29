<?php

namespace Promoqui\Services;

use Exception;
use PDO;
use Promoqui\Dto\OrganizationalChartInputParameters;
use Promoqui\Repository\NodeTree;
use Promoqui\ValueObjects\OrganizationalChartNode;
use Promoqui\ValueObjects\OrganizationalChartOutput;

class OrganizationalChart
{
    private $repository;
    private $exception;

    public function __construct(PDO $PDO)
    {
        $this->repository = new NodeTree($PDO);
        $this->exception = '';
    }

    public function validate(array $input): ?OrganizationalChartInputParameters
    {
        $dto = null;

        try {
            $dto = OrganizationalChartInputParameters::fromArray($input);
        } catch (Exception $exception) {
            $this->exception = $exception->getMessage();
            return null;
        }

        return $dto;
    }

    public function fetchNodes(array $input): OrganizationalChartOutput
    {
        $dto = self::validate($input);
        $organizationalCharts = [];

        if (empty($this->exception)) {
            $organizationalCharts = $this->repository->fetchByInputParameters($dto);
        }

        $organizationalChartsOutput = new OrganizationalChartOutput();

        $organizationalChartsOutput->setError($this->exception);

        foreach ($organizationalCharts as $organizationalChart) {

            $organizationalChartNode = OrganizationalChartNode::fromArray([
                    'nodeId' => $organizationalChart['node_id'],
                    'name' => $organizationalChart['name'],
                    'childrenCount' => $organizationalChart['children_count'],
                ]
            );
            $organizationalChartsOutput->addNode($organizationalChartNode);
        }

        return $organizationalChartsOutput;
    }
}