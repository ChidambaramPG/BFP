<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {

	public function add_new_equipment() {

		$name = $this->input->post('name');

		$serialNum = $this->input->post('serialNum');

		$modelNum = $this->input->post('modelNum');

		$make = $this->input->post('make');

		$asset = $this->input->post('asset');

		$note = $this->input->post('note');

		$rep_cost = $this->input->post('rep_cost');

		$image = $this->input->post('image');

		$this->load->model('Equipmentmodel');

		$result = $this->Equipmentmodel->saveEquipment($name, $serialNum, $modelNum, $make, $asset, $note, $rep_cost);

		echo $result;

		// echo json_encode($this->input->post());

	}

	public function upload_equipment_image() {

		$id = $this->input->post('id');

		$config['upload_path'] = "./uploads/equipments/" . $id;

		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload');

		$this->upload->initialize($config);

		// echo json_encode($this->input->post());

		if (!is_dir('./uploads/equipments/' . $id)) {

			mkdir('./uploads/equipments/' . $id, 0777, true);

		}

		if (!$this->upload->do_upload('file')) {

			$error = array('error' => $this->upload->display_errors());

			$result = $error;

			echo json_encode($result);

		} else {

			$data = array('upload_data' => $this->upload->data());

			$this->load->model('Equipmentmodel');

			$result = $this->Equipmentmodel->addEquipmentImage($id, $data['upload_data']['file_name']);

			echo $result;

		}

	}

	public function get_equipment_details() {

		$id = $this->input->post('id');

		$this->load->model('Equipmentmodel');

		$result = $this->Equipmentmodel->getEquipments();

		echo json_encode($result->result_array());

	}

	public function fetch_equipments() {

		$this->load->model('Equipmentmodel');

		$result = $this->Equipmentmodel->getEquipments();

		echo json_encode($result->result_array());

	}

	public function delete_equipment() {

		$id = $this->input->post('id');

		$this->load->model('Equipmentmodel');

		$result = $this->Equipmentmodel->removeEquipment($id);

		echo json_encode($result);

	}

	public function edit_equipment() {

		$name = $this->input->post('name');

		$serialNum = $this->input->post('serialNum');

		$modelNum = $this->input->post('modelNum');

		$make = $this->input->post('make');

		$asset = $this->input->post('asset');

		$note = $this->input->post('note');

		$rep_cost = $this->input->post('rep_cost');

		$image = $this->input->post('image');

		$id = $this->input->post('id');

		// echo json_encode($this->input->post());

		$this->load->model('Equipmentmodel');

		$result = $this->Equipmentmodel->updateEquipment($id, $name, $serialNum, $modelNum, $make, $asset, $note, $rep_cost);

		echo $result;

	}

	public function save_purchase_order() {

		$id = $this->input->post('id');

		$name = $this->input->post('name');

		$serialNum = $this->input->post('serialNum');

		$modelNum = $this->input->post('modelNum');

		$make = $this->input->post('make');

		$asset = $this->input->post('asset');

		$partNum = $this->input->post('partNum');

		$supplier = $this->input->post('supplier');

		$link = $this->input->post('link');

		$unitPrice = $this->input->post('unitPrice');

		$qty = $this->input->post('qty');

		$invNum = $this->input->post('invNum');

		$shippingCost = $this->input->post('shippingCost');

		$this->load->model('Equipmentmodel');

		$result1 = $this->Equipmentmodel->updateEquipment($id, $name, $serialNum, $modelNum, $make, $asset);

		$repCost = ((float) $unitPrice * (float) $qty) + (float) $shippingCost;

		$result3 = $this->Equipmentmodel->updateRepairCost($id, $repCost);

		$this->load->model('Equipmentmodel');

		$result2 = $this->Equipmentmodel->save_purchase_details($id, $partNum, $supplier, $link, $unitPrice, $qty, $invNum, $shippingCost);

		echo $result2;

	}

	public function fetch_purchase_order() {

		$id = $this->input->post('id');

		$this->load->model('Equipmentmodel');

		$result2 = $this->Equipmentmodel->get_purchase_details($id);

		echo json_encode($result2->result_array());

	}

	public function delete_purchase_order() {

		$id = $this->input->post('id');

		$this->load->model('Equipmentmodel');

		$result = $this->Equipmentmodel->deletePurchaseOrder($id);

		echo $result;

	}

	public function re_save_purchase_order() {

		$id = $this->input->post('id');

		$partNum = $this->input->post('partNum');

		$supplier = $this->input->post('supplier');

		$link = $this->input->post('link');

		$unitPrice = $this->input->post('unitPrice');

		$qty = $this->input->post('qty');

		$invNum = $this->input->post('invNum');

		$shippingCost = $this->input->post('shippingCost');

		$this->load->model('Equipmentmodel');

		$result2 = $this->Equipmentmodel->re_save_purchase_details($id, $partNum, $supplier, $link, $unitPrice, $qty, $invNum, $shippingCost);

		// $repCost = ((float) $unitPrice * (float) $qty) + (float) $shippingCost;

		// $result3 = $this->Equipmentmodel->updateRepairCost($id, $repCost);

		echo $result2;

	}

	public function get_equipment_repair_cost() {
		$this->load->model('Equipmentmodel');

		$result = $this->Equipmentmodel->get_equipment_repair_cost();

		echo json_encode($result->result_array());

	}

}
