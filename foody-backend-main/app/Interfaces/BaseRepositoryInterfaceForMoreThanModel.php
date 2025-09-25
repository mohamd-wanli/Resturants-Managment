<?php

namespace App\Interfaces;

interface BaseRepositoryInterfaceForMoreThanModel
{
    public function all(string $namespace, array $columns = ['*']);

    public function count(string $namespace);

    public function create(string $namespace, array $data);

    public function updateOrCreate(string $namespace, array $conditions, array $data);

    public function createMultiple(string $namespace, array $data);

    public function delete(string $namespace);

    public function deleteById(string $namespace, $id);

    public function deleteMultipleById(string $namespace, array $ids);

    public function first(string $namespace, array $columns = ['*']);

    public function get(string $namespace, array $columns = ['*']);

    public function getColumnValues(string $namespace, $column);

    public function getById(string $namespace, $id, array $columns = ['*']);

    public function getFirstByColumn(string $namespace, $item, $column, array $columns = ['*']);

    public function getAllByColumn(string $namespace, $item, $column, array $columns = ['*']);

    public function getByColumn(string $namespace, $item, $column);

    public function paginate(string $namespace, $limit = 25, array $columns = ['*'], $pageName = 'page', $page = null);

    public function updateById(string $namespace, $id, array $data);

    public function updateByColumn(string $namespace, $column_name, $column_value, array $data);

    public function limit(string $namespace, $limit);

    public function orderBy(string $namespace, $column, $value);

    public function where(string $namespace, $column, $value, $operator = '=');

    public function whereIn(string $namespace, $column, $value);

    public function with(string $namespace, $relations);

    public function exists(string $namespace, $attrs);

    public function insert(string $namespace, array $data);

    public function updateByColumnWithNullableValues(string $namespace, $column_name, $column_value, array $data);

    public function updateByIdWithNullableValues(string $namespace, $id, array $data);

    public function incrementDecrement(string $namespace, int $id, string $column_name, int $value, bool $isIncrement);
}
