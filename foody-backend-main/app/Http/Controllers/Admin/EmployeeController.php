<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Repository\Admin\EmployeeRepository;

class EmployeeController extends Controller
{
    public function __construct(EmployeeRepository $emp)
    {
        $this->user = $emp;
    }

    public function index()
    {
        return $this->user->getemployees();
    }

    public function store(EmployeeRequest $request)
    {
        return $this->user->storeemp($request->validated());
    }

    public function update($id, EmployeeRequest $request)
    {
        return $this->user->updateById($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->user->deleteemp($id);
    }

    public function active($id)
    {
        return $this->user->activate($id);
    }
}
