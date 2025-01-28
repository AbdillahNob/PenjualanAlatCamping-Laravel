<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $data = User::where('status','customer')->get();
        $no=1;

        return view('admin.customer.index', compact('data','no'));
    }
}