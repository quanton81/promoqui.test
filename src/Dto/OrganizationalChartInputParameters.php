<?php

namespace Promoqui\Dto;

use Exception;
use Promoqui\Enum\Languages;

class OrganizationalChartInputParameters
{
    private $nodeId;
    private $language;
    private $searchKeyword;
    private $pageNum;
    private $pageSize;

    private function __construct(
        int $nodeId,
        string $language,
        ?string $searchKeyword,
        ?int $pageNum,
        ?int $pageSize
    )
    {
        $this->nodeId = $nodeId;
        $this->language = $language;
        $this->searchKeyword = isset($searchKeyword) ? $searchKeyword : null;
        $this->pageNum = isset($pageNum) ? $pageNum : 0;
        $this->pageSize = isset($pageSize) ? $pageSize : 100 ;
    }

    public function nodeId(): int
    {
        return $this->nodeId;
    }

    public function language(): string
    {
        return $this->language;
    }

    public function searchKeyword(): ?string
    {
        return $this->searchKeyword;
    }

    public function pageNum(): ?int
    {
        return $this->pageNum;
    }

    public function pageSize(): ?int
    {
        return $this->pageSize;
    }

    public static function fromArray(array $inputParameters): self
    {
        if (empty($inputParameters['nodeId'])) {
            throw new Exception('Missing mandatory params');
        }

        if (empty($inputParameters['language'])) {
            throw new Exception('Missing mandatory params');
        }

        if (!Languages::isValidValue($inputParameters['language'])) {
            throw new Exception('Missing mandatory params');
        }

        if($inputParameters['pageNum'] < 0) {
            throw new Exception('Invalid page number requested');
        }

        if($inputParameters['pageSize'] < 0 OR $inputParameters['pageSize'] > 1000) {
            throw new Exception('Invalid page size requested');
        }

        return new self(
            $inputParameters['nodeId'],
            $inputParameters['language'],
            $inputParameters['searchKeyword'],
            $inputParameters['pageNum'],
            $inputParameters['pageSize'],
        );
    }
}
