<?php

use App\Models\Country;
use App\Models\Relation;
use App\Models\User\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('isSluggable')) {
    function isSluggable($value)
    {
        return Str::slug($value);
    }
}
// ****************************************************************************************
if (!function_exists('uuidtoid')) {
    function uuidtoid($uuid, $table)
    {
        $dbDetails = DB::table($table)
            ->select('id')
            ->where('uuid', $uuid)->first();
        if ($dbDetails) {
            return $dbDetails->id;
        } else {
            abort(404);
        }
    }
}
// ****************************************************************************************
if (!function_exists('slugtoname')) {
    function slugtoname($slug, $table)
    {
        $dbDetails = DB::table($table)
            ->select('name')
            ->where('slug', $slug)->first();
        if ($dbDetails) {
            return $dbDetails->name;
        } else {
            abort(404);
        }
    }
}
// ****************************************************************************************
if (!function_exists('getCountry')) {
    function getCountry($id)
    {
        $data = Country::all();
        foreach ($data as $key => $val) {
            if ($id == $val->id) {
                echo "<option value='" . $val->id . "' selected>" . $val->name . "</option>";
            } else {
                echo "<option value='" . $val->id . "' >" . $val->name . "</option>";
            }
        }
    }
}
// ****************************************************************************************
if (!function_exists('getRelation')) {
    function getRelation($id)
    {
        $data = Relation::all();
        foreach ($data as $key => $val) {
            if ($id == $val->id) {
                echo "<option value='" . $val->id . "' selected>" . $val->name . "</option>";
            } else {
                echo "<option value='" . $val->id . "' >" . $val->name . "</option>";
            }
        }
    }
}
// ****************************************************************************************

function uploadImage($image, $folder = 'uploads')
{
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path($folder), $imageName);
    return  $imageName;
}
