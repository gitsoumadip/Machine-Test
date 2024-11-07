<?php

namespace App\Http\Controllers\Ajax;

use App\Contracts\UserManagment\UserManagmentContract;
use App\Http\Controllers\BaseController;
use App\Models\City;
use App\Models\Relation;
use App\Models\State;
use App\Models\User;
use App\Models\UserParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AjaxController extends BaseController
{
    public function __construct(
        protected UserManagmentContract $userManagmentContract,

    ) {
        $this->userManagmentContract = $userManagmentContract;
    }

    public function fetchUserDetails(Request $request)
    {
        if ($request->ajax()) {
            try {
                $filterConditions = collect([]);
                $totalData = $this->userManagmentContract->getTotalData($filterConditions->toArray());
                $totalFiltered = 0;
                // $totalFiltered = $totalData;
                $limit = $request->input('length');
                $start = $request->input('start');
                $order = 'id';
                $dir = 'desc';
                $index = $start;
                $nestedData = [];
                $data = [];
                if (empty($request->input('search.value'))) {
                    $userDetails = $this->userManagmentContract->getListofCategories($filterConditions->toArray(), $start, $limit, $order, $dir);
                } else {
                    $search = $request->input('search.value');
                    $userDetails = $this->userManagmentContract->getListofCategories($filterConditions->toArray(), $start, $limit, $order, $dir, $search);
                    $totalFiltered = $this->userManagmentContract->getTotalData($filterConditions->toArray(), $search);
                }

                if (!empty($userDetails)) {
                    foreach ($userDetails as $userData) {
                        $image = url('/') . '/uploads/' . $userData?->profile_img;
                        $userParenrtDetailsRoute = route('user.fetchUserParentDetails', ['id' => $userData?->id]);
                        $index++;
                        $nestedData['sr'] = '<p>' . $index . '</p>';
                        $nestedData['id'] = $index;
                        $nestedData['image'] = '<img src="' .   $image . '" alt="user image" style="width: 100px; height: 100px;">';
                        $nestedData['name'] = '<a href="' . $userParenrtDetailsRoute . '">' . $userData?->name . '</a>';
                        $nestedData['dob'] = $userData?->dob;
                        $nestedData['class'] = $userData?->class;
                        $nestedData['address'] = $userData?->address;
                        $nestedData['zip_code'] = $userData?->zip_code;
                        $nestedData['country_id'] = $userData?->country?->name;
                        $nestedData['state_id'] = $userData?->state?->name;
                        $nestedData['city_id'] = $userData?->city?->name;
                        $data[] = $nestedData;
                        $nestedData = [];
                    }
                }
                $jsonData = array(
                    "draw" => (int) $request->input('draw'),
                    "recordsTotal" => (int) $totalData,
                    "recordsFiltered" => (int) $totalFiltered,
                    "data" => $data,
                );
                return response()->json($jsonData);
            } catch (\Exception $e) {
                logger($e->getMessage() . ' on ' . $e->getFile() . ' line number ' . $e->getLine());
                return $jsonData = array(
                    "draw" => (int) $request->input('draw'),
                    "recordsTotal" => (int) 0,
                    "recordsFiltered" => (int) 0,
                    "data" => []
                );
            }
        }
        abort(405);
    }
    public function fetchUserParentDetails(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                $filterConditions = collect([]);
                $filterConditions = $filterConditions->merge(['id' => $id]);

                $totalData = $this->userManagmentContract->getParentDetailsTotalData($filterConditions->toArray());
                $totalFiltered = 0;
                // $totalFiltered = $totalData;
                $limit = $request->input('length');
                $start = $request->input('start');
                $order = 'id';
                $dir = 'desc';
                $index = $start;
                $nestedData = [];
                $data = [];
                if (empty($request->input('search.value'))) {
                    $userParentDetails = $this->userManagmentContract->getListofParentDetails($filterConditions->toArray(), $start, $limit, $order, $dir);
                } else {
                    $search = $request->input('search.value');
                    $userParentDetails = $this->userManagmentContract->getListofParentDetails($filterConditions->toArray(), $start, $limit, $order, $dir, $search);
                    $totalFiltered = $this->userManagmentContract->getParentDetailsTotalData($filterConditions->toArray(), $search);
                }

                if (!empty($userParentDetails)) {
                    foreach ($userParentDetails as $userData) {
                        $image = url('/') . '/uploads/' . $userData?->profile_img;
                        $index++;
                        $nestedData['sr'] = '<p>' . $index . '</p>';
                        $nestedData['id'] = $index;
                        $nestedData['name'] =   $userData->name;
                        $nestedData['relation'] = $userData?->relation->name;
                        $nestedData['phone'] = $userData?->mobile_number;

                        $data[] = $nestedData;
                        $nestedData = [];
                    }
                }
                $jsonData = array(
                    "draw" => (int) $request->input('draw'),
                    "recordsTotal" => (int) $totalData,
                    "recordsFiltered" => (int) $totalFiltered,
                    "data" => $data,
                );
                return response()->json($jsonData);
            } catch (\Exception $e) {
                logger($e->getMessage() . ' on ' . $e->getFile() . ' line number ' . $e->getLine());
                return $jsonData = array(
                    "draw" => (int) $request->input('draw'),
                    "recordsTotal" => (int) 0,
                    "recordsFiltered" => (int) 0,
                    "data" => []
                );
            }
        }
        abort(405);
    }

    public function addUserDetails(Request $request)
    {
        $this->setPageTitle('Add User');
        $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'class' => 'required|integer',
            'zip_code' => 'required|string',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'address' => 'required|string',
            'f' => 'required|array',
            'f.*.name' => 'required|string',
            'f.*.phone' => 'required|string',
            'f.*.relation' => 'required|integer|exists:relations,id',
        ]);
        DB::beginTransaction();
        try {
            $insertArry = $request->except(['_token', '_method', 'id']);
            $isUserCreated = $this->userManagmentContract->createUser($insertArry);
            if ($isUserCreated) {
                DB::commit();
                return $this->responseRedirect('user.list', 'user Created Successfully', 'success', false);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseRedirectBack('Something went wrong', 'error', true);
        }
    }

    public function getStateByCountry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:countries,id',
        ]);
        if ($validator->fails()) return $this->responseJson(false, 200, $validator->errors()->first(), '');
        try {
            $isState = State::where('country_id', $request->id)->get();
            if ($isState) {
                return $this->responseJson(true, 200, "State found successfully", $isState);
            } else {
                return $this->responseJson(false, 200, "State not found");
            }
        } catch (\Exception $e) {
            logger($e->getMessage() . 'on' . $e->getFile() . 'in' . $e->getLine());
            return $this->responseJson(false, 500, "Something went wrong");
        }
    }

    public function getCityByState(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:states,id',
        ]);
        if ($validator->fails()) return $this->responseJson(false, 200, $validator->errors()->first(), '');
        try {
            $isCity = City::where('state_id', $request->id)->get();
            if ($isCity) {
                return $this->responseJson(true, 200, "City found successfully", $isCity);
            } else {
                return $this->responseJson(false, 200, "City not found");
            }
        } catch (\Exception $e) {
            logger($e->getMessage() . 'on' . $e->getFile() . 'in' . $e->getLine());
            return $this->responseJson(false, 500, "Something went wrong");
        }
    }

    public function relations()
    {
        $relations = Relation::all(['id', 'name']);
        return response()->json($relations);
    }
}
