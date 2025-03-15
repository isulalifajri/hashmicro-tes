<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $users = User::where('role','customer')->orderBy('created_at', 'DESC')->paginate(10);
        $title = 'Data Customer';
        return view('backend.page.customer.customer', compact(
            'users', 'title'
        ));
    }
}
