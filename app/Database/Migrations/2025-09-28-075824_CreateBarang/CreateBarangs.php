<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode_barang' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'kategori' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'jumlah' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'satuan' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'lokasi' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'gambar' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('kode_barang');
        $this->forge->createTable('barangs');
    }

    public function down()
    {
        $this->forge->dropTable('barangs');
    }
}
