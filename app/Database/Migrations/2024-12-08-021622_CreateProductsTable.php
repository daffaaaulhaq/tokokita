<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        // Membuat tabel 'products'
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        
        // Menambahkan primary key pada kolom 'id'
        $this->forge->addKey('id', true);

        // Membuat tabel
        $this->forge->createTable('products');
    }

    public function down()
    {
        // Drop tabel 'products' jika rollback
        $this->forge->dropTable('products');
    }
}
