<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\BranchRepository;

class BranchController extends Controller
{
    public function __construct(BranchRepository $branch)
    {
        $this->branch = $branch;
    }

    public function index()
    {
        return $this->branch->getBranches();
    }
}
