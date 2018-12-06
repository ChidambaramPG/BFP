<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipmentmodel extends CI_Model {

	function saveEquipment($name, $serialNum, $modelNum, $make, $asset, $note, $rep_cost) {

		$tbl = $this->db->dbprefix('equipments');

		$data = array('name' => $name, 'serial_number' => $serialNum, 'model_number' => $modelNum,

			'make' => $make, 'asset' => $asset, 'note' => $note, 'repair_cost' => $rep_cost);

		$result = $this->db->insert($tbl, $data);

		if ($result == 1) {

			$insert_id = $this->db->insert_id();

			return $insert_id;

		} else {

			return 0;

		}

	}

	function save_purchase_details($id, $partNum, $supplier, $link, $unitPrice, $qty, $invNum, $shippingCost) {

		$tbl = $this->db->dbprefix('equipment_purchases');

		$data = array('equipment_id' => $id, 'part_number' => $partNum, 'supplier' => $supplier, 'link' => $link, 'unit_price' => $unitPrice, 'quantity' => $qty, 'invoice_number' => $invNum, 'shipping_cost' => $shippingCost);

		$result = $this->db->insert($tbl, $data);

		if ($result == 1) {

			$insert_id = $this->db->insert_id();

			return $insert_id;

		} else {

			return 0;

		}

	}

	function deletePurchaseOrder($id) {

		$this->db->where('id', $id);

		$query = $this->db->delete('equipment_purchases');

		return $query;

	}

	function get_purchase_details($id) {

		$this->db->select('*');

		$this->db->from('equipment_purchases');

		$this->db->where('equipment_id', $id);

		$query = $this->db->get();

		return $query;

	}

	function getEquipments() {

		$this->db->select('*');

		$this->db->from('equipments');

		$query = $this->db->get();

		return $query;

	}

	function updateEquipment($id, $name, $serialNum, $modelNum, $make, $asset) {

		$this->db->set('name', $name);

		$this->db->set('serial_number', $serialNum);

		$this->db->set('model_number', $modelNum);

		$this->db->set('make', $make);

		$this->db->set('asset', $asset);

		$this->db->where('id', $id);

		$query = $this->db->update('equipments');

		return $query;

	}

	function addEquipmentImage($id, $path) {

		$this->db->set('image', $path);

		$this->db->where('id', $id);

		$query = $this->db->update('equipments');

		return $query;

	}

	function removeEquipment($id) {

		$this->db->where('id', $id);

		$query = $this->db->delete('equipments');

		return $query;

	}

	function increaseTotoalRequest($id) {

		$this->db->where('id', $id);

		$this->db->set('request_number', 'request_number+1', FALSE);

		$this->db->update('equipments');

	}

	function updateRepairCost($id, $cost) {

		$this->db->set('repair_cost', $cost);

		$this->db->where('id', $id);

		$query = $this->db->update('equipments');

		return $query;
	}

	function re_save_purchase_details($id, $partNum, $supplier, $link, $unitPrice, $qty, $invNum, $shippingCost) {

		$this->db->set('part_number', $partNum);

		$this->db->set('supplier', $supplier);

		$this->db->set('link', $link);

		$this->db->set('unit_price', $unitPrice);

		$this->db->set('quantity', $qty);

		$this->db->set('invoice_number', $invNum);

		$this->db->set('shipping_cost', $shippingCost);

		$this->db->where('id', $id);

		$query = $this->db->update('equipment_purchases');

		return $query;
	}

	function get_equipment_repair_cost() {

		$this->db->select('*');

		// $this->db->group_by('equipment_id');

		$this->db->from('equipment_purchases');

		$query = $this->db->get();

		return $query;

	}

}