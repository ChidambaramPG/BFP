<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	public function get_notifications() {

		$this->load->model('Notificationmodel');
		$result = $this->Notificationmodel->getAllNotification();

		echo json_encode($result->result_array());

	}
}
