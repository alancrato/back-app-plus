<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PromotionRepository;

class PromotionController extends Controller
{
    /**
     * @var PromotionRepository
     */
    private $repository;

    /**
     * PromotionController constructor.
     * @param PromotionRepository $repository
     */
    public function __construct(PromotionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->findWhere([
           'status' => true
        ]);
    }

}
