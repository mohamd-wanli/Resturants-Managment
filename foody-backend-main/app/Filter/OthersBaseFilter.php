<?php

namespace App\Filter;

class OthersBaseFilter
{
    public int $page = 0;

    public int $per_page = 10;

    public string $searchQuery;

    public string $orderBy;

    public string $order = 'DESC';

    public bool $getAll;

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function setPerPage(int $per_page): void
    {
        $this->per_page = $per_page;
    }

    public function getPerPage(): int
    {
        return $this->per_page;
    }

    public function setSearchQuery(string $searchQuery): void
    {
        $this->searchQuery = $searchQuery;
    }

    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    public function setOrder(string $order): void
    {
        $this->order = $order;
    }

    public function setGetAll(bool $getAll): void
    {
        $this->getAll = $getAll;
    }
}
