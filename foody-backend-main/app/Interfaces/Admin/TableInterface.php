<?php

namespace App\Interfaces\Admin;

interface TableInterface
{
    public function getTables();

    public function storeTable($data);

    public function updateTable($id, $data);

    public function deleteTable($id);

    public function active($id);
}
