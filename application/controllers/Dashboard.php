<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index() {

		if ($this->ion_auth->logged_in()) {

			$this->load->view('dashboard_common/header');
			$this->load->view('dashboard');
			$this->load->view('dashboard_common/footer');

		} else {

			$this->load->view('common/header');
			$this->load->view('login');
			$this->load->view('common/footer');

		}

	}

}
