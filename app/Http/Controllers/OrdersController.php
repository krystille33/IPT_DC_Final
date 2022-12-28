<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index(){
        return view('orders.index');
    }

    public function userOnly(){
        $users = Shoe::get();
        return view('orders.index', compact('users'));
    }

    public function showOrder($id){
        $user = User::find($id);
        return view('orders.index', compact('id', 'user'));
    }
}
