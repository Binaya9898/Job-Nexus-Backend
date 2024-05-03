<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;


class EmployeeController extends Controller
{
    //
    public function list()
    {
        $employeeData = Employee::all();
        return view('admin.modules.employee.listemployee', compact('employeeData'));
    }

    public function edit()
    {
        return view('admin.modules.employee.editemployee');
    }
    public function index()
    {
        return view('admin.modules.employee.addemployee');
    }

    public function save(Request $req)
    {
        $employeeData = new Employee();
        $employeeData->fill($req->all());
        //profile picture
        $newThumbnailImageName = time() . '.' . $req->file('employee_image')->getClientOriginalName();
        $req->employee_image->move(public_path('images/employee/profile'), $newThumbnailImageName);
        $employeeData->employee_image = $newThumbnailImageName;

        //cv
        $newThumbnailImageName2 = time() . '.' . $req->file('employee_cv')->getClientOriginalName();
        $req->employee_cv->move(public_path('images/employee/cv'), $newThumbnailImageName2);
        $employeeData->employee_cv = $newThumbnailImageName2;
        $employeeData->employee_slug = $employeeData->employee_first_name;
        $employeeData->employee_status = "Inactive";
        $employeeData->save();
        return view('admin.modules.employee.addemployee');
    }
}
