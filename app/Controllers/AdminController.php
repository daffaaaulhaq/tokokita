<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;

class AdminController extends BaseController
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Dashboard',
        ];
        return view('backend/pages/home', $data);
    }

    public function logoutHandler()
    {
        CIAuth::forget(); // Logout menggunakan CIAuth
        return redirect()->route('admin.login.form')->with('success', 'Berhasil logout!');
    }

    public function profile()
    {
        $data = array(
            'pageTitle'=>'Profile'
        );
        return view('backend/pages/profile', $data);
    }

    public function categories(){
        $data = [
            'pageTitle'=>'Categories'
        ];
        return view('backend/pages/categories', $data);
    }
}
