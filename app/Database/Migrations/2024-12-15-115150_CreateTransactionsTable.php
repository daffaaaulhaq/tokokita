<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionsTable extends Migration
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
            'description' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'transaction_date' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null,
            ],
            'payment_status' => [
                'type'       => "ENUM('Paid','Unpaid')",
                'null'       => false,
                'default'    => 'Unpaid',
            ],
            'grand_total' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,0',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
