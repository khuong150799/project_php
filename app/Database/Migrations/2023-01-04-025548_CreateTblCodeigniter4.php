<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblCodeigniter4 extends Migration
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
            'fullname' => [
                'type'       => 'VARCHAR',
                'null' => false,
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => '255',
            ],
            'phone' => [
                'type' => 'INT',
                'null' => false,
                'constraint' => '11',
            ],
            'address' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => '255',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => '255',
            ],
            'thumb' => [
                'type' => 'VARCHAR',
                'null' => true,
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'BIGINT',
                'null' => true,
                'constraint' => '20',
            ],
            'updated_at' => [
                'type' => 'BIGINT',
                'null' => true,
                'constraint' => '20',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
