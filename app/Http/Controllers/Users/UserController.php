<?php

namespace App\Http\Controllers\Users;

use App\Contracts\UserManagment\UserManagmentContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    public function index()
    {
        $this->setPageTitle('User List');
        return view('users.index');
    }
    public function create(Request $request)
    {
        $this->setPageTitle('User Create');
        return view('users.add-edit');
    }
    public function fetchUserParentDetails(Request $request, $id) {
        return view('users.details', compact('id'));
    }
}
