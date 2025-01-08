<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers($filters = [])
    {
        return User::when($filters['id'] ?? null, fn($q) => $q->where('id', $filters['id']))
            ->when($filters['name'] ?? null, fn($q) => $q->where('name', 'like', "%" . $filters['name'] . "%"))
            ->paginate($filters['per_page'] ?? 20)
            ->appends($filters);
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash('sha1', $data['real_password']),
            'real_password' => $data['real_password'],
        ]);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash('sha1', $data['real_password']),
            'real_password' => $data['real_password'],
        ]);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
