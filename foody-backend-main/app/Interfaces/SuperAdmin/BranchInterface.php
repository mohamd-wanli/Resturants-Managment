<?php

namespace App\Interfaces\SuperAdmin;

interface BranchInterface
{
    public function createBranch($data);

    public function updateBranch($id, $data);

    public function showBranch($id);

    public function deleteBranch($id);
}
