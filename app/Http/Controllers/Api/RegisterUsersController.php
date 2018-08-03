<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterUsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * RegisterUsersController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(UserRegisterRequest $request)
    {
        $user = $request->get('type')!='2'?
            $this->storeFromFacebook($request):
            $this->storeCommon($request);
        return ['token' => \Auth::guard('api')->tokenById($user->id)];
    }

    protected function storeCommon(Request $request)
    {
        User::unguard();
        $user = $this->repository->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => User::ROLE_CLIENT,
            'verified' => true
        ]);
        $user = $this->repository->update([
            'password' => $request->get('password')
        ],$user->id);
        User::reguard();
        return $user;
    }

    protected function storeFromFacebook(Request $request)
    {
        return [];
    }

}
