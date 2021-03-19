<?php

namespace App\Http\Controllers;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllUsers(Request $request)
    {
        return $this->repository->getAllUsers($request->all());
    }

    public function getUser($id)
    {
        return $this->repository->getUser($id);
    }

    public function createUser(Request $request)
    {
        $request->validate($this->repository->validateRules(), $this->repository->validateFeedback());
        return $this->repository->createUser($request->all());
    }

    public function updateUser(Request $request)
    {
        $request->validate($this->repository->validateRules(), $this->repository->validateFeedback());
        return $this->repository->updateUser($request->all());
    }

    public function deleteUser(Request $request)
    {
        return $this->repository->deleteUser($request->all());
    }
}
