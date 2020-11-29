<?php

namespace Promoqui\ValueObjects;

use JsonSerializable;

class OrganizationalChartNode implements JsonSerializable
{
    private $nodeId;
    private $name;
    private $childrenCount;

    private function __construct(
        int $nodeId,
        string $name,
        int $childrenCount
    )
    {
        $this->nodeId = $nodeId;
        $this->name = $name;
        $this->childrenCount = $childrenCount;
    }

    public function jsonSerialize() {
        return [
            'node_id' => $this->nodeId,
            'name' => $this->name,
            'children_count' => $this->childrenCount,
        ];
    }

    public static function fromArray(array $node)
    {
        return new self($node['nodeId'], $node['name'], $node['childrenCount']);
    }
}