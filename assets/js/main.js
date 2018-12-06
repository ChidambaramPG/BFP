

// global variables 

var v_signaturePad = undefined;

var c_signaturePad = undefined;

var q_signaturePad = undefined;

var v_sign = undefined;

var c_sign = undefined;

var q_sign = undefined;



// Vue instance

var app = new Vue({

	el: '#app',

	data: {

		dash_menu: 'dashboard',

		all_users: [],

		selected_user: [],

		all_equipments: [],

		selected_equipment: [],

		new_work_orders: [],

		all_work_orders: [],

		selected_order: [],

		qa_hold:false,

		qa_inspection:false,

		empl_saft_haz:false,

		completed_work_orders:[],

		pending_work_orders:[],

		qa_wash:false,

		qa_eqip_inspec:false,

		qa_qc_inspec: false,

		overdue_work_orders:[],

		all_notifications:[],



		completed_work_orders_page:1,

		new_work_orders_page:1,

		overdue_work_orders_page:1,

		pending_work_orders_page:1,

		dashboard_work_orders_page:1,

		equipments_page:1,

		users_page:1,

		work_order_images:[],

		equipment_pur_orders:[],

		selected_equipment_pur_orders:'',

		dashboard_table_array_reversed: false,

		temp_dash_order_list:[],

		temp_new_order_list:[],

		dashboard_work_orders:[],

		user_searched:'',

		modalMessage:'',

		messageClass:'',

		selectedPurchaseOrder:[],

		allPurchaseOrders:[],



	},

	updated() {


		var c_canvas = document.getElementById("corrected_sign");



		if(c_canvas){

			var c_canvas = document.getElementById("corrected_sign");

			c_signaturePad = new SignaturePad(c_canvas);





			$('#corrected_clear').on('click', function() {

				c_signaturePad.clear();

				c_sign = undefined;

			});

			$('#corrected_save').on('click', function() {

				c_sign =c_signaturePad.toDataURL();

			});

			if(app.selected_order.WO_corrected_by != null){

				c_signaturePad.fromDataURL(app.selected_order.WO_corrected_by);

			}



		}



		var v_canvas = document.getElementById("verified_sign");

		if (v_canvas) {



			var v_canvas = document.getElementById("verified_sign");			

			var verif = $('#verified_sign').get(0);

			v_signaturePad = new SignaturePad(v_canvas);

			$('#varified_clear').on('click', function() {

				v_signaturePad.clear();

				v_sign = undefined;

			});

			$('#varified_save').on('click', function() {

				v_sign = v_signaturePad.toDataURL();

			});



			if(app.selected_order.WO_verified_by != null){

				v_signaturePad.fromDataURL(app.selected_order.WO_verified_by);

			}



		}



		var q_canvas = document.getElementById("qaqc_sign");

		if (q_canvas) {



			var q_canvas = document.getElementById("qaqc_sign");			

			var verif = $('#qaqc_sign').get(0);

			q_signaturePad = new SignaturePad(q_canvas);

			$('#qaqc_sign_clear').on('click', function() {

				q_signaturePad.clear();

				q_sign = undefined;

			});

			$('#qaqc_sign_save').on('click', function() {

				q_sign = q_signaturePad.toDataURL();

			});



			if(app.selected_order.QC_approved_by != null){

				q_signaturePad.fromDataURL(app.selected_order.QC_approved_by);

			}



		}

	},

	methods: {

		calculateRepairCost(id){

			var temp1 = this.allPurchaseOrders.slice();
			var repairCost = 0;
			for(var i =0; i<temp1.length; i++){
				console.log(temp1[i].equipment_id + ':' + id);
				if(temp1[i].equipment_id === id){
					repairCost = parseFloat(repairCost) + ((parseFloat(temp1[i].unit_price) * parseFloat(temp1[i].quantity)) + parseFloat(temp1[i].shipping_cost));
				}
			}
			return repairCost;
		},

		setUserPage(page,event){

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}

			this.users_page = page;

		},

		setWorkOrderPage(event){

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}

			this.new_work_orders_page++;

		},

		setEquipmentPage(page,event){

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}

			this.equipments_page = page;

		},

		setReportsPage(page,event){

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}

			console.log(page);

			this.completed_work_orders_page++;

		},		

		setPendingPage(page,event){

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}

			this.pending_work_orders_page++;

		},

		setOverduePage(event){

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}

			this.overdue_work_orders_page++;

		},

		setCompletedPage(event){

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}

			this.completed_work_orders_page++;

		},

		setDashboardPage(event){

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}

			this.dashboard_work_orders_page++;

		},

		setDashMenuItem: function(menuItem, event) {

			if (event) {

				event.preventDefault();

				event.stopPropagation();

			}



			this.dash_menu = menuItem;

			getNotifications();





			if (menuItem == 'users') {

				console.log("getting users");

				get_user_list();

			}

			if (menuItem == 'equipment') {

				get_equipment_lists();
				getEquipmentRepairCost();

			}

			if (menuItem == 'edit_equipment') {

				// get_equipment_lists();

				console.log('editing equipment');

			}

			if (menuItem == 'new_order') {

				$.ajax({

						url: 'fetch_equipments',

						type: 'post',

						data: { param1: 'value1' },

					})

					.done(function(e) {

						// console.log($.parseJSON(e));

						Vue.set(app, 'all_equipments', $.parseJSON(e));

						$equipments = app.all_equipments;

						$options = {

							data: $equipments,

							getValue: 'name',

							list: {

								maxNumberOfElements: 2,

								match: {

									enabled: true

								},

								onLoadEvent: function() {

									console.log('Data loaded to autocomplete');

								},

								onShowListEvent: function() {

									var $ul = $('#eac-container-equipment_num_autocomplete').children('ul');

									$ul.css({ 'width': '500px', 'height': '500px' })

								},

								onClickEvent: function() {

									var equipment_selected = $('#equipment_num_autocomplete').getSelectedItemData();

									console.log(equipment_selected);

									Vue.set(app, 'selected_equipment', equipment_selected);

								},

							},

							template: {

								type: "custom",

								method: function(value, item) {

									console.log(value);

									// return '<p>'+ item.name +'</p>';

									if (item.image == '') {

										return '<div class="row"><div class="col-md-12"><div class="equipment-list"><div class="eq-details">' +

											'<div class="eq-img"><img src="assets/images/dust.png" alt=""></div><div class="eq-name"><h5>Equipment Name : ' + item.name +

											'</h5><h6>Total Requests : ' + '25' + '</h6></div></div></div></div></div>';

									} else {

										return '<div class="row"><div class="col-md-12"><div class="equipment-list"><div class="eq-details">' +

											'<div class="eq-img"><img src="uploads/equipments/' + item.id + '/' + item.image + '" alt=""></div><div class="eq-name"><h5>Equipment Name : ' + item.name +

											'</h5><h6>Total Requests : ' + item.request_number + '</h6></div></div></div></div></div>';

									}

								},

							},

						};

						$('#equipment_num_autocomplete').easyAutocomplete($options);

						console.log("success");

					})

					.fail(function(e) {

						console.log(e);

						console.log("error");

					})

					.always(function() {

						console.log("complete");

					});

			}

			if (menuItem == 'work_orders') {

				// get_new_wor_orders_list();

				get_all_data();

			}

			if (menuItem == 'dashboard') {

				// get_dashboard_lists();

				get_all_data();

			}

			if (menuItem == 'completed') {

				// get_completed_wo_orders();

				get_all_data();				

			}

			if (menuItem == 'pending') {

				// get_pending_wo_orders();	

				get_all_data();			

			}

			if (menuItem == 'overdue') {

				// get_overdue_orders();	

				get_all_data();			

			}



			if(menuItem == 'wo_report'){

				get_completed_wo_orders();

				this.selected_order = this.completed_work_orders[event.target.id];



			}



			if(menuItem == 'view_completed'){

				get_completed_wo_orders();

				this.selected_order = this.completed_work_orders.reverse()[event.target.id];

				getSelectedOrderImages(this.selected_order.WO_id);

			}



			if(menuItem == 'view_pending'){

				get_completed_wo_orders();

				this.selected_order = this.pending_work_orders.reverse()[event.target.id];

				getSelectedOrderImages(this.selected_order.WO_id);

			}



			if(menuItem == 'view_overdue'){

				get_completed_wo_orders();

				this.selected_order = this.overdue_work_orders.reverse()[event.target.id];

				getSelectedOrderImages(this.selected_order.WO_id);

			}



			



		},

		setSelecteduser: function(indx) {

			this.selected_user = this.all_users[indx];

		},

		setSelectedEquipment: function(indx) {

			this.selected_equipment = this.all_equipments[indx];

		},

		sortReportBy(param){

			console.log('sorting by '+param);

			console.log(this.completed_work_orders[0][param]);

			var sorted =  this.completed_work_orders.sort((a, b) => { 

				return a[param] < b[param] 

			});



			this.completed_work_orders = sorted;



			// var sorted = _.orderBy(this.completed_work_orders,param);

			console.log(this.completed_work_orders[0][param]);

			console.log(sorted[0][param]);

		},

		setAllWorkOrdersMethod(param){

			this.all_work_orders = [];

			this.all_work_orders.push(param)

			// this.all_work_orders = param;

		},

		setSelectedWorkOrder(indx){

			// console.log(this.all_work_orders.reverse()[indx]);

			var temp = this.all_work_orders.slice();

			this.selected_order = temp.reverse()[indx];

		},

		setSelectedPendingOrder(indx){

			// console.log(this.all_work_orders.reverse()[indx]);

			var temp = this.pending_work_orders.slice();

			this.selected_order = temp.reverse()[indx];

		},

		setSelectedOverdueOrder(indx){

			// console.log(this.all_work_orders.reverse()[indx]);

			var temp = this.overdue_work_orders.slice();

			this.selected_order = temp.reverse()[indx];

		},

		


		explodeFileName(imageName){

			var extension = imageName.split('.')[1];

			console.log(extension);

			return extension;

		},

		setSelectedPurchaseOrder(id){

			var temp = this.equipment_pur_orders.slice();
			console.log(temp);

			this.selectedPurchaseOrder = temp.reverse()[id];
		}

		

	},

	computed:{


		filteredUsers() {

		    const search = this.user_searched.toLowerCase().trim();



		   if (!search) return this.all_users;



		   return this.all_users.filter(c => c.username.toLowerCase().indexOf(search) > -1);

		},	

		

		

		computed_all_work_orders_tot_pages: function(){

			return Math.ceil(this.all_work_orders.length / 10 );

		},		



		computed_new_work_orders_tot_pages: function(){

			return Math.ceil(this.new_work_orders.length / 10 );

		},



		computed_completed_work_orders_tot_pages: function(){

			return Math.ceil(this.completed_work_orders.length / 10);

		},



		computed_overdue_work_orders_tot_pages: function(){

			return Math.ceil(this.computed_overdue_work_orders.length / 10 );

		},

		

		computed_pending_work_orders_tot_pages: function(){

			return Math.ceil(this.computed_pending_work_orders.length / 10 );

		},



		computed_equipments_tot_pages: function(){

			return Math.ceil(this.all_equipments.length / 10 );

		},



		computed_users_tot_pages: function(){

			return Math.ceil(this.all_users.length / 10 );

		},



	}

})



