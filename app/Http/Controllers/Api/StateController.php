<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\StateRepository;

class StateController extends Controller
{
    /**
     * @var StateRepository
     */
    private $repository;

    /**
     * StateController constructor.
     * @param StateRepository $repository
     */
    public function __construct(StateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function states()
    {
        $states = $this->repository->with('categories')->findWhere([
            'status' => 'active'
        ]);
        return $states;
    }

    public function index()
    {
        return $this->repository->all();
    }

}
