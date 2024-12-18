<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionProductModel extends Model
{
    protected $table = 'transaction_products';
    protected $primaryKey = 'id'; // Pastikan Anda memiliki primary key
    protected $allowedFields = ['transaction_id', 'product_id', 'quantity', 'total_price'];
}