// On ready

$equipments = [];

$(document).ready(function() {



	getNotifications();

	get_equipment_lists();

	get_new_wor_orders_list();

	get_dashboard_lists();

	get_completed_wo_orders();

	get_pending_wo_orders();

	get_overdue_orders();

	get_user_list();

	// $(function() {
	//     $( "#wo_due_date" ).datepicker();
	// });

});



// menu activation and deactivation

$('ul li a').click(function() {

	$('ul li.active').removeClass('active');

	$('ul li a.active').removeClass('active');

	$(this).closest('li').addClass('active');

	$(this).closest('a').addClass('active');

});

// functions

function get_dashboard_lists() {

	$.ajax({

			url: 'get_all_work_orders',

			type: 'post',

			data: { param1: 'value1' },

		})

		.done(function(e) {

			console.log($.parseJSON(e));			

			// solution 01

			Vue.set(app,'all_work_orders',$.parseJSON(e) );



			// solution 02

			// Vue.set(app, 'all_work_orders',[] );

			// $.each($.parseJSON(e) , function (index,value){

			// 	console.log(value);

			// 	app.all_work_orders.push(value);

			// });

			

			// solution 03

			// app.setAllWorkOrdersMethod($.parseJSON(e));



			console.log(app.all_work_orders.length);

			

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

}



function get_new_wor_orders_list() {

	$.ajax({

			url: 'get_new_work_orders',

			type: 'post',

			data: { param1: 'value1' },

		})

		.done(function(e) {

			// console.log(e);

			// console.log($.parseJSON(e));

			Vue.set(app, 'new_work_orders', $.parseJSON(e));

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

}



function get_equipment_lists() {

	$.ajax({

			url: 'fetch_equipments',

			type: 'post',

			data: { param1: 'value1' },

		})

		.done(function(e) {

			// console.log($.parseJSON(e));

			Vue.set(app, 'all_equipments', $.parseJSON(e));

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

}



function get_user_list() {

	$.ajax({

			url: 'fetch_users',

			type: 'post',

			data: { param1: 'value1' },

		})

		.done(function(e) {

			// console.log($.parseJSON(e));

			Vue.set(app, 'all_users', $.parseJSON(e)['users']);

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

}



function get_completed_wo_orders(){

	$.ajax({

		url: 'get_completed_orders',

		type: 'post',

		data: {param1: 'value1'},

	})

	.done(function(e) {

		// console.log(e);

		Vue.set(app,'completed_work_orders',$.parseJSON(e))

		console.log("success");

	})

	.fail(function(e) {

		console.log(e);

		console.log("error");

	})

	.always(function() {

		console.log("complete");

	});

}



function get_pending_wo_orders(){

	$.ajax({

		url: 'get_pending_orders',

		type: 'post',

		data: {param1: 'value1'},

	})

	.done(function(e) {

		// console.log(e);

		Vue.set(app,'pending_work_orders',$.parseJSON(e));

		console.log("success");

	})

	.fail(function(e) {

		console.log(e);

		console.log("error");

	})

	.always(function() {

		console.log("complete");

	});

	

}



function get_overdue_orders(){

	$.ajax({

		url: 'get_overdue_orders',

		type: 'post',

		data: {param1: 'value1'},

	})

	.done(function(e) {

		// console.log(e);

		Vue.set(app,'overdue_work_orders',$.parseJSON(e));

		console.log("success");

	})

	.fail(function(e) {

		console.log(e);

		console.log("error");

	})

	.always(function() {

		console.log("complete");

	});

	

}



function get_all_data(){



	get_dashboard_lists();

	get_new_wor_orders_list();

	get_completed_wo_orders();

	get_pending_wo_orders();

	get_overdue_orders();



}



function getNotifications(){

	$.ajax({

		url: 'get_notifications',

		type: 'post',

		data: {param1: 'value1'},

	})

	.done(function(e) {

		// console.log(e);

		Vue.set(app,'all_notifications',$.parseJSON(e));
		console.log("success");

	})

	.fail(function(e) {

		console.log(e);

		console.log("error");

	})

	.always(function() {

		console.log("complete");

	});

	

}

function getEquipmentRepairCost(){

	$.ajax({
		url: 'get_equipment_repair_cost',
		type: 'post',
		data: {param1: 'value1'},
	})
	.done(function(e) {
		console.log(e);
		Vue.set(app,'allPurchaseOrders',$.parseJSON(e));	
		
		console.log("success");
	})
	.fail(function(e) {
		console.log(e);
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}

// Auth functions

$('#login_form').submit(function(event) {

	event.preventDefault();

	console.log($('#login_form').serialize());

	$('body').loadingModal({

		text: 'Loging In. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});

	$.ajax({

			url: 'login',

			type: 'post',

			data: $('#login_form').serialize(),

		})

		.done(function(e) {

			console.log(e);

			$val = $.parseJSON(e)[0];

			$('#login_result').html('');

			if ($val == 'success') {

				$('#login_result').append('<p class="alert alert-success"> Login Succesfull</p>');

				window.location.replace("http://prototype.quinconx.com/bfp_new/dashboard");

				// window.location.replace("http://127.0.0.1/bfp_new/dashboard");

			} else {

				$('#login_result').append('<p class="alert alert-danger"> Login Failed</p>');

			}

			console.log("success");

		})

		.fail(function(e) {

			console.log($e);

			console.log("error");

		})

		.always(function() {

			$('body').loadingModal('destroy');

			console.log("complete");

		});

});

$('#logout_btn').click(function(event) {

	/* Act on the event */

	event.preventDefault();

	console.log('logging out');

	$.ajax({

			url: 'user_logout',

			type: 'post',

			data: { param1: 'value1' },

		})

		.done(function(e) {

			console.log(e);

			window.location.replace("http://prototype.quinconx.com/bfp_new/");

			// window.location.replace("http://127.0.0.1/bfp/");

			

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

});

$('#settings_btn').click(function(event) {

	/* Act on the event */

	event.preventDefault();

	Vue.set(app, 'dash_menu', 'settings');

});

$(document).on('submit', '#password_reset_form', function(event) {

	event.preventDefault();

	/* Act on the event */

	event.preventDefault();

	$pass = $('#password').val();

	$conf_pass = $('#confirm_password').val();

	$match_error = '<div class="account-content" id="pass_chng_doesnt_match_alert">' +

		'<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">' +

		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +

		'<span aria-hidden="true">×</span>' + '</button>' + '<i class="mdi mdi-close"></i>' + '<strong>Passwords dont match!</strong>.' +

		'</div>' + '<div class="clearfix"></div>' + '</div>';

	$change_error = '<div class="account-content" id="pass_chng_fail_alert">' +

		'<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">' +

		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +

		'<span aria-hidden="true">×</span>' +

		'</button>' +

		'<i class="mdi mdi-close"></i>' +

		'<strong>Passwords dont match!</strong>.' +

		'</div>' +

		'<div class="clearfix"></div>' +

		' </div>';

	$success = '<div class="account-content" id="pass_chng_success_alert">' +

		'<div class="alert alert-icon alert-success alert-dismissible fade in" role="alert">' +

		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +

		'<span aria-hidden="true">×</span>' +

		'</button>' +

		'<i class="mdi mdi-close"></i>' +

		'<strong>Password Changed!</strong>.' +

		'</div>' +

		'<div class="clearfix"></div>' +

		'</div>';

	$('#click_response_status').html('');

	if ($pass == $conf_pass) {

		$.ajax({

				url: 'reset_password',

				type: 'post',

				data: { 'password': $pass },

			})

			.done(function(e) {

				console.log(e);

				$('#click_response_status').append($success);

				console.log("success");

			})

			.fail(function(e) {

				console.log(e);

				$('#click_response_status').append($change_error);

				console.log("error");

			})

			.always(function() {

				console.log("complete");

			});

	} else {

		$('#click_response_status').append($match_error);

	}

});

// add user

$('#add_user_btn').click(function(event) {

	/* Act on the event */

	$userDetails = $('#add_user_form').serialize();

	console.log($userDetails);

	$('body').loadingModal({

		text: 'Adding User. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});

	$.ajax({

			url: 'add_user',

			type: 'POST',

			data: $userDetails,

		})

		.done(function(e) {

			console.log(e);

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			$('body').loadingModal('destroy');

			console.log("complete");

		});

});

// edit user details

$(document).on('click', '.edit-user', function(event) {

	event.preventDefault();

	/* Act on the event */

	console.log(event);

	$indx = event.target.id;

	app.setSelecteduser($indx);

});

$('#edit_user_btn').click(function(event) {

	/* Act on the event */

	$data = $('#edit_user_form').serialize() + '&id=' + app.selected_user.id;

	console.log($data);

	$.ajax({

			url: 'edit_user_details',

			type: 'post',

			data: $data,

		})

		.done(function(e) {

			console.log(e);

			$('#edit_user').modal('hide');

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

});

// delete user

$(document).on('click', '.delete-user', function(event) {

	event.preventDefault();

	/* Act on the event */

	console.log(event);

	$indx = event.target.id;

	app.setSelecteduser($indx);

});

$('#delete_user_btn').click(function(event) {

	/* Act on the event */

	console.log(app.selected_user.id);

	$.ajax({

			url: 'delete_user',

			type: 'post',

			data: { 'id': app.selected_user.id },

		})

		.done(function(e) {

			console.log(e);

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

});

//activate & deactivate user

$(document).on('click', '.user_active', function(event) {

	event.preventDefault();

	/* Act on the event */

	console.log(event.target.id);

	$id = event.target.id;

	$.ajax({

			url: 'change_status',

			type: 'post',

			data: { 'id': $id, 'status': '1' },

		})

		.done(function(e) {

			console.log(('.status-radio' + "#" + event.target.id));

			$('.status-radio' + "#" + $id).prop('checked', true);

			console.log("success");

		})

		.fail(function() {

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

});

$(document).on('click', '.user_inactive', function(event) {

	event.preventDefault();

	/* Act on the event */

	console.log(event.target.id);

	$id = event.target.id;

	$.ajax({

			url: 'change_status',

			type: 'post',

			data: { 'id': $id, 'status': '0' },

		})

		.done(function() {

			console.log(('.status-radio' + "#" + event.target.id));

			$('.status-radio' + "#" + $id).prop('checked', true);

			console.log("success");

		})

		.fail(function() {

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

});

// Add new equipment

$new_equipment_id = '';

$('#add_equipment_btn').click(function(event) {

	/* Act on the event */

	event.preventDefault();

	$('body').loadingModal({

		text: 'Adding Equipment. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});

	$name = $('#equipment_name').val();

	$serialNum = $('#equipment_serialNum').val();

	$modelNum = $('#equipment_modelNum').val();

	$make = $('#equipment_make').val();

	$asset = $('#equipment_asset').val();

	$note = $('#equipment_note').val();

	$rep_cost = $('#repair_cost').val();

	$image = $('#equipment_image_file').val();



	$validation_error = [];

	if ($name == '') {

		$validation_error.push('name is missing');

	}

	if ($serialNum == '') {

		$validation_error.push('serialNum is missing');

	}

	if ($modelNum == '') {

		$validation_error.push('modelNum is missing');

	}

	if ($make == '') {

		$validation_error.push('make is missing');

	}

	if ($asset == '') {

		$validation_error.push('asset is missing');

	}

	if ($rep_cost == '') {

		$validation_error.push('repair cost is missing');

	}

	

	if ($validation_error.length == 0) {

		$.ajax({

				url: 'add_new_equipment',

				type: 'post',

				data: { 'name': $name, 'serialNum': $serialNum, 'modelNum': $modelNum, 'make': $make, 

				'asset': $asset, 'note': $note, 'image': $image,'rep_cost':$rep_cost },

			})

			.done(function(e) {

				$('#add_equipment').modal('hide');

				$('body').loadingModal('destroy');

				console.log(e);

				$new_equipment_id = e;

				if (e != 0) {

					if ($('#image_file').val() != '') {

						$('#image_form').submit()

					}

				} else {

					$('#task_success').modal('show');

					setTimeout(function(){
					  $('#task_success').modal('hide')
					}, 2000);

				}

				console.log("success");

			})

			.fail(function(e) {

				console.log(e);

				$('body').loadingModal('destroy');

				console.log("error");

			})

			.always(function() {

				console.log("complete");

			});

	} else {

		$('#equipment_error').html('');

		$('body').loadingModal('destroy');

		$validation_error.forEach(function(element, index) {

			// statements

			$('#equipment_error').append('<p class="alert alert-warning">' + element + '</p>');

		});

		console.log($validation_error);

	}

});

$('#image_form').submit(function(event) {

	/* Act on the event */

	event.preventDefault();

	var formData = new FormData(this);

	formData.append('id', $new_equipment_id);

	console.log(formData);

	$('body').loadingModal({

		text: 'Adding Image. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});

	$.ajax({

			url: 'upload_equipment_image',

			type: 'post',

			data: formData,

			processData: false,

			contentType: false,

			cache: false,

			async: false,

		})

		.done(function(ev) {

			console.log(ev);

			$('#task_success').modal('show');

			setTimeout(function(){
			  $('#task_success').modal('hide')
			}, 2000);

			console.log("success");

		})

		.fail(function(ev) {

			console.log(ev);

			console.log("error");

		})

		.always(function() {

			$('body').loadingModal('destroy');

			console.log("complete");

		});

});

// Delete equipment

$(document).on('click', '.delete-equipment', function(event) {

	event.preventDefault();

	/* Act on the event */

	console.log(event.target.id);

	$id = event.target.id;

	app.setSelectedEquipment($id);

});

$('#delete_equipment_btn').click(function(event) {

	/* Act on the event */

	$id = app.selected_equipment['id'];

	$.ajax({

			url: 'delete_equipment',

			type: 'post',

			data: { 'id': $id },

		})

		.done(function() {

			$('#delete_equipment').modal('hide');

			console.log("success");

		})

		.fail(function() {

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

});

// Edit equipment

$(document).on('click', '.edit-equipment', function(event) {

	event.preventDefault();

	/* Act on the event */

	console.log(event.target.id);

	$id = event.target.id;

	app.setSelectedEquipment($id);

	app.setDashMenuItem('edit_equipment');

	fetch_purchase_order();

});

$('#edit_equipment_btn').click(function(event) {

	/* Act on the event */

	event.preventDefault();

	$id = app.selected_equipment['id'];

	$name = $('#edit_equipment_name').val();

	$serialNum = $('#edit_equipment_serialNum').val();

	$modelNum = $('#edit_equipment_modelNum').val();

	$make = $('#edit_equipment_make').val();

	$asset = $('#edit_equipment_asset').val();

	$note = $('#edit_equipment_note').val();

	$rep_cost = $('#edit_repair_cost').val();

	$image = $('#edit_equipment_image_file').val();

	$validation_error = [];

	if ($name == '') {

		$validation_error.push('name is missing');

	}

	if ($serialNum == '') {

		$validation_error.push('serialNum is missing');

	}

	if ($modelNum == '') {

		$validation_error.push('modelNum is missing');

	}

	if ($make == '') {

		$validation_error.push('make is missing');

	}

	if ($asset == '') {

		$validation_error.push('asset is missing');

	}

	if ($rep_cost == '') {

		$validation_error.push('repair cost is missing');

	}

	if ($validation_error.length == 0) {

		// console.log($.parseJSON('[{"id":'+$id+',"name:"'+$name+',"serialNum:"'+$serialNum+',"modelNum:"'

		// +$modelNum+',"make:"'+ $make',"asset:"'+ $asset+ ',"note"'+ $note +',"image:"'+ $image+'}]'));

		console.log($id + ' : ' + $name + ' : ' + $serialNum + ' : ' + $modelNum + ' : ' + $make + ' : ' + $asset + ' : ' + $note + ' : ' + $image);

		$.ajax({

				url: 'edit_equipment',

				type: 'post',

				data: { 'id': $id, 'name': $name, 'serialNum': $serialNum, 'modelNum': $modelNum, 

				'make': $make, 'asset': $asset, 'note': $note, 'image': $image,'rep_cost':$rep_cost},

			})

			.done(function(e) {

				console.log(e);

				$('#edit_equipment').modal('hide');

				if (e != 0) {

					if ($('#image_file').val() != '') {

						$('#image_form').submit()

					}

				}

				console.log("success");

			})

			.fail(function(e) {

				console.log(e);

				console.log("error");

			})

			.always(function() {

				console.log("complete");

			});

	} else {

		$('#equipment_error').html('');

		$validation_error.forEach(function(element, index) {

			// statements

			$('#equipment_error').append('<p class="alert alert-warning">' + element + '</p>');

		});

		console.log($validation_error);

	}

});

/////////////////// Create New Work Order /////////////////////

$new_work_order_id = '';

$(document).on('submit', '#wo_form', function(event) {

	event.preventDefault();



	console.log('submitting');

	$('body').loadingModal({

		text: 'Adding New Work Order. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});



	$data = $('#wo_form').serializeArray();	

	$data.push( {name:'eqipment_id',value :app.selected_equipment.id} );

	console.log($data);	

	console.log($('#wo_file').val());	



	$.ajax({

			url: 'submit_workorder',

			type: 'post',

			data: $data,

		})

		.done(function(e) {



			if($('#wo_file').val() != ''){

				console.log(e);

				$new_work_order_id = e;



				console.log($('#wo_file')[0].files[0]);

				var formData = new FormData();

				formData.append('file', $('#wo_file')[0].files[0]);

				formData.append('id', $new_work_order_id);



				console.log('file upload');



				$('body').loadingModal({

					text: 'Adding File. Please wait..',

					color: '#4bd396',

					animation: 'doubleBounce'

				});



				$.ajax({

						url: 'upload_new_wo_image',

						type: 'post',

						data: formData,

						processData: false,

						contentType: false,

						cache: false,

						async: false,

					})

					.done(function(ev) {

						console.log(ev);

						console.log("success");

					})

					.fail(function(ev) {

						console.log(ev);

						Vue.set(app,'modalMessage',ev);

						Vue.set(app,'messageClass','text text-danger');	

						$("#alertModal").modal('show');

						setTimeout(function(){
						  $('#alertModal').modal('hide')
						}, 2000);

						console.log("error");

					})

					.always(function() {

						$('body').loadingModal('destroy');

						console.log("complete");

					});



			}



			$('body').loadingModal('destroy');

			$('#wo_form').trigger('reset');

			$('#task_success').modal('show');

			setTimeout(function(){
			  $('#task_success').modal('hide')
			}, 2000);

			console.log(e);

			console.log("success");

			get_dashboard_lists();

			Vue.set(app,'dash_menu','dashboard');

			

		})

		.fail(function(e) {

			console.log(e);

			$('body').loadingModal('destroy');

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

});

$(document).on('submit', '#wo_file_form', function(event) {	

	event.preventDefault();



	var formData = new FormData($('#wo_file_form'));

	formData.append('id', $new_work_order_id);



	console.log('file upload');



	$('body').loadingModal({

		text: 'Adding Signature. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});



	$.ajax({

			url: 'upload_new_wo_image',

			type: 'post',

			data: formData,

			processData: false,

			contentType: false,

			cache: false,

			async: false,

		})

		.done(function(ev) {

			console.log(ev);

			console.log("success");

		})

		.fail(function(ev) {

			console.log(ev);			

			Vue.set(app,'modalMessage',ev);

			Vue.set(app,'messageClass','text text-danger');	

			$("#alertModal").modal('show');

			setTimeout(function(){
			  $('#alertModal').modal('hide')
			}, 2000);

			Vue.set(app,'dash_menu','dashboard');

			console.log("error");

		})

		.always(function() {

			$('body').loadingModal('destroy');

			console.log("complete");

		});

});



function getSelectedOrderImages($id){

	console.log($id);

	$.ajax({

		url: 'get_order_images',

		type: 'post',

		data: {'id': $id},

	})

	.done(function(e) {

		console.log(e);

		Vue.set(app, 'work_order_images', $.parseJSON(e));

		console.log("success");

	})

	.fail(function(e) {

		console.log(e);

		console.log("error");

	})

	.always(function() {

		console.log("complete");

	});

	

}



// Edit order

$(document).on('click', '.edit-order', function(event) {

	event.preventDefault();

	console.log("order")

	console.log(event.target.id);

	Vue.set(app, 'selected_order', app.all_work_orders.slice().reverse()[event.target.id]);

	Vue.set(app,'qa_hold',app.all_work_orders.slice().reverse()[event.target.id]['QA_hold']);

	Vue.set(app,'qa_inspection',app.all_work_orders.slice().reverse()[event.target.id]['QA_inspection_required']);

	Vue.set(app,'empl_saft_haz',app.all_work_orders.slice().reverse()[event.target.id]['WO_employee_saftey_hazard']);

	app.setDashMenuItem('edit_work_order');

	getSelectedOrderImages(app.selected_order.WO_id);

});

$(document).on('click', '.edit-new-order', function(event) {

	event.preventDefault();

	console.log("order")

	console.log(event.target.id);

	Vue.set(app, 'selected_order', app.new_work_orders.slice().reverse()[event.target.id]);

	Vue.set(app,'qa_hold',app.new_work_orders.slice().reverse()[event.target.id]['QA_hold']);

	Vue.set(app,'qa_inspection',app.new_work_orders.slice().reverse()[event.target.id]['QA_inspection_required']);

	Vue.set(app,'empl_saft_haz',app.new_work_orders.slice().reverse()[event.target.id]['WO_employee_saftey_hazard']);

	app.setDashMenuItem('edit_work_order');

	getSelectedOrderImages(app.selected_order.WO_id);

});

$(document).on('click', '.edit-pending-order', function(event) {

	event.preventDefault();

	console.log("order")

	console.log(event.target.id);

	Vue.set(app, 'selected_order', app.pending_work_orders.slice().reverse()[event.target.id]);

	Vue.set(app,'qa_hold',app.pending_work_orders.slice().reverse()[event.target.id]['QA_hold']);

	Vue.set(app,'qa_inspection',app.pending_work_orders.slice().reverse()[event.target.id]['QA_inspection_required']);

	Vue.set(app,'empl_saft_haz',app.pending_work_orders.slice().reverse()[event.target.id]['WO_employee_saftey_hazard']);

	app.setDashMenuItem('edit_work_order');

	getSelectedOrderImages(app.selected_order.WO_id);

});

$(document).on('click', '.edit-overdue-order', function(event) {

	event.preventDefault();

	console.log("order")

	console.log(event.target.id);

	Vue.set(app, 'selected_order', app.overdue_work_orders.slice().reverse()[event.target.id]);

	Vue.set(app,'qa_hold',app.overdue_work_orders.slice().reverse()[event.target.id]['QA_hold']);

	Vue.set(app,'qa_inspection',app.overdue_work_orders.slice().reverse()[event.target.id]['QA_inspection_required']);

	Vue.set(app,'empl_saft_haz',app.overdue_work_orders.slice().reverse()[event.target.id]['WO_employee_saftey_hazard']);

	app.setDashMenuItem('edit_work_order');

	getSelectedOrderImages(app.selected_order.WO_id);

});




// Quality Check enabling

$(document).on('change', '#qa_hold', function(event) {

	event.preventDefault();

	if($('#qa_hold').is(":checked")) {

		app.qa_hold = true;       

    }else{

    	app.qa_hold = false;

    }

});

$(document).on('change', '#qa_inspection', function(event) {

	event.preventDefault();

	if($('#qa_inspection').is(":checked")) {

		console.log('checked');

		app.qa_inspection = true;       

    }else{

    	app.qa_inspection = false;

    }

});

$(document).on('change', '#emply_safety_haz', function(event) {

	event.preventDefault();

	if($('#emply_safety_haz').is(":checked")) {

		console.log('checked');

		app.empl_saft_haz = true;

       

    }else{

    	app.empl_saft_haz = false;

    }

});





$(document).on('change', '#qc_wash_inspec', function(event) {

	event.preventDefault();

	if($('#qc_wash_inspec').is(":checked")) {

		console.log('checked');

		app.qa_wash = true;       

    }else{

    	app.qa_wash = false;

    }

});

$(document).on('change', '#qc_equipment_inspec', function(event) {

	event.preventDefault();

	if($('#qc_equipment_inspec').is(":checked")) {

		console.log('checked');

		app.qa_eqip_inspec = true;       

    }else{

    	app.qa_eqip_inspec = false;

    }

});

$(document).on('change', '#qa_qc_inspec', function(event) {

	event.preventDefault();

	if($('#qa_qc_inspec').is(":checked")) {

		console.log('checked');

		app.qa_qc_inspec = true;

       

    }else{

    	app.qa_qc_inspec = false;

    }

});

// quality check and report submission





$(document).on('change', '#edit_image_file', function(event) {

	event.preventDefault();

	/* Act on the event */

	console.log('image selected');

	$new_work_order_id = app.selected_order.WO_id;

	var formData = new FormData();

	formData.append('file', $('#edit_image_file')[0].files[0]);

	formData.append('id', $new_work_order_id);



	$('body').loadingModal({

		text: 'Adding File. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});



	$.ajax({

		url: 'upload_edit_wo_image',

		type: 'post',

		data: formData,

		processData: false,

		contentType: false,

		cache: false,

		async: false,

	})

	.done(function(ev) {

		console.log(ev);

		getSelectedOrderImages(app.selected_order.WO_id);

		console.log("success");

	})

	.fail(function(ev) {

		console.log(ev);

		console.log('Error uploading image')

		console.log("error");

	})

	.always(function() {

		$('body').loadingModal('destroy');

		console.log("complete");

	});

});







$(document).on('submit', '#qa_wo_form', function(event) {

	event.preventDefault();



	if(c_sign == undefined){



		console.log("Sign corrected by is required");



	}else{



		console.log(v_sign);

		console.log(c_sign);



		var formData = new FormData();

		formData.append('correc_sign',c_sign);

		formData.append('correc_desc',$('#correc_desc').val());

		formData.append('qa_wash',app.qa_wash.toString());

		formData.append('qa_eqip_inspec',app.qa_eqip_inspec.toString());

		formData.append('qa_qc_inspec',app.qa_qc_inspec.toString());

		formData.append('id',app.selected_order.WO_id);

		formData.append('tracking',app.selected_order.WO_assigned_to);



		$.ajax({

			url: 'complete_wo_qc',

			type: 'post',

			data: formData,

			cache: false,

		    contentType: false,

		    processData: false,

		})

		.done(function(e) {



			console.log(e);

			console.log($('#edit_image_file').val());

			

			if($('#edit_image_file').val() != ''){

				console.log(e);

				$new_work_order_id = app.selected_order.WO_id;



				console.log($('#edit_image_file')[0].files[0]);

				var formData = new FormData();

				formData.append('file', $('#edit_image_file')[0].files[0]);

				formData.append('id', $new_work_order_id);



				console.log('file upload');



				$('body').loadingModal({

					text: 'Adding File. Please wait..',

					color: '#4bd396',

					animation: 'doubleBounce'

				});



			}

			app.setDashMenuItem('completed');

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			$('body').loadingModal('destroy');

			console.log("complete");

		});

		







	}

});

// sort report

$(document).on('change', '#sort_report', function(event) {

	event.preventDefault();

	/* Act on the event */

	var optionSelected = $("option:selected", this);

    var valueSelected = this.value;

    console.log(valueSelected);



    app.sortReportBy(valueSelected);

});

// edit report form

$(document).on('submit', '#edit_report_form', function(event) {

	event.preventDefault();

	/* Act on the event */



	$from = $('#rep_from_date').val();

	$to = $('#rep_to_date').val();

	$code = $('#rep_code').val();

	$supersedes_date = $('#supersedes_date').val();

	$version = $('#rep_version').val();



	$.ajax({

		url: 'edit_report',

		type: 'post',

		data: {'from':$from,'to':$to,'code':$code,'sup':$supersedes_date,'version':$version},

	})

	.done(function(e) {

		console.log(e);

		$('#task_success').modal('show');

		setTimeout(function(){
			  $('#task_success').modal('hide')
			}, 2000);

		Vue.set(app,'dash_menu','reports');

		$('#edit_report_form').trigger('reset');

		console.log("success");

	})

	.fail(function(e) {

		console.log(e);

		console.log("error");

	})

	.always(function() {

		console.log("complete");

	});

	

});



$(document).on('submit', '#admin_edit_work_order_form', function(event) {

	event.preventDefault();



	console.log('submitting');



	var formData = new FormData($('#admin_edit_work_order_form').get(0));

	formData.append('id',app.selected_order.WO_id);



	if(v_sign != undefined){

		formData.append('verified_by',v_sign);	

	}

	if(c_sign != undefined){

		formData.append('corrected_by',c_sign);	

	}



	if(v_sign != undefined){



		$.ajax({

			url: 'admin_complete_order',

			type: 'post',

			data: formData,

			cache: false,

		    contentType: false,

		    processData: false,

		})

		.done(function(e) {

			console.log(e);

			$('#task_success').modal('show');

			setTimeout(function(){
			  $('#task_success').modal('hide')
			}, 2000);

			// Vue.set(app,'dashMenu','completed');
			app.setDashMenuItem('completed',event);

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

	}



	if(c_sign != undefined){



		$.ajax({

			url: 'admin_qc_complete_order',

			type: 'post',

			data: formData,

			cache: false,

		    contentType: false,

		    processData: false,

		})

		.done(function(e) {

			console.log(e);

			$('#task_success').modal('show');

			setTimeout(function(){
			  $('#task_success').modal('hide')
			}, 2000);

			// Vue.set(app,'dashMenu','dashboard');
			app.setDashMenuItem('dashboard',event);

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

	}



	if(v_sign == undefined && c_sign == undefined){

		$.ajax({

			url: 'admin_edit_order',

			type: 'post',

			data: formData,

			cache: false,

		    contentType: false,

		    processData: false,

		})

		.done(function(e) {

			console.log(e);

			$('#task_success').modal('show');

			setTimeout(function(){
			  $('#task_success').modal('hide')
			}, 2000);

			// Vue.set(app,'dashMenu','dashboard');
			app.setDashMenuItem('dashboard',event);

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

	}



	if(v_sign != undefined && c_sign != undefined){

		$.ajax({

			url: 'admin_qc_and_verif_order',

			type: 'post',

			data: formData,

			cache: false,

		    contentType: false,

		    processData: false,

		})

		.done(function(e) {

			console.log(e);

			$('#task_success').modal('show');

			setTimeout(function(){
			  $('#task_success').modal('hide')
			}, 2000);

			// Vue.set(app,'dashMenu','dashboard');
			app.setDashMenuItem('dashboard',event);

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			console.log("error");

		})

		.always(function() {

			console.log("complete");

		});

	}







});





$(document).on('change', '#change_equipment_image', function(event) {

	event.preventDefault();

	/* Act on the event */



	$equipment_id = app.selected_equipment.id;

	var formData = new FormData();

	formData.append('file', $('#change_equipment_image')[0].files[0]);

	formData.append('id', $equipment_id);



	$('body').loadingModal({

		text: 'Adding File. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});



	$.ajax({

			url: 'upload_equipment_image',

			type: 'post',

			data: formData,

			processData: false,

			contentType: false,

			cache: false,

			async: false,

		})

		.done(function(ev) {

			console.log(ev);

			$('#task_success').modal('show');

			setTimeout(function(){
			  $('#task_success').modal('hide')
			}, 2000);

			$.ajax({

				url: 'fetch_equipments',

				type: 'post',

				data: { param1: 'value1' },

			})

			.done(function(e) {

				// console.log($.parseJSON(e));

				Vue.set(app, 'all_equipments', $.parseJSON(e));

				var result = app.all_equipments.filter(obj => {

				  return obj.id == app.selected_equipment.id;

				});



				console.log(result);

				app.selected_equipment = result[0];

				console.log("success");

			})

			.fail(function(e) {

				console.log(e);

				console.log("error");

			})

			.always(function() {

				console.log("complete");

			});

			console.log("success");

		})

		.fail(function(ev) {

			console.log(ev);

			console.log("error");

		})

		.always(function() {

			$('body').loadingModal('destroy');

			console.log("complete");

		});





});



$(document).on('click', '#save_equipment_details_btn', function(event) {

	event.preventDefault();

	/* Act on the event */

	console.log('submitting');

	$id = app.selected_equipment.id;

	$name = $('#equipment_name').val();	

	$serialNum = $('#equipment_serialNum').val();

	$modelNum = $('#equipment_modelNum').val();

	$make = $('#equipment_make').val();

	$asset = $('#equipment_asset').val();



	$partNum = $('#equipment_partNum').val();

	$supplier = $('#equipment_supplier').val();

	$link = $('#equipment_link').val();

	$unitPrice = $('#equipment_unitPrice').val();

	$qty = $('#equipment_qty').val();

	$invNum = $('#equipment_invNum').val();

	$shippingCost = $('#equipment_shippingCost').val();



	$missing = [];



	if($name == ''){

		$missing.push('Name')

	}



	if($serialNum == ''){

		$missing.push('Serial No')

	}



	if($modelNum == ''){

		$missing.push('Model No')

	}



	if($make == ''){

		$missing.push('Make')

	}



	if($asset == ''){

		$missing.push('Asset')

	}



	if($partNum == ''){

		$missing.push('Part No')

	}



	if($supplier == ''){

		$missing.push('Supplier')

	}



	if($link == ''){

		$missing.push('Link')

	}



	if($unitPrice == ''){

		$missing.push('Unit Price')

	}



	if($qty == ''){

		$missing.push('Qty')

	}



	if($invNum == ''){

		$missing.push('Invoice No')

	}



	if($shippingCost == ''){

		$missing.push('Shipping Cost')

	}



	$('#missing_values').html('');



	if($missing.length < 1){



		$('body').loadingModal({

			text: 'Saving Purchase Order. Please wait..',

			color: '#4bd396',

			animation: 'doubleBounce'

		});



		$.ajax({

			url: 'save_purchase_order',

			type: 'post',

			data: {'id':$id, 'name' :$name , 'serialNum' :$serialNum , 'modelNum' :$modelNum , 'make' :$make , 'asset' :$asset , 

			'partNum' :$partNum , 'supplier' :$supplier , 

			'link' :$link , 'unitPrice' :$unitPrice , 'qty' :$qty , 'invNum' :$invNum , 'shippingCost' :$shippingCost},

		})

		.done(function(e) {

			console.log(e);

			Vue.set(app,'modalMessage','Purchase Order Saved');

			Vue.set(app,'messageClass','text text-success');

			$('#purchase_order_form').trigger('reset');

			fetch_purchase_order();

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			Vue.set(app,'modalMessage','Purchase Order Saving Failed!');

					Vue.set(app,'messageClass','text text-danger');	

			console.log("error");

		})

		.always(function() {

			$('body').loadingModal('destroy');

			console.log("complete");

		});



	}else{

		var missing_string = '';

		for (i = 0; i < $missing.length; i++) { 

		    missing_string += $missing[i] + ", ";

		}



		$('#missing_values').removeClass('hidden');



		$('#missing_values').append('<p>These Fields are required </p> <p class="alert alert-danger"> ' + missing_string + '</p>');

	}



});





$(document).on('click','.delete-pur-order',function(event) {

	/* Act on the event */

	event.preventDefault();

	$id = event.target.id;

	Vue.set(app,'selected_equipment_pur_orders',$id);

	$("#delete_pur_order").modal('show');


});

$(document).on('click','#delete_purchase_order_btn',function(event) {

	/* Act on the event */

	event.preventDefault();

	$id = app.selected_equipment_pur_orders;



	$('body').loadingModal({

		text: 'Deleting Purchase Order. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});



	$.ajax({

		url: 'delete_purchase_order',

		type: 'post',

		data: {'id': $id},

	})

	.done(function(e) {

		console.log(e);

		Vue.set(app,'modalMessage','Purchase Order Deleted!');

		Vue.set(app,'messageClass','text text-success');		

		$("#delete_pur_order").modal('hide');

		$("#alertModal").modal('show');

		setTimeout(function(){
		  $('#alertModal').modal('hide')
		}, 2000);

		fetch_purchase_order();

		console.log("success");

	})

	.fail(function(e) {

		console.log(e);

		Vue.set(app,'modalMessage','Purchase Order Deletion Failed!');

		Vue.set(app,'messageClass','text text-danger');		

		$("#alertModal").modal('show');

		setTimeout(function(){
		  $('#alertModal').modal('hide')
		}, 2000);

		console.log("error");

	})

	.always(function() {

		$('body').loadingModal('destroy');

		console.log("complete");

	});

	



});



function fetch_purchase_order(){

	$.ajax({

		url: 'fetch_purchase_order',

		type: 'post',

		data: {'id': app.selected_equipment.id},

	})

	.done(function(e) {

		console.log(e);

		Vue.set(app, 'equipment_pur_orders', $.parseJSON(e));

		console.log("success");

	})

	.fail(function(e) {

		console.log("error");

	})

	.always(function() {

		console.log("complete");

	});

	

}



$(document).on('submit', '#edit_wo_form', function(event){

	event.preventDefault();



	var formData = new FormData($('#edit_wo_form').get(0));

	formData.append('id',app.selected_order.WO_id);



	console.log(...formData);



	if(app.selected_order.status == 'new'){



		if(app.selected_order.WO_issue_to_qa == '1'){



			if(c_sign != undefined){



				formData.append('corrected_by',c_sign);



				formData.append('corrected_date',$('#correction_date').val());



				$('body').loadingModal({

					text: 'Sending to QA. Please wait..',

					color: '#4bd396',

					animation: 'doubleBounce'

				});



				formData.append('status','approved');



				formData.append('issued_by',app.selected_order.WO_issued_by);



				if(app.qa_wash==true){

					formData.append('qa_wash',1);

				}else{

					formData.append('qa_wash',0);

				}

				

				if(app.qa_eqip_inspec == true){

					formData.append('qa_eqip_inspec',1);	

				}else{

					formData.append('qa_eqip_inspec',0);

				}

				

				if(app.qa_qc_inspec == true){

					formData.append('qa_qc_inspec',1);	

				}else{

					formData.append('qa_qc_inspec',0);

				}

				

				formData.append('qc_date',$('#qc_date').val());



				formData.append('issued_to',app.selected_order.WO_issue_to);				



				$.ajax({

					url: 'wo_qa_issued_save_order',

					type: 'post',

					data: formData,

					cache: false,

				    contentType: false,

				    processData: false,

				})

				.done(function(e) {

					console.log(e);

					Vue.set(app,'modalMessage','Work Order Saved');

					Vue.set(app,'messageClass','text text-success');

					app.setDashMenuItem('dashboard',event);	

					$("#alertModal").modal('show');

					setTimeout(function(){
					  $('#alertModal').modal('hide')
					}, 2000);



				})

				.fail(function(e) {

					console.log(e);

					Vue.set(app,'modalMessage','Work Order Save Failed!');

					Vue.set(app,'messageClass','text text-danger');		

					$("#alertModal").modal('show');

					setTimeout(function(){
					  $('#alertModal').modal('hide')
					}, 2000);

				})

				.always(function() {

					$('body').loadingModal('destroy');

					console.log("complete");

				});



			}else{



				Vue.set(app,'modalMessage','Need Corrected By Signature!');

				Vue.set(app,'messageClass','text text-danger');		

				$("#alertModal").modal('show');

				setTimeout(function(){
				  $('#alertModal').modal('hide')
				}, 2000);



			}

		}else{



			if(app.qa_hold == true || app.empl_saft_haz == true || app.qa_inspection == true){



				if(c_sign != undefined){



					formData.append('corrected_by',c_sign);



					$('body').loadingModal({

						text: 'Sending to QA for specified checks. Please wait..',

						color: '#4bd396',

						animation: 'doubleBounce'

					});



					formData.append('status','pending');



					formData.append('assigned_to',$('#assigned_to').val());



					if(app.qa_hold==true){

						formData.append('qa_hold',1);

					}else{

						formData.append('qa_hold',0);

					}

					

					if(app.qa_inspection == true){

						formData.append('qa_inspection',1);	

					}else{

						formData.append('qa_inspection',0);

					}

					

					if(app.empl_saft_haz == true){

						formData.append('emp_safety',1);	

					}else{

						formData.append('emp_safety',0);

					}



					formData.append('issued_to',app.selected_order.WO_issue_to);



					$.ajax({

						url: 'wo_edit_save_order',

						type: 'post',

						data: formData,

						cache: false,

					    contentType: false,

					    processData: false,

					})

					.done(function(e) {

						console.log(e);

						if(e == 'qa not selected'){

							Vue.set(app,'modalMessage','Select QA User in "Assigned to" field');

							Vue.set(app,'messageClass','text text-warning');

							// Vue.set(app,'dashMenu','dashboard');
							app.setDashMenuItem('dashboard',event);		

							$("#alertModal").modal('show');

							setTimeout(function(){
							  $('#alertModal').modal('hide')
							}, 2000);

						}else{

							Vue.set(app,'modalMessage','Work Order Saved');

							Vue.set(app,'messageClass','text text-success');

							app.setDashMenuItem('dashboard',event);		

							$("#alertModal").modal('show');

							setTimeout(function(){
							  $('#alertModal').modal('hide')
							}, 2000);

						}

						

					})

					.fail(function(e) {

						console.log(e);

						Vue.set(app,'modalMessage','Work Order Save Failed!');

						Vue.set(app,'messageClass','text text-danger');		

						$("#alertModal").modal('show');

						setTimeout(function(){
						  $('#alertModal').modal('hide')
						}, 2000);

					})

					.always(function() {

						$('body').loadingModal('destroy');

						console.log("complete");

					});



				}else{



					Vue.set(app,'modalMessage','Need Corrected By Signature!');

					Vue.set(app,'messageClass','text text-danger');		

					$("#alertModal").modal('show');

					setTimeout(function(){
					  $('#alertModal').modal('hide')
					}, 2000);

				}

			}else{



				if(c_sign != undefined){



					formData.append('corrected_by',c_sign);



					$('body').loadingModal({

						text: 'Sending to assigned user for correction. Please wait..',

						color: '#4bd396',

						animation: 'doubleBounce'

					});



					formData.append('status','approved');



					formData.append('assigned_to',$('#assigned_to').val());



					if(app.qa_hold==true){

						formData.append('qa_hold',1);

					}else{

						formData.append('qa_hold',0);

					}

					

					if(app.qa_inspection == true){

						formData.append('qa_inspection',1);	

					}else{

						formData.append('qa_inspection',0);

					}

					

					if(app.empl_saft_haz == true){

						formData.append('emp_safety',1);	

					}else{

						formData.append('emp_safety',0);

					}



					formData.append('issued_by',app.selected_order.WO_issued_by);

					
					console.log('request completin');


					$.ajax({

						url: 'wo_edit_requested_order',

						type: 'post',

						data: formData,

						cache: false,

					    contentType: false,

					    processData: false,

					})

					.done(function(e) {

						console.log(e);

						Vue.set(app,'modalMessage','Work Order Saved');

						Vue.set(app,'messageClass','text text-success');

						// Vue.set(app,'dashMenu','dashboard');
						app.setDashMenuItem('dashboard',event);		

						$("#alertModal").modal('show');

						setTimeout(function(){
						  $('#alertModal').modal('hide')
						}, 2000);

					})

					.fail(function(e) {

						console.log(e);

						Vue.set(app,'modalMessage','Work Order Save Failed!');

						Vue.set(app,'messageClass','text text-danger');		

						$("#alertModal").modal('show');

						setTimeout(function(){
						  $('#alertModal').modal('hide')
						}, 2000);

					})

					.always(function() {

						$('body').loadingModal('destroy');

						console.log("complete");

					});



				}else{



					Vue.set(app,'modalMessage','Need Corrected By Signature!');

					Vue.set(app,'messageClass','text text-danger');		

					$("#alertModal").modal('show');

					setTimeout(function(){
					  $('#alertModal').modal('hide')
					}, 2000);



				}



			}



		}



		



	}



	if(app.selected_order.status == 'pending'){



		if(q_sign != undefined){



			formData.append('qc_approved_by',q_sign);

			formData.append('corrected_on',$('#qc_date').val());



			$('body').loadingModal({

				text: 'QA/QC Approving. Please wait..',

				color: '#4bd396',

				animation: 'doubleBounce'

			});



			formData.append('status','approved');





			if(app.qa_wash==true){

				formData.append('qa_wash',1);

			}else{

				formData.append('qa_wash',0);

			}

			

			if(app.qa_eqip_inspec == true){

				formData.append('qa_eqip_inspec',1);	

			}else{

				formData.append('qa_eqip_inspec',0);

			}

			

			if(app.qa_qc_inspec == true){

				formData.append('qa_qc_inspec',1);	

			}else{

				formData.append('qa_qc_inspec',0);

			}

			

			formData.append('qc_date',$('#qc_date').val());

			formData.append('tracking',app.selected_order.WO_issued_by);





			$.ajax({

				url: 'wo_qc_edit_save_order',

				type: 'post',

				data: formData,

				cache: false,

			    contentType: false,

			    processData: false,

			})

			.done(function(e) {

				console.log(e);

				Vue.set(app,'modalMessage','Quality Check Completed');

				Vue.set(app,'messageClass','text text-success');

				// Vue.set(app,'dashMenu','dashboard');
				app.setDashMenuItem('dashboard',event);		

				$("#alertModal").modal('show');

				setTimeout(function(){
				  $('#alertModal').modal('hide')
				}, 2000);

			})

			.fail(function(e) {

				console.log(e);

				Vue.set(app,'modalMessage','Quality Check Failed!');

				Vue.set(app,'messageClass','text text-danger');		

				$("#alertModal").modal('show');

				setTimeout(function(){
				  $('#alertModal').modal('hide')
				}, 2000);

			})

			.always(function() {

				$('body').loadingModal('destroy');

				console.log("complete");

			});



		}else{



			Vue.set(app,'modalMessage','Need QA/QC Signature!');

			Vue.set(app,'messageClass','text text-danger');		

			$("#alertModal").modal('show');

			setTimeout(function(){
			  $('#alertModal').modal('hide')
			}, 2000);



		}



		



	}



	if(app.selected_order.status == 'approved'){



		if(v_sign != undefined){



			formData.append('verified_by',v_sign);



			$('body').loadingModal({

				text: 'Verifying And Completing Order. Please wait..',

				color: '#4bd396',

				animation: 'doubleBounce'

			});



			formData.append('status','completed');

			

			formData.append('verified_date',$('#verified_date').val());



			$.ajax({

				url: 'wo_issuer_complete_order',

				type: 'post',

				data: formData,

				cache: false,

			    contentType: false,

			    processData: false,

			})

			.done(function(e) {

				console.log(e);

				Vue.set(app,'modalMessage','Work Order Completed');

				Vue.set(app,'messageClass','text text-success');

				// Vue.set(app,'dashMenu','dashboard');	
				app.setDashMenuItem('dashboard',event);	

				$("#alertModal").modal('show');

				setTimeout(function(){
				  $('#alertModal').modal('hide')
				}, 2000);

			})

			.fail(function(e) {

				console.log(e);

				Vue.set(app,'modalMessage','Work Order Completletion Failed!');

				Vue.set(app,'messageClass','text text-danger');		

				$("#alertModal").modal('show');

				setTimeout(function(){
				  $('#alertModal').modal('hide')
				}, 2000);

			})

			.always(function() {

				$('body').loadingModal('destroy');

				console.log("complete");

			});



		}else{



			Vue.set(app,'modalMessage','Need Verifier Signature!');

			Vue.set(app,'messageClass','text text-danger');		

			$("#alertModal").modal('show');

			setTimeout(function(){
			  $('#alertModal').modal('hide')
			}, 2000);



		}



	}



});





$(document).on('click','.delete-work-order',function(event){

	event.preventDefault();

	/* Act on the event */

	console.log(event.target.id);

	$id = event.target.id;

	app.setSelectedWorkOrder($id);

});

$(document).on('click','.delete-pending-order',function(event){

	event.preventDefault();

	/* Act on the event */

	console.log(event.target.id);

	$id = event.target.id;

	app.setSelectedPendingOrder($id);

});

$(document).on('click','.delete-overdue-order',function(event){

	event.preventDefault();

	/* Act on the event */

	console.log(event.target.id);

	$id = event.target.id;

	app.setSelectedOverdueOrder($id);

});



$(document).on('click','#delete_work_order_btn',function(event) {

	/* Act on the event */

	event.preventDefault();

	$id = app.selected_order.WO_id;	

	console.log($id);



	$('body').loadingModal({

		text: 'Deleting Work Order. Please wait..',

		color: '#4bd396',

		animation: 'doubleBounce'

	});



	$.ajax({

		url: 'delete_work_order',

		type: 'post',

		data: {'id': $id},

	})

	.done(function(e) {

		console.log(e);

		Vue.set(app,'modalMessage','Work Order Deleted!');

		Vue.set(app,'messageClass','text text-success');		

		$("#delete_work_order").modal('hide');

		$("#alertModal").modal('show');	

		setTimeout(function(){
		  $('#alertModal').modal('hide')
		}, 2000);	

		get_all_data();

		console.log("success");

	})

	.fail(function(e) {

		console.log(e);

		Vue.set(app,'modalMessage','Work Order Deletion Failed!');

		Vue.set(app,'messageClass','text text-danger');	

		$("#delete_work_order").modal('hide');

		$("#alertModal").modal('show');

		setTimeout(function(){
		  $('#alertModal').modal('hide')
		}, 2000);

		console.log("error");

	})

	.always(function() {

		$('body').loadingModal('destroy');

		console.log("complete");

	});

	



});

$(document).on('click', '.edit-pur-order', function(event) {
	event.preventDefault();

	$id = event.target.id;
	console.log($id);
	app.setSelectedPurchaseOrder($id);

	$("#edit_purchase_order").modal('hide');


});

$(document).on('click', '#save_purchase_btn', function(event) {
	event.preventDefault();

	$id = app.selectedPurchaseOrder.id;

	$partNum = $('#edit_equipment_partNum').val();

	$supplier = $('#edit_equipment_supplier').val();

	$link = $('#edit_equipment_link').val();

	$unitPrice = $('#edit_equipment_unitPrice').val();

	$qty = $('#edit_equipment_qty').val();

	$invNum = $('#edit_equipment_invNum').val();

	$shippingCost = $('#edit_equipment_shippingCost').val();



	$missing = [];


	if($partNum == ''){

		$missing.push('Part No')

	}



	if($supplier == ''){

		$missing.push('Supplier')

	}



	if($link == ''){

		$missing.push('Link')

	}



	if($unitPrice == ''){

		$missing.push('Unit Price')

	}



	if($qty == ''){

		$missing.push('Qty')

	}



	if($invNum == ''){

		$missing.push('Invoice No')

	}



	if($shippingCost == ''){

		$missing.push('Shipping Cost')

	}



	$('#missing_values').html('');

	console.log($missing);

	if($missing.length < 1){



		$('body').loadingModal({

			text: 'Saving Purchase Order. Please wait..',

			color: '#4bd396',

			animation: 'doubleBounce'

		});



		$.ajax({

			url: 're_save_purchase_order',

			type: 'post',

			data: {'id':$id,'partNum' :$partNum , 'supplier' :$supplier , 'link' :$link , 'unitPrice' :$unitPrice , 'qty' :$qty ,
			 'invNum' :$invNum , 'shippingCost' :$shippingCost},

		})

		.done(function(e) {

			console.log(e);

			Vue.set(app,'modalMessage','Purchase Order Saved');

			Vue.set(app,'messageClass','text text-success');

			$('#edit_purchase_order').modal('hide');

			fetch_purchase_order();

			console.log("success");

		})

		.fail(function(e) {

			console.log(e);

			Vue.set(app,'modalMessage','Purchase Order Saving Failed!');

					Vue.set(app,'messageClass','text text-danger');	

			console.log("error");

		})

		.always(function() {

			$('body').loadingModal('destroy');

			console.log("complete");

		});



	}else{

		var missing_string = '';

		for (i = 0; i < $missing.length; i++) { 

		    missing_string += $missing[i] + ", ";

		}



		$('#missing_values').removeClass('hidden');



		$('#missing_values').append('<p>These Fields are required </p> <p class="alert alert-danger"> ' + missing_string + '</p>');

	}
	
});

