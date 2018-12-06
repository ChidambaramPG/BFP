<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workordermodel extends CI_Model {

	function saveNewOrder($eqp_no, $eqipment_id, $location, $option, $issuedToQA, $due, $desc, $sumited_by) {

		$tbl = $this->db->dbprefix('work_order');

		$issue_date = date('Y-m-d');

		$data = array('eqp_no' => $eqp_no, 'location' => $location, 'WO_issue_to' => $option, 'WO_assigned_to' => $option, 'WO_due_date' => $due, 'WO_description' => $desc, 'WO_issued_by' => $sumited_by, 'status' => 'new', 'WO_issue_date' => $issue_date, 'QA_hold' => 0, 'QA_inspection_required' => 0, 'WO_employee_saftey_hazard' => 0, 'WO_equipment_washed' => 0, 'WO_formed' => 0, 'QA_QC_inspection_approval' => 0, 'tracking' => $option, 'equipment_id' => $eqipment_id, 'WO_issue_to_qa' => $issuedToQA);

		$result = $this->db->insert($tbl, $data);

		if ($result == 1) {

			$insert_id = $this->db->insert_id();

			return $insert_id;

		} else {

			return 0;

		}

	}

	function new_work_orders() {

		$this->db->select('*');

		$this->db->from('work_order');

		$this->db->where('status', 'new');

		$query = $this->db->get();

		return $query;

	}

	function getWoImageList($id) {

		$this->db->select('*');

		$this->db->from('work_order_images');

		$this->db->where('WO_id', $id);

		$query = $this->db->get();

		return $query;

	}

	// function addWorkOrderImage($id, $filename) {

	// 	$this->db->select('WO_image');

	// 	$this->db->from('work_order');

	// 	$this->db->where('WO_id', $id);

	// 	$query = $this->db->get();

	// 	$image_array = $query->result_array();

	// 	$images = array();

	// 	foreach ($image_array as $row) {

	// 		array_push($images, $row['WO_image']);

	// 	}

	// 	array_push($images, $filename);

	// 	$this->db->set('WO_image', json_encode($images));

	// 	$this->db->where('WO_id', $id);

	// 	$query2 = $this->db->update('work_order');

	// 	return $query2;

	// }

	function addWorkOrderImage($id, $filename) {

		$tbl = $this->db->dbprefix('work_order_images');

		$data = array('image' => $filename, 'WO_id' => $id, 'added_by' => $this->ion_auth->get_user_id());

		$result = $this->db->insert($tbl, $data);

		return $result;

	}

	function addEditWorkOrderImage($id, $filename) {

		$this->db->select('WO_edit_image');

		$this->db->from('work_order');

		$this->db->where('WO_id', $id);

		$query = $this->db->get();

		$image_array = $query->result_array();

		$images = array();

		foreach ($image_array as $row) {

			array_push($images, $row['WO_edit_image']);

		}

		array_push($images, $filename);

		$this->db->set('WO_edit_image', json_encode($images));

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function all_work_orders() {

		$this->db->select('*');

		$this->db->from('work_order');

		$this->db->where('status !=', 'completed');

		$query = $this->db->get();

		return $query;

	}

	function addWorkOrderSignatures($id, $verif, $desc, $issued) {

		$this->db->set('WO_verified_by', $verif);

		$this->db->set('WO_general_notes', $desc);

		$this->db->set('WO_verified_date', date('Y-m-d'));

		$this->db->set('status', 'completed');

		$this->db->set('tracking', $issued);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function completed_work_orders() {

		$this->db->select('*');

		$this->db->from('work_order');

		$this->db->where('status', 'completed');

		$query = $this->db->get();

		return $query;

	}

	function addWorkOrderForQA($qa_hold, $qa_inspect, $emply_haz, $assigned_to, $desc, $id) {

		$this->db->set('QA_hold', $qa_hold);

		$this->db->set('QA_inspection_required', $qa_inspect);

		$this->db->set('WO_employee_saftey_hazard', $emply_haz);

		$this->db->set('WO_assigned_to', $assigned_to);

		$this->db->set('status', 'pending');

		$this->db->set('tracking', 'QA');

		$this->db->set('WO_general_notes', $desc);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function pending_work_orders() {

		$this->db->select('*');

		$this->db->from('work_order');

		$this->db->where('status', 'pending');

		$this->db->or_where('status', 'approved');

		$query = $this->db->get();

		return $query;

	}

	function addWorkOrderQAReport($qa_wash, $qa_eqip_inspec, $qa_qc_inspec, $correc_desc, $correc_sign, $id, $tracking) {

		$this->db->set('WO_equipment_washed', $qa_wash);

		$this->db->set('WO_formed', $qa_eqip_inspec);

		$this->db->set('QA_QC_inspection_approval', $qa_qc_inspec);

		$this->db->set('WO_corrective_action_description', $correc_desc);

		$this->db->set('WO_corrected_by', $correc_sign);

		$this->db->set('WO_corrected_date', date('Y-m-d'));

		$this->db->set('QC_approved_by', $this->ion_auth->user()->row()->username);

		$this->db->set('status', 'approved');

		$this->db->set('tracking', $tracking);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function completeWorkOrder($id, $verif) {

		$this->db->set('WO_verified_by', $verif);

		$this->db->set('status', 'completed');

		$this->db->set('WO_verified_date', date('Y-m-d'));

		$this->db->where('WO_id', $id);

		$this->db->set('tracking', $this->ion_auth->user()->row()->username);

		$query = $this->db->update('work_order');

		return $query;

	}

	function overdue_work_orders() {

		$this->db->select('*');

		$this->db->from('work_order');

		$this->db->where('WO_due_date <', date('Y-m-d'));

		$this->db->where('status !=', 'completed');

		$query = $this->db->get();

		return $query;

	}

	function editReport($from, $to, $code, $supersedes_date, $version) {

		$this->db->set('supersedes_date', $supersedes_date);

		$this->db->set('code', $code);

		$this->db->set('version', $version);

		$this->db->where('WO_issue_date >', date('Y-m-d', strtotime($from)));

		$this->db->where('WO_issue_date <', date('Y-m-d', strtotime($to)));

		$query = $this->db->update('work_order');

		return $query;

	}

	function adminEditWorkOrder($id, $issue_date, $wo_number, $eqp_number, $location, $option, $due_date, $description, $corr_description, $approved_by, $approve_date, $comments, $assigned_to, $qa_hold, $qa_inspection, $emply_safety_haz, $corrected_on, $eq_wash, $qa_formed, $qa_qc_inspec, $corrected_by, $verified_by) {

		$this->db->set('WO_issue_date', $issue_date);

		$this->db->set('eqp_no', $eqp_number);

		$this->db->set('location', $location);

		$this->db->set('WO_issue_to', $option);

		$this->db->set('WO_due_date', $due_date);

		$this->db->set('WO_assigned_to', $assigned_to);

		$this->db->set('WO_description', $description);

		$this->db->set('WO_corrective_action_description', $corr_description);

		$this->db->set('QC_approved_by', $approved_by);

		$this->db->set('QC_date', $approve_date);

		$this->db->set('WO_general_notes', $comments);

		$this->db->set('QA_hold', $qa_hold);

		$this->db->set('QA_inspection_required', $qa_inspection);

		$this->db->set('WO_employee_saftey_hazard', $emply_safety_haz);

		$this->db->set('WO_equipment_washed', $eq_wash);

		$this->db->set('WO_formed', $qa_formed);

		$this->db->set('QA_QC_inspection_approval', $qa_qc_inspec);

		$this->db->set('status', 'pending');

		$this->db->set('tracking', $assigned_to);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function adminCompleteWorkOrder($id, $issue_date, $wo_number, $eqp_number, $location, $option, $due_date, $description, $corr_description, $approved_by, $approve_date, $comments, $assigned_to, $qa_hold, $qa_inspection, $emply_safety_haz, $corrected_on, $eq_wash, $qa_formed, $qa_qc_inspec, $corrected_by, $verified_by) {

		$this->db->set('WO_issue_date', $issue_date);

		$this->db->set('eqp_no', $eqp_number);

		$this->db->set('location', $location);

		$this->db->set('WO_issue_to', $option);

		$this->db->set('WO_due_date', $due_date);

		$this->db->set('WO_assigned_to', $assigned_to);

		$this->db->set('WO_description', $description);

		$this->db->set('WO_corrective_action_description', $corr_description);

		$this->db->set('QC_approved_by', $approved_by);

		$this->db->set('QC_date', $approve_date);

		$this->db->set('WO_general_notes', $comments);

		$this->db->set('WO_verified_by', $verified_by);

		$this->db->set('QA_hold', $qa_hold);

		$this->db->set('QA_inspection_required', $qa_inspection);

		$this->db->set('WO_employee_saftey_hazard', $emply_safety_haz);

		$this->db->set('WO_equipment_washed', $eq_wash);

		$this->db->set('WO_formed', $qa_formed);

		$this->db->set('QA_QC_inspection_approval', $qa_qc_inspec);

		$this->db->set('status', 'completed');

		$this->db->set('tracking', $this->ion_auth->user()->row()->username);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function adminCompleteWorkOrderQC($id, $issue_date, $wo_number, $eqp_number, $location, $option, $due_date, $description, $corr_description, $approved_by, $approve_date, $comments, $assigned_to, $qa_hold, $qa_inspection, $emply_safety_haz, $corrected_on, $eq_wash, $qa_formed, $qa_qc_inspec, $corrected_by, $verified_by) {

		$this->db->set('WO_issue_date', $issue_date);

		$this->db->set('eqp_no', $eqp_number);

		$this->db->set('location', $location);

		$this->db->set('WO_issue_to', $option);

		$this->db->set('WO_due_date', $due_date);

		$this->db->set('WO_assigned_to', $assigned_to);

		$this->db->set('WO_description', $description);

		$this->db->set('WO_corrective_action_description', $corr_description);

		$this->db->set('QC_approved_by', $approved_by);

		$this->db->set('QC_date', $approve_date);

		$this->db->set('WO_general_notes', $comments);

		$this->db->set('WO_corrected_by', $corrected_by);

		$this->db->set('WO_corrected_date', $corrected_on);

		$this->db->set('QA_hold', $qa_hold);

		$this->db->set('QA_inspection_required', $qa_inspection);

		$this->db->set('WO_employee_saftey_hazard', $emply_safety_haz);

		$this->db->set('WO_equipment_washed', $eq_wash);

		$this->db->set('WO_formed', $qa_formed);

		$this->db->set('QA_QC_inspection_approval', $qa_qc_inspec);

		$this->db->set('status', 'approved');

		$this->db->set('tracking', $this->ion_auth->user()->row()->username);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function adminCompleteWorkOrderQCVerif($id, $issue_date, $wo_number, $eqp_number, $location, $option, $due_date, $description, $corr_description, $approved_by, $approve_date, $comments, $assigned_to, $qa_hold, $qa_inspection, $emply_safety_haz, $corrected_on, $eq_wash, $qa_formed, $qa_qc_inspec, $corrected_by, $verified_by) {

		$this->db->set('WO_issue_date', $issue_date);

		$this->db->set('eqp_no', $eqp_number);

		$this->db->set('location', $location);

		$this->db->set('WO_issue_to', $option);

		$this->db->set('WO_due_date', $due_date);

		$this->db->set('WO_assigned_to', $assigned_to);

		$this->db->set('WO_description', $description);

		$this->db->set('WO_corrective_action_description', $corr_description);

		$this->db->set('QC_approved_by', $approved_by);

		$this->db->set('QC_date', $approve_date);

		$this->db->set('WO_general_notes', $comments);

		$this->db->set('WO_verified_by', $verified_by);

		$this->db->set('WO_corrected_by', $corrected_by);

		$this->db->set('WO_corrected_date', $corrected_on);

		$this->db->set('QA_hold', $qa_hold);

		$this->db->set('QA_inspection_required', $qa_inspection);

		$this->db->set('WO_employee_saftey_hazard', $emply_safety_haz);

		$this->db->set('WO_equipment_washed', $eq_wash);

		$this->db->set('WO_formed', $qa_formed);

		$this->db->set('QA_QC_inspection_approval', $qa_qc_inspec);

		$this->db->set('status', 'completed');

		$this->db->set('tracking', $this->ion_auth->user()->row()->username);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function issuedUserEditWorkOrder($id, $assign_to, $corr_description, $corr_by, $status, $qa_hold, $qa_inspection, $emply_safety_haz) {

		$this->db->set('WO_assigned_to', $assign_to);

		$this->db->set('WO_corrective_action_description', $corr_description);

		$this->db->set('WO_corrected_by', $corr_by);

		$this->db->set('QA_hold', $qa_hold);

		$this->db->set('QA_inspection_required', $qa_inspection);

		$this->db->set('WO_employee_saftey_hazard', $emply_safety_haz);

		$this->db->set('status', $status);

		$this->db->set('tracking', $assign_to);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function assignedUserEditWorkOrder($id, $approved_by, $corrected_date, $comments, $qa_wash, $qa_eqip_inspec, $qa_qc_inspec, $status, $tracking) {

		$this->db->set('QC_approved_by', $approved_by);

		$this->db->set('WO_general_notes', $comments);

		$this->db->set('WO_equipment_washed', $qa_wash);

		$this->db->set('WO_corrected_date', $corrected_date);

		$this->db->set('QA_QC_inspection_approval', $qa_qc_inspec);

		$this->db->set('WO_formed', $qa_eqip_inspec);

		$this->db->set('status', $status);

		$this->db->set('tracking', $tracking);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function issuedUserCompleteWorkOrder($verified_by, $verified_date, $status, $id) {

		$this->db->set('WO_verified_by', $verified_by);

		$this->db->set('WO_verified_date', $verified_date);

		$this->db->set('status', $status);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function issuedQAEditWorkOrder($id, $issued_by, $corr_description, $corr_by, $corrected_date, $status, $qa_wash, $qa_eqip_inspec, $qa_qc_inspec) {

		$this->db->set('WO_equipment_washed', $qa_wash);

		$this->db->set('WO_corrected_date', $corrected_date);

		$this->db->set('QA_QC_inspection_approval', $qa_qc_inspec);

		$this->db->set('WO_formed', $qa_eqip_inspec);

		$this->db->set('status', $status);

		$this->db->set('WO_corrective_action_description', $corr_description);

		$this->db->set('WO_corrected_by', $corr_by);

		$this->db->set('tracking', $issued_by);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function qaRequestedWorkOrder($id, $assign_to, $corr_description, $corr_by, $status, $qa_hold, $qa_inspection, $emply_safety_haz) {

		$this->db->set('WO_assigned_to', $assign_to);

		$this->db->set('WO_corrective_action_description', $corr_description);

		$this->db->set('WO_corrected_by', $corr_by);

		$this->db->set('QA_hold', $qa_hold);

		$this->db->set('QA_inspection_required', $qa_inspection);

		$this->db->set('WO_employee_saftey_hazard', $emply_safety_haz);

		$this->db->set('status', $status);

		$this->db->set('tracking', $assign_to);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function issuedUserCorrectedWorkOrder($id, $issued_by, $corr_description, $corr_by, $corrected_date, $status, $tracking) {

		$this->db->set('WO_corrected_date', $corrected_date);

		$this->db->set('status', $status);

		$this->db->set('WO_corrective_action_description', $corr_description);

		$this->db->set('WO_corrected_by', $corr_by);

		$this->db->set('tracking', $issued_by);

		$this->db->where('WO_id', $id);

		$query = $this->db->update('work_order');

		return $query;

	}

	function deleteWorkOrder($id) {

		$this->db->where('WO_id', $id);

		$query = $this->db->delete('work_order');

		return $query;

	}

}