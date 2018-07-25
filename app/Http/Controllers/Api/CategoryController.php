<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->findWhere([
           'status' => 'active'
        ]);
        return $categories;
    }
}
