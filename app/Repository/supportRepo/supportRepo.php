<?php

namespace App\Repository\supportRepo;


use App\Models\Panel\Support;

class  supportRepo
{
    private $query ;
    public function __construct()
    {
        $this->query = Support::query();
    }

    public function index()
    {
        return $this->query->orderByDesc('created-at')->paginate();
    }

    public function create($value)
    {
        return $this->query->create([

        ]);
    }
}
