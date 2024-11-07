<?php

namespace App\Contracts\UserManagment;

interface UserManagmentContract
{
    public function getAllUser();
    public function createUser(array $data);
    public function getTotalData(array $filterConditions, $search = null);
    public function getListofCategories(array $filterConditions, int $start, int $limit, string $order, string $dir, $search = null);
    public function getParentDetailsTotalData(array $filterConditions, $search = null);
    public function getListofParentDetails(array $filterConditions, int $start, int $limit, string $order, string $dir, $search = null);
}
