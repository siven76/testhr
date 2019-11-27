<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_employees extends CI_Migration
{
	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
	}

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'first_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
			),
			'last_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '320',
				'null' => TRUE
			),
			'telephone_number' => array(
				'type' => 'VARCHAR',
				'constraint' => '30',
				'null' => TRUE
			),
			'address' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'position_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150'
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('employees');
	}

	public function down()
	{
		$this->dbforge->drop_table('employees');
	}
}
