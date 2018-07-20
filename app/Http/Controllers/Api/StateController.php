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
        return $this->repository->with('categories')->all();
    }

    public function index()
    {
        return $this->repository->all();
    }

}
