<?php

namespace Promoqui\ValueObjects;

use JsonSerializable;

class OrganizationalChartOutput implements JsonSerializable
{
    private $array;
    private $error;

    public function __construct()
    {
        $this->array = [];
        $this->error = null;
    }

    public function error()
    {
        return $this->error;
    }

    public function setError(string $error)
    {
        $this->error = $error;
    }

    public function addNode(OrganizationalChartNode $node)
    {
        array_push($this->array, $node);
    }

    public function jsonSerialize() {
        return [
            'nodes' => $this->array,
            'error' => $this->error
        ];
    }
}
