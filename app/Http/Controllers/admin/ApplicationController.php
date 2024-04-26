<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //
    public function index()
    {
        $applicationData = Application::all();
        return response()->json($applicationData);
    }
}
