<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'transaction_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'total_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,0',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->addForeignKey('transaction_id', 'transactions', 'id', 'CASCADE', 'CASCADE'); // Foreign Key ke tabel transaksi
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');         // Foreign Key ke tabel produk
        $this->forge->createTable('transaction_products');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_products');
    }
}
