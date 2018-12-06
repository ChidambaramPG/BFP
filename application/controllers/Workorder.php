<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workorder extends CI_Controller {

	public function new_workorder() {

		$equipment_num = $this->input->post("equipment_num");

		$location = $this->input->post("location");

		$option = $this->input->post("option");

		$due_date = $this->input->post("due_date");

		$description = $this->input->post("description");

		$id = $this->ion_auth->get_user_id();

		$user = $this->ion_auth->user()->row();

		$time = strtotime($due_date);

		$newformat = date('Y-m-d', $time);

		$eqipment_id = $this->input->post("eqipment_id");

		$users = $this->ion_auth->users()->result();

		$issuedToQA = 0;

		$group = 0;

		foreach ($users as $user) {

			if ($user->username == $option) {

				$group = $this->ion_auth->get_users_groups($user->id)->result()[0];

				$group = json_decode(json_encode($group), True)['id'];

			}

		}

		if ($group == '3') {

			$issuedToQA = 1;

		}

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->saveNewOrder($equipment_num, $eqipment_id, $location, $option, $issuedToQA, $newformat, $description, $this->ion_auth->user()->row()->username);

		$this->load->model('Equipmentmodel');

		$this->Equipmentmodel->increaseTotoalRequest($eqipment_id);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'New order created by ' . $user->username);

		echo $result;

	}

	public function new_work_orders() {

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->new_work_orders();

		echo json_encode($result->result_array());

	}

	public function all_work_orders() {

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->all_work_orders();

		echo json_encode($result->result_array());

	}

	public function upload_new_wo_image() {

		$id = $this->input->post('id');

		$config['upload_path'] = "./uploads/workorders/" . $id;

		$config['allowed_types'] = 'jpg|png|pdf|mp4|avi';

		$this->load->library('upload');

		$this->upload->initialize($config);

		if (!is_dir('./uploads/workorders/' . $id)) {

			mkdir('./uploads/workorders/' . $id, 0777, true);

		}

		if (!$this->upload->do_upload('file')) {

			$error = array('error' => $this->upload->display_errors());

			$result = $error;

			echo json_encode($result);

		} else {

			$data = array('upload_data' => $this->upload->data());

			$this->load->model('Workordermodel');

			$result = $this->Workordermodel->addWorkOrderImage($id, $data['upload_data']['file_name']);

			echo $result;

		}

	}

	public function complete_wo_order() {

		$verif = $this->input->post('verif');

		$desc = $this->input->post('gen_desc');

		$id = $this->input->post('id');

		$issued = $this->input->post('issued_by');

		// echo $id;

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->addWorkOrderSignatures($id, $verif, $desc, $issued);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Work order completed by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function get_completed_orders() {

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->completed_work_orders();

		echo json_encode($result->result_array());

	}

	public function order_submit_for_qa() {

		if ($this->input->post('qa_hold') == 'true') {

			$qa_hold = 1;

		} else {

			$qa_hold = 0;

		}

		if ($this->input->post('qa_inspection') == 'true') {

			$qa_inspect = 1;

		} else {

			$qa_inspect = 0;

		}

		if ($this->input->post('empl_saft_haz') == 'true') {

			$emply_haz = 1;

		} else {

			$emply_haz = 0;

		}

		$assigned_to = $this->input->post('assigned_to');

		$desc = $this->input->post('gen_desc');

		$id = $this->input->post('id');

		// echo $qa_hold;

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->addWorkOrderForQA($qa_hold, $qa_inspect, $emply_haz, $assigned_to, $desc, $id);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Work order submitted to ' . $assigned_to . ' by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function get_pending_orders() {

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->pending_work_orders();

		echo json_encode($result->result_array());

	}

	public function complete_wo_qc() {

		// echo json_encode($this->input->post());

		if ($this->input->post('qa_wash') == 'true') {

			$qa_wash = 1;

		} else {

			$qa_wash = 0;

		}

		if ($this->input->post('qa_eqip_inspec') == 'true') {

			$qa_eqip_inspec = 1;

		} else {

			$qa_eqip_inspec = 0;

		}

		if ($this->input->post('qa_qc_inspec') == 'true') {

			$qa_qc_inspec = 1;

		} else {

			$qa_qc_inspec = 0;

		}

		$correc_desc = $this->input->post('correc_desc');

		$correc_sign = $this->input->post('correc_sign');

		$id = $this->input->post('id');

		$tracking = $this->input->post('tracking');

		// echo $correc_sign;

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->addWorkOrderQAReport($qa_wash, $qa_eqip_inspec, $qa_qc_inspec, $correc_desc, $correc_sign, $id, $tracking);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Quality checks done for order no ' . $id . ' by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function verify_and_complete_wo() {

		$verif = $this->input->post('verif');

		$id = $this->input->post('id');

		// echo $id;

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->completeWorkOrder($id, $verif);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Order verified by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function get_overdue_orders() {

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->overdue_work_orders();

		echo json_encode($result->result_array());

	}

	public function edit_report() {

		// $from = $this->input->post('from');

		// $from_date = date('Y-m-d', strtotime($from));

		// echo $from_date;

		// echo json_encode($this->input->post());

		$from = $this->input->post('from');

		$to = $this->input->post('to');

		$code = $this->input->post('code');

		$supersedes_date = $this->input->post('sup');

		$version = $this->input->post('version');

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->editReport($from, $to, $code, $supersedes_date, $version);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Reports editted by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function admin_edit_order() {

		// echo json_encode($this->input->post());

		$issue_date = $this->input->post("issue_date");

		$wo_number = $this->input->post("wo_number");

		$eqp_number = $this->input->post("eqp_number");

		$location = $this->input->post("location");

		$option = $this->input->post("option");

		$due_date = $this->input->post("due_date");

		$description = $this->input->post("description");

		$corr_description = $this->input->post("corr_description");

		$approved_by = $this->input->post("approved_by");

		$approve_date = $this->input->post("approve_date");

		$comments = $this->input->post("comments");

		$assigned_to = $this->input->post("assigned_to");

		$qa_hold = $this->input->post("qa_hold");

		if ($qa_hold == 'on') {

			$qa_hold = 1;

		} else {

			$qa_hold = 0;

		}

		$qa_inspection = $this->input->post("qa_inspection");

		if ($qa_inspection == 'on') {

			$qa_inspection = 1;

		} else {

			$qa_inspection = 0;

		}

		$emply_safety_haz = $this->input->post("emply_safety_haz");

		if ($emply_safety_haz == 'on') {

			$emply_safety_haz = 1;

		} else {

			$emply_safety_haz = 0;

		}

		$corrected_on = $this->input->post("corrected_on");

		$corrected_by = $this->input->post("corrected_by");

		$verified_by = $this->input->post("verified_by");

		$verified_on = $this->input->post("verified_on");

		$eq_wash = $this->input->post("eq_wash");

		$qa_formed = $this->input->post("qa_formed");

		$qa_qc_inspec = $this->input->post("qa_qc_inspec");

		$id = $this->input->post("id");

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->adminEditWorkOrder($id, $issue_date, $wo_number, $eqp_number, $location, $option, $due_date, $description, $corr_description, $approved_by, $approve_date, $comments, $assigned_to, $qa_hold, $qa_inspection, $emply_safety_haz, $corrected_on, $eq_wash, $qa_formed, $qa_qc_inspec, $corrected_by, $verified_by);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Order editted by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function admin_complete_order() {

		// echo json_encode($this->input->post());

		$issue_date = $this->input->post("issue_date");

		$wo_number = $this->input->post("wo_number");

		$eqp_number = $this->input->post("eqp_number");

		$location = $this->input->post("location");

		$option = $this->input->post("option");

		$due_date = $this->input->post("due_date");

		$description = $this->input->post("description");

		$corr_description = $this->input->post("corr_description");

		$approved_by = $this->input->post("approved_by");

		$approve_date = $this->input->post("approve_date");

		$comments = $this->input->post("comments");

		$assigned_to = $this->input->post("assigned_to");

		$qa_hold = $this->input->post("qa_hold");

		if ($qa_hold == 'on') {

			$qa_hold = 1;

		} else {

			$qa_hold = 0;

		}

		$qa_inspection = $this->input->post("qa_inspection");

		if ($qa_inspection == 'on') {

			$qa_inspection = 1;

		} else {

			$qa_inspection = 0;

		}

		$emply_safety_haz = $this->input->post("emply_safety_haz");

		if ($emply_safety_haz == 'on') {

			$emply_safety_haz = 1;

		} else {

			$emply_safety_haz = 0;

		}

		$corrected_on = $this->input->post("corrected_on");

		$corrected_by = $this->input->post("corrected_by");

		$verified_by = $this->input->post("verified_by");

		$verified_on = $this->input->post("verified_on");

		$eq_wash = $this->input->post("eq_wash");

		$qa_formed = $this->input->post("qa_formed");

		$qa_qc_inspec = $this->input->post("qa_qc_inspec");

		$id = $this->input->post("id");

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->adminCompleteWorkOrder($id, $issue_date, $wo_number, $eqp_number, $location, $option, $due_date, $description, $corr_description, $approved_by, $approve_date, $comments, $assigned_to, $qa_hold, $qa_inspection, $emply_safety_haz, $corrected_on, $eq_wash, $qa_formed, $qa_qc_inspec, $corrected_by, $verified_by);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Order completed by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function admin_qc_complete_order() {

		// echo json_encode($this->input->post());

		$issue_date = $this->input->post("issue_date");

		$wo_number = $this->input->post("wo_number");

		$eqp_number = $this->input->post("eqp_number");

		$location = $this->input->post("location");

		$option = $this->input->post("option");

		$due_date = $this->input->post("due_date");

		$description = $this->input->post("description");

		$corr_description = $this->input->post("corr_description");

		$approved_by = $this->input->post("approved_by");

		$approve_date = $this->input->post("approve_date");

		$comments = $this->input->post("comments");

		$assigned_to = $this->input->post("assigned_to");

		$qa_hold = $this->input->post("qa_hold");

		if ($qa_hold == 'on') {

			$qa_hold = 1;

		} else {

			$qa_hold = 0;

		}

		$qa_inspection = $this->input->post("qa_inspection");

		if ($qa_inspection == 'on') {

			$qa_inspection = 1;

		} else {

			$qa_inspection = 0;

		}

		$emply_safety_haz = $this->input->post("emply_safety_haz");

		if ($emply_safety_haz == 'on') {

			$emply_safety_haz = 1;

		} else {

			$emply_safety_haz = 0;

		}

		$corrected_on = $this->input->post("corrected_on");

		$corrected_by = $this->input->post("corrected_by");

		$verified_by = $this->input->post("verified_by");

		$verified_on = $this->input->post("verified_on");

		$eq_wash = $this->input->post("eq_wash");

		if ($eq_wash == 'on') {

			$eq_wash = 1;

		} else {

			$eq_wash = 0;

		}

		$qa_formed = $this->input->post("qa_formed");

		if ($qa_formed == 'on') {

			$qa_formed = 1;

		} else {

			$qa_formed = 0;

		}

		$qa_qc_inspec = $this->input->post("qa_qc_inspec");

		if ($qa_qc_inspec == 'on') {

			$qa_qc_inspec = 1;

		} else {

			$qa_qc_inspec = 0;

		}

		$id = $this->input->post("id");

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->adminCompleteWorkOrderQC($id, $issue_date, $wo_number, $eqp_number, $location, $option, $due_date, $description, $corr_description, $approved_by, $approve_date, $comments, $assigned_to, $qa_hold, $qa_inspection, $emply_safety_haz, $corrected_on, $eq_wash, $qa_formed, $qa_qc_inspec, $corrected_by, $verified_by);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Order quality checks done by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function admin_qc_and_verif_order() {

		$issue_date = $this->input->post("issue_date");

		$wo_number = $this->input->post("wo_number");

		$eqp_number = $this->input->post("eqp_number");

		$location = $this->input->post("location");

		$option = $this->input->post("option");

		$due_date = $this->input->post("due_date");

		$description = $this->input->post("description");

		$corr_description = $this->input->post("corr_description");

		$approved_by = $this->input->post("approved_by");

		$approve_date = $this->input->post("approve_date");

		$comments = $this->input->post("comments");

		$assigned_to = $this->input->post("assigned_to");

		$qa_hold = $this->input->post("qa_hold");

		if ($qa_hold == 'on') {

			$qa_hold = 1;

		} else {

			$qa_hold = 0;

		}

		$qa_inspection = $this->input->post("qa_inspection");

		if ($qa_inspection == 'on') {

			$qa_inspection = 1;

		} else {

			$qa_inspection = 0;

		}

		$emply_safety_haz = $this->input->post("emply_safety_haz");

		if ($emply_safety_haz == 'on') {

			$emply_safety_haz = 1;

		} else {

			$emply_safety_haz = 0;

		}

		$corrected_on = $this->input->post("corrected_on");

		$corrected_by = $this->input->post("corrected_by");

		$verified_by = $this->input->post("verified_by");

		$verified_on = $this->input->post("verified_on");

		$eq_wash = $this->input->post("eq_wash");

		$qa_formed = $this->input->post("qa_formed");

		$qa_qc_inspec = $this->input->post("qa_qc_inspec");

		$id = $this->input->post("id");

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->adminCompleteWorkOrderQCVerif($id, $issue_date, $wo_number, $eqp_number, $location, $option, $due_date, $description, $corr_description, $approved_by, $approve_date, $comments, $assigned_to, $qa_hold, $qa_inspection, $emply_safety_haz, $corrected_on, $eq_wash, $qa_formed, $qa_qc_inspec, $corrected_by, $verified_by);

		$this->load->model('Notificationmodel');

		$this->Notificationmodel->saveNotification(1, 1, 'Order quality checks and verification done by ' . $this->ion_auth->user()->row()->username);

		echo $result;

	}

	public function upload_edit_wo_image() {

		$id = $this->input->post('id');

		$config['upload_path'] = "./uploads/workorders/" . $id;

		$config['allowed_types'] = 'pdf|jpg|png|mp4|avi';

		$this->load->library('upload');

		$this->upload->initialize($config);

		if (!is_dir('./uploads/workorders/' . $id)) {

			mkdir('./uploads/workorders/' . $id, 0777, true);

		}

		if (!$this->upload->do_upload('file')) {

			$error = array('error' => $this->upload->display_errors());

			$result = $error;

			echo json_encode($result);

		} else {

			$data = array('upload_data' => $this->upload->data());

			$this->load->model('Workordermodel');

			$result = $this->Workordermodel->addWorkOrderImage($id, $data['upload_data']['file_name']);

			echo $result;

		}

	}

	public function get_order_images() {

		$id = $this->input->post('id');

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->getWoImageList($id);

		echo json_encode($result->result_array());

	}

	public function wo_qc_edit_save_order() {

		// echo json_encode($this->input->post());

		$approved_by = $this->input->post('qc_approved_by');

		$corrected_date = $this->input->post('corrected_on');

		$comments = $this->input->post("comments");

		$qa_wash = $this->input->post("qa_wash");

		$qa_eqip_inspec = $this->input->post("qa_eqip_inspec");

		$qa_qc_inspec = $this->input->post("qa_qc_inspec");

		$status = $this->input->post("status");

		$id = $this->input->post("id");

		$tracking = $this->input->post("tracking");

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->assignedUserEditWorkOrder($id, $approved_by, $corrected_date, $comments, $qa_wash, $qa_eqip_inspec, $qa_qc_inspec, $status, $tracking);

		echo $result;

	}

	public function wo_issuer_complete_order() {

		$verified_by = $this->input->post("verified_by");

		$verified_date = $this->input->post("verified_date");

		$status = $this->input->post("status");

		$id = $this->input->post("id");

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->issuedUserCompleteWorkOrder($verified_by, $verified_date, $status, $id);

		echo $result;

	}

	public function wo_edit_qa_requested_order() {

		// echo json_encode($this->input->post());

		$assign_to = $this->input->post('assigned_to');

		$corr_description = $this->input->post("corr_description");

		$corr_by = $this->input->post("corrected_by");

		$status = $this->input->post("status");

		$qa_hold = $this->input->post("qa_hold");

		$qa_inspection = $this->input->post("qa_inspection");

		$emply_safety_haz = $this->input->post("emp_safety");

		$id = $this->input->post("id");

		if ($status == 'pending') {

			$tracking = $assign_to;

		}

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->issuedUserEditWorkOrder($id, $assign_to, $corr_description, $corr_by, $status, $qa_hold, $qa_inspection, $emply_safety_haz);

		echo $result;

	}

	public function wo_qa_issued_save_order() {

		$issued_by = $this->input->post('issued_by');

		$corr_description = $this->input->post("corr_description");

		$corr_by = $this->input->post("corrected_by");

		$corrected_date = $this->input->post("corrected_date");

		$status = $this->input->post("status");

		$qa_wash = $this->input->post("qa_wash");

		$qa_eqip_inspec = $this->input->post("qa_eqip_inspec");

		$qa_qc_inspec = $this->input->post("qa_qc_inspec");

		$id = $this->input->post("id");

		if ($status == 'approved') {

			$tracking = $issued_by;

		}

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->issuedQAEditWorkOrder($id, $issued_by, $corr_description, $corr_by, $corrected_date, $status, $qa_wash, $qa_eqip_inspec, $qa_qc_inspec);

		echo $result;

	}

	public function wo_edit_save_order() {

		$assign_to = $this->input->post('assigned_to');

		$corr_description = $this->input->post("corr_description");

		$corr_by = $this->input->post("corrected_by");

		$status = $this->input->post("status");

		$qa_hold = $this->input->post("qa_hold");

		$qa_inspection = $this->input->post("qa_inspection");

		$emply_safety_haz = $this->input->post("emp_safety");

		$id = $this->input->post("id");

		if ($status == 'pending') {

			$tracking = $assign_to;

		}

		$users = $this->ion_auth->users()->result();

		$issuedToQA = 0;

		$group = 0;

		foreach ($users as $user) {

			if ($user->username == $assign_to) {

				$group = $this->ion_auth->get_users_groups($user->id)->result()[0];

				$group = json_decode(json_encode($group), True)['id'];

			}

		}

		if ($group == '3') {

			$issuedToQA = 1;

			$this->load->model('Workordermodel');

			$result = $this->Workordermodel->qaRequestedWorkOrder($id, $assign_to, $corr_description, $corr_by, $status, $qa_hold, $qa_inspection, $emply_safety_haz);

			echo $result;

		} else {

			echo 'qa not selected';

		}

	}

	public function wo_edit_requested_order() {

		$issued_by = $this->input->post('issued_by');

		$corr_description = $this->input->post("corr_description");

		$corr_by = $this->input->post("corrected_by");

		$corrected_date = $this->input->post("corrected_date");

		$status = $this->input->post("status");

		$id = $this->input->post("id");

		if ($status == 'approved') {

			$tracking = $issued_by;

		}

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->issuedUserCorrectedWorkOrder($id, $issued_by, $corr_description, $corr_by, $corrected_date, $status, $tracking);

		echo $result;

	}

	public function delete_work_order() {

		$id = $this->input->post('id');

		$this->load->model('Workordermodel');

		$result = $this->Workordermodel->deleteWorkOrder($id);

		echo $result;

	}

}
