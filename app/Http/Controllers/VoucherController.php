<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //

    public function index(){

    }

    public function create(){
        return view('admin.voucher.add_form',[]);
    }

}
