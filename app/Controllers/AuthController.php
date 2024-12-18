<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use App\Libraries\CIAuth;

class AuthController extends BaseController
{
    protected $helpers = ['url', 'form'];

    public function loginForm()
    {
        $data = [
            'pageTitle' => 'Login',
            'validation' => null
        ];
        return view('backend/pages/auth/login', $data);
    }

    public function loginHandler()
    {
        // Menentukan tipe input apakah email atau username
        $fieldType = filter_var($this->request->getVar('login_id'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Aturan validasi
        $validationRules = [
            'login_id' => [
                'rules' => 'required|is_not_unique[users.' . $fieldType . ']',
                'errors' => [
                    'required' => ucfirst($fieldType) . ' dibutuhkan!',
                    'is_not_unique' => ucfirst($fieldType) . ' tidak ditemukan dalam sistem!'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[60]',
                'errors' => [
                    'required' => 'Password dibutuhkan!',
                    'min_length' => 'Password harus memiliki minimal 6 karakter!',
                    'max_length' => 'Password tidak boleh lebih dari 60 karakter!'
                ]
            ]
        ];

        // Validasi input
        if (!$this->validate($validationRules)) {
            return view('backend/pages/auth/login', [
                'pageTitle' => 'Login',
                'validation' => $this->validator
            ]);
        }

        // Proses login
        $user = new User();
        $userInfo = $user->where($fieldType, $this->request->getVar('login_id'))->first();

        if (!$userInfo) {
            return redirect()->route('admin.login.form')
                ->with('fail', ucfirst($fieldType) . ' tidak ditemukan!')
                ->withInput();
        }

        // Verifikasi password
        $inputPassword = $this->request->getVar('password');
        if (!password_verify($inputPassword, $userInfo['password'])) {
            return redirect()->route('admin.login.form')
                ->with('fail', 'Password salah!')
                ->withInput();
        }

        // Simpan sesi dengan CIAuth
        CIAuth::setCIAuth($userInfo);

        return redirect()->route('admin.home');
    }
}
