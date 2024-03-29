<?php
namespace App\Repositories;
use App\Models\Users;

class UsersRepository
{
    public function getAllUsers()
    {
        return Users::get();
    }

    public function getUser($id)
    {
        return Users::where('id',$id)->get();
    }

    public function createUser($request)
    {
        return Users::create($request) ? true : false;
    }

    public function updateUser($request)
    {
        return Users::where('id', $request['id'])
                ->update($request) ? true : false;
    }

    public function deleteUser($request)
    {
        return Users::where('id',$request['id'])->delete() ? true : false;
    }

    public function validateRules() 
    {
        return [
            'name' => 'required',
            'status' => 'required',
            'email' => 'required|email'
        ];
    }

    public function validateFeedback() 
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'O campo e-mail não é válido'
        ];
    }

}