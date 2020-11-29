<?php

namespace Promoqui\Repository;

use PDO;
use Promoqui\Dto\OrganizationalChartInputParameters;

class NodeTree
{
    private $tableName = 'node_tree';
    private $tableNameNames = 'node_tree_names';

    /** @var PDO $PDO */
    protected $PDO;

    public function __construct(PDO $PDO)
    {
        $this->PDO = $PDO;
    }

    public function fetchByInputParameters(OrganizationalChartInputParameters $organizationalChartInputParameters): array
    {
        $nodeId = $organizationalChartInputParameters->nodeId();
        $language = $organizationalChartInputParameters->language();
        $searchKeyword = $organizationalChartInputParameters->searchKeyword();
        $pageNum = $organizationalChartInputParameters->pageNum();
        $pageSize = $organizationalChartInputParameters->pageSize();

        $andLanguage = !empty($language) ? "and names.language = '{$language}'" : "";
        $andSearchKeyword = !empty($searchKeyword) ? "and names.nodeName like '%{$searchKeyword}%'" : "";

        $sql = "
select child.idNode as node_id,
       child.level,
       child.iLeft,
       child.iRight,
       names.language,
       names.nodeName as name,
       (
           select count(distinct child2.idNode) as nodes
           from {$this->tableName} child2
                    inner join {$this->tableNameNames} names2 on child2.idNode = names2.idNode,
                {$this->tableName} parent2
           where child2.iLeft between parent2.iLeft and parent2.iRight
             and child2.idNode != parent2.idNode
             and names2.language = names.language
             and parent2.idNode = child.idNode
       ) as children_count
from {$this->tableName} child
         inner join {$this->tableNameNames} names on child.idNode = names.idNode,
     {$this->tableName} parent
where child.iLeft between parent.iLeft and parent.iRight
  {$andLanguage} {$andSearchKeyword}
  and parent.idNode = {$nodeId}
order by child.level
limit {$pageNum}, {$pageSize}";

        $sth = $this->PDO->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}
