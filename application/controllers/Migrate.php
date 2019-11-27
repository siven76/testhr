<?php

class Migrate extends CI_Controller
{
	public function index($version = NULL)
	{
		$this->load->library('migration');

		if(isset($version) && ($this->migration->version($version) === FALSE))
		{
			show_error($this->migration->error_string());
		}
		elseif(is_null($version) && $this->migration->latest() === FALSE)
		{
			show_error($this->migration->error_string());
		}
		else
		{
			echo 'The migration has concluded successfully.';
		}
		$this->addDummyRowsIfEmpty();
	}

	private function addDummyRowsIfEmpty()
	{
		if($this->db->from("employees")->count_all_results() === 0)
		{
			$this->db->insert('employees', array(
				'first_name' => 'Cristiano',
				'last_name' => 'Ronaldo',
				'email' => 'cronaldo@gmail.com',
				'telephone_number' => '232323',
				'address' => 'Italy',
				'position_name' => 'Striker'
			));

			$this->db->insert('employees', array(
				'first_name' => 'Lionel',
				'last_name' => 'Messi',
				'email' => 'lmessi@gmail.com',
				'telephone_number' => '343434',
				'address' => 'Spain',
				'position_name' => 'Forward'
			));

			$this->db->insert('employees', array(
				'first_name' => 'Paul',
				'last_name' => 'Pogba',
				'email' => 'ppogba@gmail.com',
				'telephone_number' => '232322',
				'address' => 'England',
				'position_name' => 'Midfielder'
			));
		}
	}
}
