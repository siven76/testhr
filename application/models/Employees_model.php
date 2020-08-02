<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employees_model extends CI_Model
{
	const TABLE_NAME = 'employees';

	/**
	 * Get an employee record given an id
	 *
	 * @param $id
	 * @return CI_DB_result
	 */
	public function get_employee_by_id($id)
	{
		$query = $this->db->get_where(self::TABLE_NAME, array('id' => $id));

		return $query->row_array();
	}

	/**
	 * Get all employee records [with pagination]
	 *
	 * @return CI_DB_result
	 */
	public function get_employees()
	{
		$query = $this->db->get(self::TABLE_NAME);

		return $query->result_array();
	}

	/**
	 * Add an employee record
	 *
	 * @param array $data
	 * @return bool
	 */
	public function add_employee($data)
	{
		return $this->db->insert(self::TABLE_NAME, $data);
	}
}
