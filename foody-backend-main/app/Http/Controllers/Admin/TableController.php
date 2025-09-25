<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Http\Requests\Admin\TableRequest;
use App\Interfaces\Admin\TableInterface;

class TableController extends Controller
{
    public function __construct(TableInterface $table)
    {
        $this->table = $table;
    }

    public function index(BranchRequest $request)
    {
        return $this->table->getTables();
    }

    public function store(TableRequest $request)
    {
        return $this->table->storeTable($request->validated());
    }

    public function update($id, TableRequest $request)
    {
        return $this->table->updateTable($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->table->deleteTable($id);
    }

    public function active(string $id)
    {
        return $this->table->active($id);
    }
}
