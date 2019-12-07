<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_create_users extends CI_Migration {
	
	public function up() {
        $this->dbforge->add_field(
			[
				'id' => [
					'type' => 'INT',
					// 'constraint' => 11,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				],
				'name' => [
					'type' => 'VARCHAR',
					'constraint' => '100',
				],
				'username' => [
					'type' => 'VARCHAR',
					'constraint' => '100',
				],
				'email' => [
					'type' => 'VARCHAR',
					'constraint' => '100',
				],
				'password' => [
					'type' => 'VARCHAR',
					'constraint' => '128',
				],
				'role_id' => [
					'type' => 'TINYINT',
				],
				'status' => [
					'type' => 'TINYINT',
				],
				'token' => [
					'type' => 'VARCHAR',
					'constraint' => '200',
				],
				'created_at' => [
					'type' => 'INT',
					'constraint' => '11',
				],
				'updated_at' => [
					'type' => 'INT',
					'constraint' => '11',
				],
			]
        );
        $this->dbforge->add_key('id');
        $this->dbforge->create_table('users');
    }
    
    public function down() {
        $this->dbforge->drop_table('users');
    }

}
