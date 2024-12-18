<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    // Nama tabel di database
    protected $table = 'products';

    // Primary key dari tabel
    protected $primaryKey = 'id';

    // Field yang diizinkan untuk diisi
    protected $allowedFields = ['name', 'description', 'price', 'quantity'];


    // Pesan kesalahan untuk validasi
    public $validationMessages = [
        'name' => [
            'required' => 'Nama produk harus diisi.',
            'min_length' => 'Nama produk minimal 3 karakter.',
        ],
        'description' => [
            'required' => 'Deskripsi produk harus diisi.',
        ],
        'price' => [
            'required' => 'Harga harus diisi.',
            'numeric' => 'Harga harus berupa angka.',
        ],
        'quantity' => [
            'required' => 'Jumlah harus diisi.',
            'integer' => 'Jumlah harus berupa angka bulat.',
        ],
    ];

    // Jika Anda ingin menggunakan fitur validasi otomatis
    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'description' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ];
}