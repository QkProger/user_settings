<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAllUsers($filters = []);
    public function getUserById($id);
    public function createUser(array $data);
    public function updateUser($id, array $data);
    public function deleteUser($id);
}
