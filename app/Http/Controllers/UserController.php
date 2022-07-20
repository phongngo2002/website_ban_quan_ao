<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){

    }

    public function create(){
        return view('admin.user.add_form',[]);
    }
}
