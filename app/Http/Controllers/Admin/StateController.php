<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\StateRepository;

class StateController extends Controller
{
    /**
     * @var StateRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * StateController constructor.
     * @param StateRepository $repository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(StateRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        $state = $this->repository->with('categories')->all();
        return view('state.index', compact('state', 'categories'));
    }
}
