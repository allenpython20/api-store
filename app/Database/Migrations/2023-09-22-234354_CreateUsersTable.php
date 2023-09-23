<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'nombre'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'token'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'id_rol'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'created_at'   => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'   => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at'   => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_rol','rol','id');
        $this->forge->createTable('usuario');
    }

    public function down()
    {
        $this->forge->dropTable('usuario');
    }
}
