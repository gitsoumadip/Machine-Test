<?php

namespace App\Services\UserManagment;

use App\Contracts\UserManagment\UserManagmentContract;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;
use App\Models\UserParent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Exists;

class UserManagmentService implements UserManagmentContract
{
    public function __construct(protected User $model)
    {
        $this->model = $model;
    }
    function getAllUser()
    {
        return User::where('type', 'super-admin')->get();
    }
    function createUser(array $data)
    {
        // dd($data);
        $isUserCreated = User::create([
            'name' => $data['name'],
            'dob' => $data['date'],
            'class' => $data['class'],
            'zip_code' => $data['zip_code'],
            'country_id' => $data['country_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'address' => $data['address'],
            'profile_img' => uploadImage($data['profile_images'], 'uploads'),
        ]);

        foreach ($data['f'] as $parentData) {
            UserParent::create([
                'user_id' => $isUserCreated->id,
                'name' => $parentData['name'],
                'mobile_number' => $parentData['phone'],
                'relation_id' => $parentData['relation'],
            ]);
        }

        return $isUserCreated;
    }


    public function getTotalData(array $filterConditions, $search = null)
    {
        // dd($filterConditions);
        $query = $this->model;

        return $query->count();
    }

    public function getListofCategories($filterConditions, $start, $limit, $order, $dir, $search = null)
    {
        $query = $this->model;
        return $query->offset($start)->limit($limit)->orderBy($order, $dir)->get();
    }
    public function getParentDetailsTotalData(array $filterConditions, $search = null)
    {

        $query = new  UserParent();

        return $query->count();
    }

    public function getListofParentDetails($filterConditions, $start, $limit, $order, $dir, $search = null)
    {
        $query = UserParent::where('user_id', $filterConditions['id']);
        return $query->offset($start)->limit($limit)->orderBy($order, $dir)->get();
    }
}
