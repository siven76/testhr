<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Employees extends REST_Controller
{
	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->model('employees_model');
	}

	public function index_get($id = null)
	{
		// if id is null, return a collection of all employees
		if (is_null($id)) {
			$employees = $this->employees_model->get_employees();
			return $this->response($employees, 200);
		}

		// check if id is a number
		if (!is_numeric($id)) {
			return $this->response(array(
				'status' => false,
				'message' => 'Invalid ID',
			), self::HTTP_NOT_FOUND);
		}

		// get employee record
		$employee = $this->employees_model->get_employee_by_id($id);

		// if employee record is not found, return error
		if (!$employee) {
			return $this->response(array(
				'status' => false,
				'message' => 'User not found',
			), self::HTTP_NOT_FOUND);
		}

		// if employee record is found, return JSON response
		return $this->response($employee, self::HTTP_OK);
	}

	public function index_post()
	{
		// get data from post
		$data = $this->post();

		// check if the post has all the required parameters
		if (!isset($data['first_name']) || !isset($data['last_name']) || !isset($data['position_name'])) {
			return $this->response(array(
				'status' => false,
				'message' => 'Missing one or more required parameters',
			), self::HTTP_BAD_REQUEST);
		}

		// if yes, insert new row in employees table
		$result = $this->employees_model->add_employee($data);

		// check if the record has not been inserted
		if (!$result) {
			return $this->response(array(
				'status' => false,
				'message' => 'Unable to add the record'
			), self::HTTP_EXPECTATION_FAILED);
		}

		// return result in JSON
		return $this->response(array(
			'status' => true,
			'message' => 'OK',
			'rows_inserted' => (int)$result,
		), self::HTTP_CREATED);
	}
}
