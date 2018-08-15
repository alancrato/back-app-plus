<?php

namespace App\Http\Controllers\Data;

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
        $data = $this->repository->findWhere([
           'status' => 'active'
        ]);
        return $data;
    }

}
