<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductTable extends Migration
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
            'nombre'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'descripcion'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'precio'       => [
                'type'           => 'FLOAT',
            ],
            'stock'        => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'id_categoria' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
            ],
            'id_usuario'   => [
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
        $this->forge->addForeignKey('id_categoria', 'categoria', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id');
        $this->forge->createTable('producto');
    }

    public function down()
    {
        $this->forge->dropTable('producto');
    }
}
