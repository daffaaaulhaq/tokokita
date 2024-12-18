<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    // protected $allowedFields = [
    //     'customer_name', // Tambahkan ini
    //     'payment_status', // Tambahkan ini
    //     'transaction_date',
    //     'grand_total',
    // ];
    protected $allowedFields = ['description', 'customer_name', 'transaction_date', 'payment_status', 'grand_total'];

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false; // Ubah ini menjadi true jika ingin menggunakan timestamps
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'customer_name' => 'required',
        'payment_status' => 'required',
        'grand_total' => 'required|decimal',
        'transaction_date' => 'required|valid_date',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}