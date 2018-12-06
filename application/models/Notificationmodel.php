<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificationmodel extends CI_Model {

	function saveNotification($notif_for, $notif_group, $notification) {

		$tbl = $this->db->dbprefix('notifications');
		$data = array('notif_for' => $notif_for, 'notif_group' => $notif_group, 'notification' => $notification);
		$result = $this->db->insert($tbl, $data);

		if ($result == 1) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		} else {
			return 0;
		}

	}

	function getNotificationForId($id) {

		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('notif_for', $id);
		$query = $this->db->get();

		return $query;
	}

	function getNotificationForGroupId($id) {

		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('notif_group', $id);
		$query = $this->db->get();

		return $query;
	}

	function getAllNotification() {

		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('admin_viewed', 0);

		$query = $this->db->get();

		return $query;
	}

}