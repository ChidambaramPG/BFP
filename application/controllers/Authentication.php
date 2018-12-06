<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function index() {

		$this->load->view('auth/login');

	}

	public function login() {

		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		$remember = TRUE;

		$result = $this->ion_auth->login($username, $password, $remember);

		// echo $result;

		$login_result = [];

		if ($result == 1) {
			array_push($login_result, 'success');
		} else {
			array_push($login_result, 'failed');
		}

		echo json_encode($login_result);

	}

	public function logout() {
		$result = $this->ion_auth->logout();
		echo $result;
	}

	public function register() {

		$username = $this->input->post('username');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$group = 2;

		switch ($level) {
		case "standard":
			$group = 2;
			break;
		case "stage 4":
			$group = 4;
			break;
		case "qc":
			$group = 3;
			break;
		}

		$additional_data = array(
			'first_name' => $firstname,
			'last_name' => $lastname,
		);

		$result = $this->ion_auth->register($username, $password, $email, $additional_data, [$group]);
		echo $result;
	}

	public function fetch_users() {
		$data['users'] = $this->ion_auth->users()->result();

		foreach ($data['users'] as $k => $user) {
			$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}

		echo json_encode($data);

	}

	public function delete_user() {
		$id = $this->input->post('id');
		$result = $this->ion_auth->delete_user($id);

		echo $result;
	}

	public function edit_user_details() {

		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$group = 2;

		switch ($level) {
		case "standard":
			$group = 2;
			break;
		case "stage 4":
			$group = 4;
			break;
		case "qc":
			$group = 3;
			break;
		}

		$additional_data = array(
			'username' => $username,
			'first_name' => $firstname,
			'last_name' => $lastname,
			'email' => $email,
		);

		// echo json_encode($additional_data);

		$this->ion_auth->update($id, $additional_data);

		$result = $this->ion_auth->reset_password($username, $password);

		echo $result;

	}

	public function reset_password() {

		$password = $this->input->post('password');
		$username = $this->ion_auth->user()->row()->username;
		$result = $this->ion_auth->reset_password($username, $password);

		echo $result;
	}

	public function change_status() {

		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$additional_data = array(
			'active' => $status,
		);

		$this->ion_auth->update($id, $additional_data);

	}

}
