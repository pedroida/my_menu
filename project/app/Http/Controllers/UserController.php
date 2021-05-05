<?php

namespace App\Http\Controllers;

use App\Exceptions\SelfDeleteException;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->resource = UserResource::class;
    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $userData = $request->validated();

        $user = $this->repository->createUser($userData);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'users.edit', $user->id);
    }

    public function edit($id)
    {
        $user = $this->repository->findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $userData = $request->validated();

        $user = $this->repository->findOrFail($id);
        $this->repository->updateUser($user, $userData);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'users.edit', $id);
    }

    public function show($id)
    {
        $user = $this->repository->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = $this->repository->findOrFail($id);

        try {
            $this->repository->delete($user);
            return $this->chooseReturn('success', _m('common.success.destroy'));
        } catch (SelfDeleteException $e) {
            return $this->chooseReturn('error', _m('admin.error.self_delete'));
        } catch (\Exception $e) {
            return $this->chooseReturn('error', _m('common.error.destroy'));
        }
    }

    public function getPagination($pagination)
    {
        $pagination
            ->repository($this->repository)
            ->defaultOrderBy('created_at', 'DESC')
            ->resource($this->resource);
    }
}
