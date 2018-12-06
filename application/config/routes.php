<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'authentication/login';

$route['add_user'] = 'authentication/register';

$route['fetch_users'] = 'authentication/fetch_users';

$route['delete_user'] = 'authentication/delete_user';

$route['edit_user_details'] = 'authentication/edit_user_details';

$route['change_status'] = 'authentication/change_status';

$route['user_logout'] = 'authentication/logout';

$route['reset_password'] = 'authentication/reset_password';

$route['dashboard'] = 'dashboard';

$route['add_new_equipment'] = 'equipment/add_new_equipment';

$route['upload_equipment_image'] = 'equipment/upload_equipment_image';

$route['fetch_equipments'] = 'equipment/fetch_equipments';

$route['delete_equipment'] = 'equipment/delete_equipment';

$route['edit_equipment'] = 'equipment/edit_equipment';

$route['get_equipment_details'] = 'equipment/get_equipment_details';

$route['save_purchase_order'] = 'equipment/save_purchase_order';

$route['fetch_purchase_order'] = 'equipment/fetch_purchase_order';

$route['submit_workorder'] = 'workorder/new_workorder';

$route['get_new_work_orders'] = 'workorder/new_work_orders';

$route['get_all_work_orders'] = 'workorder/all_work_orders';

$route['upload_new_wo_image'] = 'workorder/upload_new_wo_image';

$route['complete_wo_order'] = 'workorder/complete_wo_order';

$route['get_completed_orders'] = 'workorder/get_completed_orders';

$route['order_submit_for_qa'] = 'workorder/order_submit_for_qa';

$route['get_pending_orders'] = 'workorder/get_pending_orders';

$route['complete_wo_qc'] = 'workorder/complete_wo_qc';

$route['verify_and_complete_wo'] = 'workorder/verify_and_complete_wo';

$route['get_overdue_orders'] = 'workorder/get_overdue_orders';

$route['admin_edit_order'] = 'workorder/admin_edit_order';

$route['admin_complete_order'] = 'workorder/admin_complete_order';

$route['admin_qc_complete_order'] = 'workorder/admin_qc_complete_order';

$route['admin_qc_and_verif_order'] = 'workorder/admin_qc_and_verif_order';

$route['upload_edit_wo_image'] = 'workorder/upload_edit_wo_image';

$route['get_order_images'] = 'workorder/get_order_images';

$route['edit_report'] = 'workorder/edit_report';

$route['get_notifications'] = 'notifications/get_notifications';

$route['wo_edit_save_order'] = 'workorder/wo_edit_save_order';

$route['wo_qc_edit_save_order'] = 'workorder/wo_qc_edit_save_order';

$route['wo_issuer_complete_order'] = 'workorder/wo_issuer_complete_order';

$route['wo_edit_qa_requested_order'] = 'workorder/wo_edit_qa_requested_order';

$route['wo_qa_issued_save_order'] = 'workorder/wo_qa_issued_save_order';

$route['wo_edit_requested_order'] = 'workorder/wo_edit_requested_order';

$route['delete_purchase_order'] = 'equipment/delete_purchase_order';

$route['delete_work_order'] = 'workorder/delete_work_order';

$route['re_save_purchase_order'] = 'equipment/re_save_purchase_order';

$route['get_equipment_repair_cost'] = 'equipment/get_equipment_repair_cost';
