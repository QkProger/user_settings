<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest; // Подключаем UserRequest
use App\Services\UserServiceInterface;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $filters = [
            'id' => $request->id,
            'name' => $request->name,
            'per_page' => $request->input('per_page', 20)
        ];

        $users = $this->userService->getAllUsers($filters);

        return Inertia::render('Admin/User/Index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/User/Create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->only('name', 'phone', 'email', 'real_password');
        $this->userService->createUser($data);

        return redirect()->route('admin.users.index')->with('success', 'Успешно добавлен');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);

        return Inertia::render('Admin/User/Edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->only('name', 'phone', 'email', 'real_password');
        $this->userService->updateUser($id, $data);

        return redirect()->route('admin.users.index')->withSuccess("Успешно обновлен!");
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return redirect()->back()->withSuccess('Успешно удален');
    }
}
