<?php
namespace App\Libraries;
use App\Models\User;

class CIAuth
{
    // Set session user
    public static function setCIAuth($result)
    {
        $session = session();
        $session->set([
            'logged_in' => true,
            'userdata' => $result
        ]);
    }

    // Dapatkan ID pengguna
    public static function id()
    {
        $session = session();
        if (self::check() && $session->has('userdata')) {
            return $session->get('userdata')['id'] ?? null;
        }
        return null;
    }

    // Periksa apakah pengguna sudah login
    public static function check()
    {
        $session = session();
        return $session->has('logged_in') && $session->get('logged_in') === true;
    }

    // Hapus sesi pengguna
    public static function forget()
    {
        $session = session();
        $session->remove(['logged_in', 'userdata']);
    }

    // Ambil data pengguna
    public static function user()
    {
        $session = session();
        if (self::check()) {
            return $session->get('userdata') ?? null;
        }
        return null;
    }
}
