<?php

namespace App\Traits\Table;

trait SettingTable
{
    public ?string $search = '';
    public ?int $qtyItemsForPage = 10;
    public ?string $sortField;
    public ?string $sortDirection = 'asc';

    public function sortBy($field): void
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';
        $this->sortField = $field;
    }
    public  function setSortField($name = null)
    {
        return $this->sortField = $name ?? 'full_name';
    }

}
