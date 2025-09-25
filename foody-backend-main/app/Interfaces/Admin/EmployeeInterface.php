<?php

namespace App\Interfaces\Admin;

interface EmployeeInterface
{
    public function getemployees();

    public function storeemp($data);

    public function updateemp($id, $data);

    public function deleteemp($id);

    public function activate($id);
}
