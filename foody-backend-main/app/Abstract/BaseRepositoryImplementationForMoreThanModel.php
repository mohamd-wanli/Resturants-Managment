<?php

namespace App\Abstract;

use App\Interfaces\BaseRepositoryInterfaceForMoreThanModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepositoryImplementationForMoreThanModel implements BaseRepositoryInterfaceForMoreThanModel
{
    /**
     * The repository model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The query builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * Alias for the query limit.
     *
     * @var int
     */
    protected $take;

    /**
     * Array of related models to eager load.
     *
     * @var array
     */
    protected $with = [];

    /**
     * Array of one or more where clause parameters.
     *
     * @var array
     */
    protected $wheres = [];

    /**
     * Array of one or more where in clause parameters.
     *
     * @var array
     */
    protected $whereIns = [];

    /**
     * Array of one or more ORDER BY column/value pairs.
     *
     * @var array
     */
    protected $orderBys = [];

    /**
     * Array of scope methods to call on the model.
     *
     * @var array
     */
    protected $scopes = [];

    /**
     * BaseRepositoryImplementation constructor.
     */

    /**
     * Specify Model class name.
     *
     * @return mixed
     */

    /**
     * @returnModel|mixed
     *
     * @throwsGeneralException
     *
     * @throws\Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel(string $namespace)
    {
        $model = app()->make($namespace);

        if (! $model instanceof Model) {
            //   throw new \Exception("Class {$this->model()} must be an instance of ".Model::class);
        }

        return $this->model = $model;
    }

    /**
     * Get all the model records in the database.
     */
    public function all(string $namespace, array $columns = ['*'])
    {
        $this->newQuery()->eagerLoad();
        $this->makeModel($namespace);

        $models = $this->query->get($columns);

        $this->unsetClauses();

        return $models;
    }

    public function getWith(): array
    {
        return $this->with;
    }

    public function setWith(array $with): void
    {
        $this->with = $with;
    }

    /**
     * Count the number of specified model records in the database.
     */
    public function count(string $namespace): int
    {
        $this->makeModel($namespace);

        return $this->get($namespace)->count();
    }

    /**
     * Create a new model record in the database.
     *
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(string $namespace, array $data)
    {
        $this->makeModel($namespace);
        $this->unsetClauses();

        return $this->model->create($data);
    }

    public function updateOrCreate(string $namespace, array $conditions, array $data)
    {
        $this->unsetClauses();
        $this->makeModel($namespace);

        return $this->model->updateOrCreate($conditions, $data);
    }

    /**
     * Create one or more new model records in the database.
     */
    public function createMultiple(string $namespace, array $data)
    {
        $this->makeModel($namespace);
        $models = new Collection();

        foreach ($data as $d) {
            $models->push($this->create($namespace, $d));
        }

        return $models;
    }

    /**
     * Delete one or more model records from the database.
     *
     * @return mixed
     */
    public function delete(string $namespace)
    {
        $this->newQuery()->setClauses()->setScopes();
        $this->makeModel($namespace);

        $result = $this->query->delete();

        $this->unsetClauses();

        return $result;
    }

    /**
     * Delete the specified model record from the database.
     *
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function deleteById(string $namespace, $id): bool
    {
        $this->unsetClauses();
        $this->makeModel($namespace);

        return $this->getById($namespace, $id)->delete();
    }

    /**
     * Delete multiple records.
     */
    public function deleteMultipleById(string $namespace, array $ids): int
    {
        $this->makeModel($namespace);

        return $this->model->destroy($ids);
    }

    /**
     * Get the first specified model record from the database.
     *
     *
     * @return Model|static
     */
    public function first(string $namespace, array $columns = ['*'])
    {
        $this->makeModel($namespace);
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $model = $this->query->firstOrFail($columns);

        $this->unsetClauses();

        return $model;
    }

    /**
     * Get all the specified model records in the database.
     *
     *
     * @return Collection|static[]
     */
    public function get(string $namespace, array $columns = ['*'])
    {
        $this->makeModel($namespace);
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->get($columns);

        $this->unsetClauses();

        return $models;
    }

    public function getColumnValues(string $namespace, $column)
    {
        $this->makeModel($namespace);
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->pluck($column);

        $this->unsetClauses();

        return $models;
    }

    /**
     * Get the specified model record from the database.
     */
    public function getById(string $namespace, $id, array $columns = ['*']): Model|Collection
    {
        $this->unsetClauses();
        $this->makeModel($namespace);
        $this->newQuery()->eagerLoad();

        return $this->query->findOrFail($id, $columns);
    }

    /**
     * @return Model|null|static
     */
    public function getFirstByColumn(string $namespace, $item, $column, array $columns = ['*'])
    {
        $this->unsetClauses();
        $this->makeModel($namespace);

        $this->newQuery()->eagerLoad();

        return $this->query->where($column, $item)->first($columns);
    }

    public function getAllByColumn(string $namespace, $item, $column, array $columns = ['*'])
    {
        $this->makeModel($namespace);

        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        return $this->query->where($column, $item)->get($columns);
    }

    public function getByColumn(string $namespace, $column, $item)
    {
        $this->makeModel($namespace);
        $this->unsetClauses();
        $this->newQuery()->eagerLoad();

        return $this->query->where($column, $item)->first();
    }

    /**
     * @param  int  $limit
     * @param  string  $pageName
     * @param  null  $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(string $namespace, $limit = 25, array $columns = ['*'], $pageName = 'page', $page = null)
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();
        $this->makeModel($namespace);
        $models = $this->query->paginate($limit, $columns, $pageName, $page);

        $this->unsetClauses();

        return $models;
    }

    /**
     * Update the specified model record in the database.
     *
     * @param  array  $options
     * @return Collection|Model
     */
    public function updateById(string $namespace, $id, array $data)
    {
        $this->makeModel($namespace);

        $this->unsetClauses();

        $model = $this->getById($namespace, $id);

        $data = array_filter($data, fn ($value) => ! is_null($value));

        $model->update($data);

        return $model;
    }

    public function updateByColumn(string $namespace, $column_name, $column_value, array $data)
    {
        $this->unsetClauses();
        $this->makeModel($namespace);

        $data = array_filter($data, fn ($value) => ! is_null($value));

        $model = $this->getByColumn($namespace, $column_value, $column_name);

        $model->update($data);

        return $model;
    }

    /**
     * Set the query limit.
     *
     * @param  int  $limit
     * @return $this
     */
    public function limit(string $namespace, $limit)
    {
        $this->take = $limit;
        $this->makeModel($namespace);

        return $this;
    }

    /**
     * Set an ORDER BY clause.
     *
     * @param  string  $column
     * @param  string  $direction
     * @return $this
     */
    public function orderBy(string $namespace, $column, $direction = 'asc')
    {
        $this->orderBys[] = compact('column', 'direction');
        $this->makeModel($namespace);

        return $this;
    }

    /**
     * Add a simple where clause to the query.
     *
     * @param  string  $column
     * @param  string  $value
     * @param  string  $operator
     * @return $this
     */
    public function where(string $namespace, $column, $value, $operator = '=')
    {
        $this->wheres[] = compact('column', 'value', 'operator');
        $this->makeModel($namespace);

        return $this;
    }

    /**
     * Add a simple where in clause to the query.
     *
     * @param  string  $column
     * @param  mixed  $values
     * @return $this
     */
    public function whereIn(string $namespace, $column, $values)
    {
        $values = is_array($values) ? $values : [$values];
        $this->makeModel($namespace);

        $this->whereIns[] = compact('column', 'values');

        return $this;
    }

    /**
     * Set Eloquent relationships to eager load.
     *
     *
     * @return $this
     */
    public function with(string $namespace, $relations)
    {
        $this->makeModel($namespace);
        if (is_string($relations)) {
            $relations = func_get_args();
        }

        $this->with = $relations;

        return $this;
    }

    /**
     * Create a new instance of the model's query builder.
     *
     * @return $this
     */
    protected function newQuery()
    {
        $this->query = $this->model->newQuery();

        return $this;
    }

    /**
     * Add relationships to the query builder to eager load.
     *
     * @return $this
     */
    protected function eagerLoad()
    {
        foreach ($this->getWith() as $relation) {
            $this->query->with($relation);
        }

        return $this;
    }

    /**
     * Set clauses on the query builder.
     *
     * @return $this
     */
    protected function setClauses()
    {
        foreach ($this->wheres as $where) {
            $this->query->where($where['column'], $where['operator'], $where['value']);
        }

        foreach ($this->whereIns as $whereIn) {
            $this->query->whereIn($whereIn['column'], $whereIn['values']);
        }

        foreach ($this->orderBys as $orders) {
            $this->query->orderBy($orders['column'], $orders['direction']);
        }

        if (isset($this->take) and ! is_null($this->take)) {
            $this->query->take($this->take);
        }

        return $this;
    }

    /**
     * Set query scopes.
     *
     * @return $this
     */
    protected function setScopes()
    {
        foreach ($this->scopes as $method => $args) {
            $this->query->$method(implode(', ', $args));
        }

        return $this;
    }

    /**
     * Reset the query clause parameter arrays.
     *
     * @return $this
     */
    protected function unsetClauses()
    {
        $this->wheres = [];
        $this->whereIns = [];
        $this->scopes = [];
        $this->take = null;

        return $this;
    }

    public function exists(string $namespace, $attrs)
    {
        $this->unsetClauses();
        $this->makeModel($namespace);

        $this->newQuery()->eagerLoad();

        foreach ($attrs as $key => $value) {
            $this->query->where($key, $value);
        }

        $exists = $this->query->get()->count() > 0;
        $this->unsetClauses();

        return $exists;
    }

    public function insert(string $namespace, array $data)
    {
        $this->makeModel($namespace);

        $this->unsetClauses();

        return $this->model->insert($data);
    }

    public function upsertByColumn(string $namespace, array $data, array $column, array $columnsToUpdate)
    {
        $this->unsetClauses();
        $this->makeModel($namespace);

        return $this->model->upsert($data, $column, $columnsToUpdate);
    }

    public function updateByIdWithNullableValues(string $namespace, $id, array $data)
    {
        $this->unsetClauses();
        $this->makeModel($namespace);

        $model = $this->getById($namespace, $id);
        $model->update($data);

        return $model;
    }

    public function updateByColumnWithNullableValues(string $namespace, $column_name, $column_value, array $data)
    {
        $this->unsetClauses();
        $this->makeModel($namespace);

        $model = $this->getByColumn($namespace, $column_value, $column_name);
        $model->update($data);

        return $model;
    }

    public function incrementDecrement(string $namespace, int $id, string $column_name, int $value, bool $isIncrement)
    {
        $this->makeModel($namespace);

        $this->unsetClauses();
        $model = $this->getById($namespace, $id);

        if ($isIncrement) {
            return $model->increment($column_name, $value);
        }

        return $model->decrement($column_name, $value);
    }
}
