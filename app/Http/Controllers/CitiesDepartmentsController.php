<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Department;

class CitiesDepartmentsController extends Controller
{
    public function getCities(int $id)
    {
        $array = array(
            'id' => 0,
            'name' => "Selecciona una ciudad"
        );
        $cities = City::where('department', $id)->get();
        $cities->prepend($array);
        return json_encode($cities);
    }

    public function getDepartments()
    {
        $array = array(
            'id' => 0,
            'name' => "Selecciona un departamento"
        );
        $departments = Department::select('id', 'name')->get();
        $departments->prepend($array);
        return json_encode($departments);
    }
}
