

<div v-if="dash_menu == 'dashboard'">

    <div class="content-page">

            <div class="content">

                <div class="container">

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="page-title-box">

                                <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                <ol class="breadcrumb p-0 m-0">

                                    <li>

                                        <a href="#">Home</a>

                                    </li>

                                    <li class="active">

                                        Dashboard

                                    </li>

                                </ol>

                                <div class="clearfix"></div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-3 col-md-6">

                            <a href="new_order" class="card-href" @click="setDashMenuItem('work_orders',$event)">

                                <div class="card-box widget-box-one">

                                    <i class="mdi mdi-star-circle widget-one-icon"></i>

                                    <div class="wigdet-one-content">

                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="new-wo">New Work Orders</p>

                                        <h2>{{ new_work_orders.length }}<small><i class="mdi mdi-arrow-up text-success"></i></small></h2>



                                    </div>

                                </div>

                            </a>

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <a href="completed.html" class="card-href"  @click="setDashMenuItem('completed',$event)">

                                <div class="card-box widget-box-one">

                                    <i class="mdi mdi-clipboard-check widget-one-icon"></i>

                                    <div class="wigdet-one-content">

                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Completed Jobs</p>

                                        <h2>{{ completed_work_orders.length }}<small><i class="mdi mdi-arrow-up text-success"></i></small></h2>



                                    </div>

                                </div>

                            </a>

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <a href="overdue.html" class="card-href" @click="setDashMenuItem('overdue',$event)">

                                <div class="card-box widget-box-one">

                                    <i class="mdi mdi mdi-alert widget-one-icon"></i>

                                    <div class="wigdet-one-content">

                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Over Due</p>

                                        <h2>{{ overdue_work_orders.length }} <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>



                                    </div>

                                </div>

                            </a>

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <a href="pending.html" class="card-href" @click="setDashMenuItem('pending',$event)">

                                <div class="card-box widget-box-one">

                                    <i class="mdi mdi-clock-alert widget-one-icon"></i>

                                    <div class="wigdet-one-content">

                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Pending Jobs</p>

                                        <h2>{{ pending_work_orders.length }} <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>



                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12">



                            <div class="card-box">

                                <div class="table-responsive">

                                    <table class="table table-striped mails m-0 table ">

                                        <thead>

                                            <tr>

                                                <th>Status</th>

                                                <th>Description</th>

                                                <th>Submitted By</th>

                                                <th>Due Date</th>

                                                <th>Assigned to</th>

                                                <th>Action</th>

                                                <th>Tracking</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr v-for="(order,indx) in all_work_orders.slice().reverse().slice(0,dashboard_work_orders_page*10)" v-if="order.status != 'completed'">

                                                <td>

                                                    <span v-if="order.status == 'new'" class="badge badge-success">

                                                        {{ order.status }}

                                                    </span>

                                                    <span v-if="order.status == 'completed'" class="badge badge-info">

                                                        {{ order.status }}

                                                    </span>

                                                    <span v-if="order.status == 'pending'" class="badge badge-danger">

                                                        {{ order.status }}

                                                    </span>

                                                    <span v-if="order.status == 'approved'" class="badge badge-danger">

                                                        pending

                                                    </span>

                                                </td>

                                                <td>{{ order.WO_description }}</td>

                                                <td>{{ order.WO_issued_by }}</td>

                                                <td>{{ order.WO_due_date }}</td>

                                                <td>{{ order.WO_issue_to }}</td>

                                                <td>

                                                    <a href="#" class="table-action-btn h3">

                                                        <i class="mdi mdi-pencil-box-outline text-success edit-order" :id="indx"></i>

                                                    </a>

                                                    <a href="#" class="table-action-btn h3 delete-work-order"  data-toggle="modal" data-target="#delete_work_order" :id="indx" v-if="<?php echo $this->ion_auth->get_users_groups()->row()->id ?> == '1'">

                                                        <i class="mdi mdi-close-box-outline text-danger" :id="indx"></i>

                                                    </a>

                                                </td>

                                                <td>{{ order.tracking }}</td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>



                            <div class="text-right">

                                <ul class="pagination pagination-split m-t-0">



                                    <!-- <li v-for="page in computed_all_work_orders_tot_pages">

                                        <a href="#" @click="setDashboardPage(page,$event)">{{ page }}</a>

                                    </li> -->

                                    <li>

                                        <a href="#" @click="setDashboardPage($event)">Show More</a>

                                    </li>



                                </ul>

                            </div>



                        </div>

                    </div>

                </div>

            </div>

            <footer class="footer text-right">

                2017 &copy; Buy Fresh Produce Inc.

            </footer>

    </div>

</div>



<div v-if="dash_menu == 'work_orders'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    New

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row">

                    <div class="col-lg-12">



                        <div class="card-box">



                            <div class="table-responsive">

                                <table class="table table-striped mails m-0 table ">

                                    <thead>

                                        <tr>

                                            <th>Status</th>

                                            <th>Description</th>

                                            <th>Submitted By</th>

                                            <th>Due Date</th>

                                            <th>Assigned to</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>



                                    <tbody>



                                        <tr v-for="(order,indx) in new_work_orders.slice().reverse().slice(0,new_work_orders_page*10)">

                                            <td>

                                                <span class="badge badge-success" v-if="order.status == 'approved'">

                                                    pending

                                                </span>

                                                <span class="badge badge-success" v-else>

                                                    {{ order.status }}

                                                </span>

                                            </td>

                                            <td>{{ order.WO_description }}</td>

                                            <td>{{ order.WO_issued_by }}</td>

                                            <td>{{ order.WO_due_date }}</td>

                                            <td>{{ order.WO_issue_to }}</td>

                                            <td>

                                                <a href="#" class="table-action-btn h3">

                                                    <i class="mdi mdi-pencil-box-outline text-success edit-new-order" :id="indx"></i>

                                                </a>

                                                <a href="#" class="table-action-btn h3 delete-work-order"  data-toggle="modal" data-target="#delete_work_order" :id="indx"  v-if="<?php echo $this->ion_auth->get_users_groups()->row()->id ?> == '1'">

                                                    <i class="mdi mdi-close-box-outline text-danger" :id="indx"></i>

                                                </a>

                                            </td>

                                        </tr>



                                    </tbody>

                                </table>

                            </div> <!-- end table responsive -->

                        </div> <!-- end card-box -->



                        <div class="text-right">

                            <ul class="pagination pagination-split m-t-0">

                                <li>

                                    <a href="#" @click="setWorkOrderPage($event)">Show More</a>

                                </li>

                            </ul>

                        </div>







                    </div> <!-- end col -->





                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'completed'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Completed

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row">

                    <div class="col-lg-12">





                        <div class="card-box">



                            <div class="table-responsive">

                                <table class="table table-striped mails m-0 table ">

                                    <thead>

                                        <tr>

                                            <th>Status</th>

                                            <th>Description</th>

                                            <th>Submitted By</th>

                                            <th>Due Date</th>

                                            <th>Assigned to</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>



                                    <tbody>



                                        <tr v-for="(order,indx) in completed_work_orders.slice().reverse().slice(0,completed_work_orders_page*10)">

                                            <td>

                                                <span class="badge badge-success">

                                                    Completed

                                                </span>

                                            </td>

                                            <td>{{ order.WO_description }}</td>

                                            <td>{{ order.WO_issued_by }}</td>

                                            <td>{{ order.WO_due_date }}</td>

                                            <td>{{ order.WO_assigned_to }}</td>

                                            <td><a href="#" class="btn btn-primary btn-sm" :id="indx" @click="setDashMenuItem('view_completed',$event)">View</a></td>

                                        </tr>



                                    </tbody>

                                </table>

                            </div> <!-- end table responsive -->

                        </div> <!-- end card-box -->



                        <div class="text-right">

                            <ul class="pagination pagination-split m-t-0">



                                <li>

                                    <a href="#" @click = "setCompletedPage($event)">Show More</a>

                                </li>



                            </ul>

                        </div>







                    </div> <!-- end col -->





                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'view_completed'">

   <div class="content-page">

            <!-- Start content -->

            <div class="content">

                <div class="container">





                    <div class="row">

                        <div class="col-xs-12">

                            <div class="page-title-box">

                                <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                <ol class="breadcrumb p-0 m-0">

                                    <li>

                                        <a href="#">Home</a>

                                    </li>

                                    <li class="active">

                                        New Work Order

                                    </li>

                                </ol>

                                <div class="clearfix"></div>

                            </div>

                        </div>

                    </div>

                    <!-- end row -->



                    <div class="row">

                        <form method="post" id="edit_wo_form">

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label for="">Work Order Issue Date</label>

                                    <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Work Order No</label>

                                    <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Attachments</label>

                                    <div v-for="image in work_order_images" >

                                        <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                    </div>

                                </div>

                                <!-- <div class="form-group">

                                    <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                </div> -->

                            </div>

                            <div class="col-md-7">

                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Equipment No</label>

                                            <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Location</label>

                                            <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Work Order Issued To</label>

                                            <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to"  style="pointer-events:none;" disabled>

                                                <option value="Maintanance">Maintanance</option>

                                                <option value="Quality Check">Quality Check</option>

                                                <option value="Returns">Returns</option>

                                                <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Due By</label>

                                            <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="">Description</label>

                                            <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Corrective Action Description</label>

                                            <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description" disabled></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">QC Inspection and Approved By</label>

                                                    <div disabled>

                                                        <canvas id="qaqc_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                                    </div>

                                                    <button type="button" id="qaqc_sign_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="qaqc_sign_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Date</label>

                                                    <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" v-if="selected_order.WO_issue_date != null" :value="selected_order.WO_issue_date" readonly>

                                                    <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" name="date" v-else>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Comments / General Notes</label>

                                            <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes" readonly></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">Verified By</label>

                                                    <canvas id="verified_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"> <p>Sign Here</p> </canvas>

                                                    <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Verified Date</label>

                                                    <input type="text" class="form-control datepicker-autoclose" id="Text" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                    <input type="text" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" v-else id="Text" value="<?php echo date("Y-m-d"); ?>" readonly>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group" >

                                    <label for="">Assigned To</label>

                                    <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to" style="pointer-events:none;" disabled >

                                        <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                        <input id="qa_hold" type="checkbox" v-else>

                                        <label for="checkbox1">

                                            QA Hold

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                        <input id="qa_inspection" type="checkbox" v-else>

                                        <label for="checkbox2">

                                            QA Inspection Required

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                        <input id="emply_safety_haz" type="checkbox" v-else>

                                        <label for="checkbox3">

                                            Employee Safety Hazard

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="">Corrected By</label>

                                    <div disabled>

                                        <canvas id="corrected_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                    </div>

                                    <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                    <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                </div>



                                <div class="form-group">

                                    <label for="">Corrective Action Date</label>

                                    <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date" readonly>

                                    <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d" readonly>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox4" name="eq_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                        <input id="checkbox4" name="eq_wash" v-else type="checkbox" >

                                        <label for="checkbox4">

                                            Equipment Wash &amp; Sanitized

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox5" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked >

                                        <input id="checkbox5" name="qa_formed" v-else type="checkbox" >

                                        <label for="checkbox5">

                                            QA Formed for Equipment Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox6" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked >

                                        <input id="checkbox6" name="qa_qc_inspec" v-else type="checkbox" >

                                        <label for="checkbox6">

                                            QA/QC Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group" style="pointer-events:none;">

                                    <label for="exampleInputFile">Attachments</label>

                                    <input type="file" id="edit_image_file">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12 col-sm-offset-8">

                                    <button type="submit" class="btn btn-success waves-effect" disabled>

                                        Save

                                    </button>

                                    <button type="reset" class="btn btn-default waves-effect m-l-5" disabled>

                                        Clear

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>







                </div> <!-- container -->



            </div> <!-- content -->



            <footer class="footer text-right">

                2017 &copy; Buy Fresh Produce Inc.

            </footer>

    </div>

</div>



<div v-if="dash_menu == 'overdue'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Over Due

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row">

                    <div class="col-lg-12">





                        <div class="card-box">



                            <div class="table-responsive">

                                <table class="table table-striped mails m-0 table ">

                                    <thead>

                                        <tr>

                                            <th>Status</th>

                                            <th>Description</th>

                                            <th>Submitted By</th>

                                            <th>Due Date</th>

                                            <th>Assigned to</th>

                                            <th>Tracking</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>



                                    <tbody>



                                        <tr v-for="(order,indx) in overdue_work_orders.slice().reverse().slice(0,overdue_work_orders_page*10)">

                                            <td>

                                                <span class="badge badge-success" v-if="order.status == 'approved'">

                                                    pending

                                                </span>

                                                <span class="badge badge-success" v-else>

                                                    {{ order.status }}

                                                </span>

                                            </td>

                                            <td>{{ order.WO_description }}</td>

                                            <td>{{ order.WO_issued_by }}</td>

                                            <td class="text-danger"><i class="mdi mdi-alert"></i>{{ order.WO_due_date }}</td>

                                            <td>{{ order.WO_assigned_to }}</td>

                                            <td>{{ order.tracking }}</td>

                                             <td>

                                                <a href="#" class="table-action-btn h3">

                                                    <i class="mdi mdi-pencil-box-outline text-success edit-overdue-order" :id="indx"></i>

                                                </a>

                                                <a href="#" class="table-action-btn h3 delete-pending-order"  data-toggle="modal" data-target="#delete_work_order" :id="indx" v-if="<?php echo $this->ion_auth->get_users_groups()->row()->id ?> == '1'">

                                                    <i class="mdi mdi-close-box-outline text-danger" :id="indx"></i>

                                                </a>

                                             </td>



                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>



                        <div class="text-right">

                            <ul class="pagination pagination-split m-t-0">



                                <li >

                                    <a href="#" @click="setOverduePage($event)">Show More</a>

                                </li>





                            </ul>

                        </div>



                    </div> <!-- end col -->





                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'view_overdue'">

   <div class="content-page">

            <!-- Start content -->

            <div class="content">

                <div class="container">





                    <div class="row">

                        <div class="col-xs-12">

                            <div class="page-title-box">

                                <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                <ol class="breadcrumb p-0 m-0">

                                    <li>

                                        <a href="#">Home</a>

                                    </li>

                                    <li class="active">

                                        New Work Order

                                    </li>

                                </ol>

                                <div class="clearfix"></div>

                            </div>

                        </div>

                    </div>

                    <!-- end row -->



                    <div class="row">

                        <form method="post" id="edit_wo_form">

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label for="">Work Order Issue Date</label>

                                    <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Work Order No</label>

                                    <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Attachments</label>

                                    <div v-for="image in work_order_images" >

                                        <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                    </div>

                                </div>

                                <!-- <div class="form-group">

                                    <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                </div> -->

                            </div>

                            <div class="col-md-7">

                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Equipment No</label>

                                            <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Location</label>

                                            <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Work Order Issued To</label>

                                            <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to"  style="pointer-events:none;" disabled>

                                                <option value="Maintanance">Maintanance</option>

                                                <option value="Quality Check">Quality Check</option>

                                                <option value="Returns">Returns</option>

                                                <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Due By</label>

                                            <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="">Description</label>

                                            <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Corrective Action Description</label>

                                            <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description" disabled></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">QC Inspection and Approved By</label>

                                                    <div disabled>

                                                        <canvas id="qaqc_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                                    </div>

                                                    <button type="button" id="qaqc_sign_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="qaqc_sign_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Date</label>

                                                    <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" v-if="selected_order.WO_issue_date != null" :value="selected_order.WO_issue_date" readonly>

                                                    <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" name="date" v-else>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Comments / General Notes</label>

                                            <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes" readonly></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">Verified By</label>

                                                    <canvas id="verified_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"> <p>Sign Here</p> </canvas>

                                                    <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Verified Date</label>

                                                    <input type="text" class="form-control datepicker-autoclose" id="Text" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                    <input type="text" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" v-else id="Text" value="<?php echo date("Y-m-d"); ?>" readonly>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group" >

                                    <label for="">Assigned To</label>

                                    <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to" style="pointer-events:none;" disabled >

                                        <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                        <input id="qa_hold" type="checkbox" v-else>

                                        <label for="checkbox1">

                                            QA Hold

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                        <input id="qa_inspection" type="checkbox" v-else>

                                        <label for="checkbox2">

                                            QA Inspection Required

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                        <input id="emply_safety_haz" type="checkbox" v-else>

                                        <label for="checkbox3">

                                            Employee Safety Hazard

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="">Corrected By</label>

                                    <div disabled>

                                        <canvas id="corrected_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                    </div>

                                    <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                    <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                </div>



                                <div class="form-group">

                                    <label for="">Corrective Action Date</label>

                                    <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date" readonly>

                                    <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d" readonly>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox4" name="eq_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                        <input id="checkbox4" name="eq_wash" v-else type="checkbox" >

                                        <label for="checkbox4">

                                            Equipment Wash &amp; Sanitized

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox5" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked >

                                        <input id="checkbox5" name="qa_formed" v-else type="checkbox" >

                                        <label for="checkbox5">

                                            QA Formed for Equipment Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox6" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked >

                                        <input id="checkbox6" name="qa_qc_inspec" v-else type="checkbox" >

                                        <label for="checkbox6">

                                            QA/QC Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group" style="pointer-events:none;">

                                    <label for="exampleInputFile">Attachments</label>

                                    <input type="file" id="edit_image_file">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12 col-sm-offset-8">

                                    <button type="submit" class="btn btn-success waves-effect" disabled>

                                        Save

                                    </button>

                                    <button type="reset" class="btn btn-default waves-effect m-l-5" disabled>

                                        Clear

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>







                </div> <!-- container -->



            </div> <!-- content -->



            <footer class="footer text-right">

                2017 &copy; Buy Fresh Produce Inc.

            </footer>

    </div>

</div>



<div v-if="dash_menu == 'pending'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Pending

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row">

                    <div class="col-lg-12">





                        <div class="card-box">



                            <div class="table-responsive">

                                <table class="table table-striped mails m-0 table ">

                                    <thead>

                                        <tr>

                                            <th>Status</th>

                                            <th>Description</th>

                                            <th>Submitted By</th>

                                            <th>Due Date</th>

                                            <th>Assigned to</th>

                                            <th>Tracking</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>



                                    <tbody>



                                        <tr v-for="(order,indx) in pending_work_orders.slice().reverse().slice(0,pending_work_orders_page*10)">

                                            <td>

                                                <span class="badge badge-danger">

                                                    Pending

                                                </span>

                                            </td>

                                            <td>{{ order.WO_description }}</td>

                                            <td>{{ order.WO_issued_by }}</td>

                                            <td>{{ order.WO_due_date }}</td>

                                            <td>{{ order.WO_assigned_to }}</td>

                                            <td>{{ order.tracking }}</td>

                                            <td>

                                                <a href="#" class="table-action-btn h3">

                                                    <i class="mdi mdi-pencil-box-outline text-success edit-pending-order" :id="indx"></i>

                                                </a>

                                                <a href="#" class="table-action-btn h3 delete-pending-order"  data-toggle="modal" data-target="#delete_work_order" :id="indx" v-if="<?php echo $this->ion_auth->get_users_groups()->row()->id ?> == '1'">

                                                    <i class="mdi mdi-close-box-outline text-danger" :id="indx"></i>

                                                </a>

                                            </td>

                                        </tr>



                                    </tbody>

                                </table>

                            </div> <!-- end table responsive -->

                        </div> <!-- end card-box -->



                        <div class="text-right">

                            <ul class="pagination pagination-split m-t-0">



                                <li >

                                    <a href="#"  @click="setPendingPage($event)">Show More</a>

                                </li>



                            </ul>

                        </div>







                    </div> <!-- end col -->





                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'view_pending'">

   <div class="content-page">

            <!-- Start content -->

            <div class="content">

                <div class="container">





                    <div class="row">

                        <div class="col-xs-12">

                            <div class="page-title-box">

                                <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                <ol class="breadcrumb p-0 m-0">

                                    <li>

                                        <a href="#">Home</a>

                                    </li>

                                    <li class="active">

                                        New Work Order

                                    </li>

                                </ol>

                                <div class="clearfix"></div>

                            </div>

                        </div>

                    </div>

                    <!-- end row -->



                    <div class="row">

                        <form method="post" id="edit_wo_form">

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label for="">Work Order Issue Date</label>

                                    <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Work Order No</label>

                                    <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Attachments</label>

                                    <div v-for="image in work_order_images" >

                                        <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                    </div>

                                </div>

                                <!-- <div class="form-group">

                                    <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                </div> -->

                            </div>

                            <div class="col-md-7">

                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Equipment No</label>

                                            <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Location</label>

                                            <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Work Order Issued To</label>

                                            <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to"  style="pointer-events:none;" disabled>

                                                <option value="Maintanance">Maintanance</option>

                                                <option value="Quality Check">Quality Check</option>

                                                <option value="Returns">Returns</option>

                                                <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Due By</label>

                                            <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="">Description</label>

                                            <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Corrective Action Description</label>

                                            <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description" disabled></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">QC Inspection and Approved By</label>

                                                    <div disabled>

                                                        <canvas id="qaqc_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                                    </div>

                                                    <button type="button" id="qaqc_sign_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="qaqc_sign_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Date</label>

                                                    <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" v-if="selected_order.WO_issue_date != null" :value="selected_order.WO_issue_date" readonly>

                                                    <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" name="date" v-else>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Comments / General Notes</label>

                                            <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes" readonly></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">Verified By</label>

                                                    <canvas id="verified_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"> <p>Sign Here</p> </canvas>

                                                    <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Verified Date</label>

                                                    <input type="text" class="form-control datepicker-autoclose" id="Text" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                    <input type="text" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" v-else id="Text" value="<?php echo date("Y-m-d"); ?>" readonly>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group" >

                                    <label for="">Assigned To</label>

                                    <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to" style="pointer-events:none;" disabled >

                                        <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                        <input id="qa_hold" type="checkbox" v-else>

                                        <label for="checkbox1">

                                            QA Hold

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                        <input id="qa_inspection" type="checkbox" v-else>

                                        <label for="checkbox2">

                                            QA Inspection Required

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                        <input id="emply_safety_haz" type="checkbox" v-else>

                                        <label for="checkbox3">

                                            Employee Safety Hazard

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="">Corrected By</label>

                                    <div disabled>

                                        <canvas id="corrected_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                    </div>

                                    <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                    <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                </div>



                                <div class="form-group">

                                    <label for="">Corrective Action Date</label>

                                    <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date" readonly>

                                    <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d" readonly>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox4" name="eq_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                        <input id="checkbox4" name="eq_wash" v-else type="checkbox" >

                                        <label for="checkbox4">

                                            Equipment Wash &amp; Sanitized

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox5" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked >

                                        <input id="checkbox5" name="qa_formed" v-else type="checkbox" >

                                        <label for="checkbox5">

                                            QA Formed for Equipment Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox6" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked >

                                        <input id="checkbox6" name="qa_qc_inspec" v-else type="checkbox" >

                                        <label for="checkbox6">

                                            QA/QC Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group" style="pointer-events:none;">

                                    <label for="exampleInputFile">Attachments</label>

                                    <input type="file" id="edit_image_file">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12 col-sm-offset-8">

                                    <button type="submit" class="btn btn-success waves-effect" disabled>

                                        Save

                                    </button>

                                    <button type="reset" class="btn btn-default waves-effect m-l-5" disabled>

                                        Clear

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>







                </div> <!-- container -->



            </div> <!-- content -->



            <footer class="footer text-right">

                2017 &copy; Buy Fresh Produce Inc.

            </footer>

    </div>

</div>



<div v-if="dash_menu == 'reports'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Reports

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row m-b-20">

                    <div class="col-md-6 col-md-offset-3 text-center">

                        <form action="" class="form-inline">

                            <div class="form-group">

                                <select name="" id="sort_report" class="form-control">

                                    <option value="WO_issue_date">By Date</option>

                                    <option value="WO_issued_by">By Name</option>

                                    <option value="eqp_no">Equipment No</option>

                                    <option value="WO_verified_date">Completed</option>

                                </select>

                            </div>

                            <div class="form-group">

                                <input type="submit" class="btn btn-primary">

                            </div>

                        </form>

                    </div>

                </div>



                <div class="row">

                    <div class="col-lg-12">



                        <div class="card-box">



                            <div class="table-responsive">

                                <table class="table table-striped mails m-0 table ">

                                    <thead>

                                        <tr>

                                            <th>Status</th>

                                            <th>Description</th>

                                            <th>Submitted By</th>

                                            <th>Due Date</th>

                                            <th>Assigned to</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>



                                    <tbody>



                                        <tr v-for="(order,indx) in completed_work_orders.slice().reverse().slice(0,completed_work_orders_page*10)">

                                            <td>

                                                <span class="badge badge-success">

                                                    Completed

                                                </span>

                                            </td>

                                            <td>{{ order.WO_description }}</td>

                                            <td>{{ order.WO_issued_by }}</td>

                                            <td>{{ order.WO_due_date }}</td>

                                            <td>{{ order.WO_assigned_to }}</td>

                                            <td>

                                                <a href="#" class="btn btn-primary btn-sm" :id="indx" @click="setDashMenuItem('wo_report',$event)">View</a>

                                            </td>

                                        </tr>



                                    </tbody>

                                </table>

                            </div> <!-- end table responsive -->

                        </div> <!-- end card-box -->



                        <div class="text-right">

                            <ul class="pagination pagination-split m-t-0">



                                <li>

                                    <a href="#" @click="setReportsPage($event)">Show More</a>

                                </li>



                            </ul>

                        </div>





                    </div> <!-- end col -->





                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'edit_report'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Edit Report

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row">

                    <div class="col-md-6 col-md-offset-3">

                        <div class="p-20 p-t-0">

                            <div class="">

                                <h4 class="text-uppercase">Edit Report</h4>

                                <div class="border m-b-20"></div>



                                <form role="form" id="edit_report_form" action="" method="POST">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="Start Date" id="rep_from_date" name="from" data-provide="datepicker" required>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="End Date" id="rep_to_date" name="to" data-provide="datepicker" required>

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label for="code">Code</label>

                                                <input type="text" name="code" id="rep_code" class="form-control" required>

                                            </div>

                                            <div class="form-group">

                                                <label for="supersedes_date">Supersedes Date</label>

                                                <input type="text" name="supersedes_date" id="supersedes_date" class="form-control" required>

                                            </div>

                                            <div class="form-group">

                                                <label for="version">Version</label>

                                                <input type="text" name="version" id="rep_version" class="form-control" required>

                                            </div>

                                        </div>

                                    </div>







                                    <button type="submit" class="btn btn-success btn-block waves-effect waves-light">Change</button>

                                </form>



                                <p class="feedback-msg m-t-40 text-center"></p>



                            </div> <!-- end search-->

                        </div> <!-- end p-20 -->

                    </div>

                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'equipment'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Dashboard

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row">

                    <div class="col-md-12">

                        <a href="#" class="btn btn-success btn-rounded btn-md waves-effect waves-light m-b-30" data-toggle="modal" data-target="#add_equipment"><i class="md md-add"></i> Add New Equipment</a>

                    </div>

                </div>



                <div class="row">

                    <div class="col-lg-12">

                        <div class="text-right">

                            <ul class="pagination pagination-split m-t-0">



                                <li v-for="page in computed_equipments_tot_pages">

                                    <a href="#" @click="setEquipmentPage(page,$event)">{{ page }}</a>

                                </li>



                            </ul>

                        </div>



                        <div class="card-box">



                            <div class="table-responsive">

                                <table class="table table-striped mails m-0 table ">

                                    <thead>

                                        <tr>

                                            <th colspan="2">List of Equipments</th>

                                            <th>Action</th>

                                            <th>Repair Cost</th>

                                        </tr>

                                    </thead>



                                    <tbody>



                                        <tr v-for="(equipment,eqIndx) in all_equipments">

                                            <td>

                                                <div class="eq-details">

                                                    <div class="eq-img" >

                                                        <img v-if="equipment.image == ''" src="assets/images/dust.png" alt="">

                                                        <img v-else :src="'uploads/equipments/'+equipment.id +'/'+ equipment.image" alt="">



                                                    </div>

                                                    <div class="eq-name">

                                                        <h5>Equipment Name : {{ equipment.name }}</h5>

                                                        <h6>Total Requests : {{ equipment.request_number }}</h6>

                                                        <h6>Serial No: {{ equipment.serial_number }}</h6>

                                                        <h6>Model No : {{ equipment.model_number }}</h6>

                                                        <h6>Make : {{ equipment.make }}</h6>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>Asset# {{ equipment.asset }}</td>

                                            <td>

                                                <a href="#" class="table-action-btn h3 edit-equipment" :id="eqIndx">

                                                    <i class="mdi mdi-pencil-box-outline text-success" :id="eqIndx"></i>

                                                </a>

                                                <a href="#" class="table-action-btn h3 delete-equipment" data-toggle="modal" data-target="#delete_equipment" :id="eqIndx">

                                                    <i class="mdi mdi-close-box-outline text-danger" :id="eqIndx"></i>

                                                </a>

                                            </td>

                                            <td v-if="calculateRepairCost(equipment.id) == '0'"> ${{ equipment.repair_cost }}</td>
                                            <td v-else> ${{ calculateRepairCost(equipment.id) }}</td>

                                        </tr>



                                    </tbody>

                                </table>

                            </div> <!-- end table responsive -->

                        </div> <!-- end card-box -->







                    </div> <!-- end col -->





                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'users'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Users

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->





                <div class="row">

                    <div class="col-lg-12">

                        <div class="text-right">

                            <ul class="pagination pagination-split m-t-0">



                                <li v-for="page in computed_users_tot_pages">

                                    <a href="#" @click="setUserPage(page,$event)">{{ page }}</a>

                                </li>



                            </ul>

                        </div>

                        <div class="card-box">

                            <div class="row">

                                <div class="col-sm-8">

                                    <form role="form" lpformnum="1" _lpchecked="1">

                                        <div class="form-group search-box">

                                            <input type="text" id="search-input" class="form-control product-search" placeholder="Search here..." v-model="user_searched">

                                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>

                                        </div>

                                    </form>

                                </div>

                                <div class="col-sm-4">

                                     <a href="#" class="btn btn-success btn-rounded btn-md waves-effect waves-light m-b-30" data-toggle="modal" data-target="#add_user"><i class="md md-add"></i> Add New User</a>

                                </div>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped mails m-0 table ">

                                    <thead>

                                        <tr>

                                            <th>User Name</th>

                                            <th>Email</th>

                                            <th>Account Type</th>

                                            <th>Status</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>



                                    <tbody>



                                        <tr v-for="(user,indx) in filteredUsers">

                                            <td>{{ user.username }}</td>

                                            <td>{{ user.email }}</td>

                                            <td>{{ user['groups'][0]['name'] }}</td>



                                            <td v-if="user.active == '1'">

                                                <div class="radio radio-success radio-inline">

                                                    <input type="radio" class="user_active status-radio" :id="user.id" :name="user.id" checked="checked">

                                                    <label for="inlineRadio1"> Active </label>

                                                </div>

                                                <div class="radio radio-danger radio-inline">

                                                    <input type="radio" class="user_inactive status-radio" :id="user.id" :name="user.id">

                                                    <label for="inlineRadio2"> Deactive </label>

                                                </div>

                                            </td>



                                            <td v-else>

                                                <div class="radio radio-success radio-inline">

                                                    <input type="radio" class="user_active status-radio" :id="user.id" :name="user.id" >

                                                    <label for="inlineRadio1"> Active </label>

                                                </div>

                                                <div class="radio radio-danger radio-inline">

                                                    <input type="radio" class="user_inactive status-radio" :id="user.id" :name="user.id" checked="checked">

                                                    <label for="inlineRadio2"> Deactive </label>

                                                </div>

                                            </td>



                                            <td>

                                                <a href="#" class="table-action-btn h3 edit-user" data-toggle="modal" data-target="#edit_user" :id="indx">

                                                    <i class="mdi mdi-pencil-box-outline text-success" :id="indx"></i>

                                                </a>

                                                <a href="#" class="table-action-btn h3 delete-user" data-toggle="modal" data-target="#delete_user" :id="indx">

                                                    <i class="mdi mdi-close-box-outline text-danger" :id="indx"></i>

                                                </a>

                                            </td>

                                        </tr>



                                    </tbody>

                                </table>

                            </div> <!-- end table responsive -->

                        </div> <!-- end card-box -->







                    </div> <!-- end col -->





                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'new_order'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    New Work Order

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row">

                    <form method="post" id="wo_form">

                        <div class="col-md-8 col-md-offset-2">

                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="">Equipment No</label>

                                        <input type="text" class="form-control" id="equipment_num_autocomplete" name="equipment_num" required>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="">Location</label>

                                        <input type="text" class="form-control" id="wo_location" name="location" required>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="">Work Order Issued To</label>

                                        <select name="option" id="wo_option" class="form-control" required>

                                            <option v-for="user in all_users" :value="user.username" >{{ user.username }}</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="">Due By</label>

                                        <input type="text" class="form-control datepicker-autoclose"
                                        data-provide="datepicker" data-date-start-date="+0d" name="due_date" id="wo_due_date" required>

                                    </div>

                                </div>

                            </div>



                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="">Description</label>

                                        <textarea name="description" id="wo_description" rows="5" class="form-control" required></textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <form action="" method="post" id="wo_file_form">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="wo_file">Attachments</label>

                                            <input type="file" id="wo_file" name="wo_file">

                                        </div>

                                    </div>

                                </form>

                                <div class="col-md-8 text-right">

                                    <button type="submit" class="btn btn-success waves-effect" id="wo_submit_btn">

                                        Submit Request

                                    </button>

                                    <button type="reset" class="btn btn-default waves-effect m-l-5" id="wo_clear_btn">

                                        Clear

                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>



</div>



<div v-if="dash_menu == 'settings'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Settings

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->



                <div class="row">

                    <div class="col-md-4 col-md-offset-4">

                        <div class="p-20 p-t-0">

                            <div class="">

                                <h4 class="text-uppercase">New Password</h4>

                                <div class="border m-b-20"></div>



                                <form role="form" id="password_reset_form">

                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="New Password" id="password">

                                    </div>

                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="Confirm New Password" id="confirm_password">

                                    </div>



                                    <button type="submit" class="btn btn-success btn-block waves-effect waves-light">Save Password</button>

                                </form>

                                <br>

                                <div id="click_response_status">



                                </div>



                            </div> <!-- end search-->

                        </div> <!-- end p-20 -->

                    </div>

                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'wo_report'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Reports </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Report

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->





                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-default">

                            <div class="panel-body">

                                <div class="clearfix">

                                    <div class="pull-left">

                                        <h3>Maintenance Work Order</h3>

                                    </div>

                                </div>



                                <div class="m-h-50"></div>



                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="table-responsive">

                                            <table class="table m-t-30 table-bordered table-report">

                                                <tr>

                                                    <td rowspan="2" width="25%">

                                                        <img src="assets/images/logo.png" alt="" class="img-responsive">

                                                    </td>

                                                    <td width="25%">

                                                        <h5>

                                                            Maintenance – Sanitation <br>

                                                            Work Order

                                                        </h5>

                                                    </td>

                                                    <td width="25%">Issued Date <br><b>{{ selected_order.WO_issue_date }}</b></td>

                                                    <td width="25%">Page <br><b>1 of 1</b></td>

                                                </tr>

                                                <tr>

                                                    <td>

                                                        Code <br><b>{{ selected_order.code }}</b>

                                                    </td>

                                                    <td>

                                                        Supersedes Date <br><b>New Document</b>

                                                    </td>

                                                    <td>Version <br><b>{{ selected_order.version }}</b></td>

                                                </tr>

                                            </table>

                                        </div>



                                        <div class="table-responsive">

                                            <table class="table m-t-30 table-bordered table-report">

                                                <thead>

                                                    <tr>

                                                        <th colspan="2" width="15%">WORK ORDER ISSUE DATE</th>

                                                        <th width="20%">WORK ORDER #</th>

                                                        <th width="20%">EQUIPMENT No. </th>

                                                        <th width="20%">LOCATION</th>

                                                        <th width="25%">WORK ORDER ISSUED TO</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    <tr>

                                                        <td colspan="2">{{ selected_order.WO_issue_date }}</td>

                                                        <td>{{ selected_order.WO_issue_date }}</td>

                                                        <td>{{ selected_order.eqp_no }}</td>

                                                        <td>{{ selected_order.location }}</td>

                                                        <td>{{ selected_order.WO_issue_to }}</td>

                                                    </tr>

                                                    <tr>

                                                        <th colspan="6">DESCRIPTION OF DEFICIENCY</th>

                                                    </tr>

                                                    <tr>

                                                        <td colspan="6" height="100px">{{ selected_order.WO_description }}</td>

                                                    </tr>

                                                    <tr>

                                                        <td>

                                                            <input type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                                            <input type="checkbox" v-else>

                                                        </td>

                                                        <td>

                                                            QA HOLD (CHECK IF YES)

                                                        </td>

                                                        <td>

                                                            <input type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                                            <input type="checkbox" v-else>

                                                        </td>

                                                        <td>

                                                            QC INSPECTION REQUIRED?  (CHECK IF YES)

                                                        </td>

                                                        <td>

                                                            <input type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                                            <input type="checkbox" v-else>

                                                        </td>

                                                        <td>

                                                            EMPLOYEE SAFETY HAZARD (CHECK IF YES)

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th colspan="3" width="50%">

                                                            WORK ORDER ISSUED BY

                                                        </th>

                                                        <th colspan="3">WORK ORDER RECEIVED BY</th>

                                                    </tr>

                                                    <tr>



                                                        <td colspan="3" width="50%">{{ selected_order.WO_issued_by }}</td>

                                                        <td colspan="3">{{ selected_order.WO_received_by }}</td>

                                                    </tr>

                                                    <tr>

                                                        <th colspan="6">CORRECTIVE ACTION DESCRIPTION</th>

                                                    </tr>

                                                    <tr>

                                                        <td colspan="6">{{ selected_order.WO_corrective_action_description }}</td>

                                                    </tr>

                                                    <tr>

                                                        <th colspan="3" width="50%">

                                                            DEFICIENCY CORRECTED BY

                                                        </th>

                                                        <th colspan="3">CORRECTIVE ACTION DATE</th>

                                                    </tr>

                                                    <tr>

                                                        <td colspan="3"><canvas id="corrected_sign" class="signature-padc" width=110 height=50> <p>Sign Here</p> </canvas></td>

                                                        <!-- <td colspan="3" width="50%">{{ selected_order.WO_corrected_by }}</td> -->

                                                        <td colspan="3">{{ selected_order.WO_corrected_date }}</td>

                                                    </tr>

                                                    <tr>

                                                        <th colspan="6">SANITATION DEPARTMENT RELEASE INFORMATION</th>

                                                    </tr>

                                                    <tr>

                                                        <td>

                                                            <input type="checkbox" v-if="selected_order.WO_equipment_washed == '1'" checked>

                                                            <input type="checkbox" v-else>

                                                        </td>

                                                        <td>

                                                            EQUIPMENT WASH &amp; SANITIZED (CHECK IF YES)

                                                        </td>

                                                        <td>

                                                            <input type="checkbox" v-if="selected_order.WO_formed == '1'" checked>

                                                            <input type="checkbox" v-else>

                                                        </td>

                                                        <td>

                                                            QA INFORMED FOR EQUIPMENT INSPECTION &amp; APPROVAL (CHECK IF YES)

                                                        </td>

                                                        <td>

                                                            <input type="checkbox" v-if="selected_order.QA_QC_inspection_approval == '1'" checked>

                                                            <input type="checkbox" v-else>

                                                        </td>

                                                        <td>

                                                            QA/QC  INSPECTION AND APPROVAL

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th colspan="3" width="50%">

                                                            Q.C INSPECTION AND APPROVED BY

                                                        </th>

                                                        <th colspan="3">DATE</th>

                                                    </tr>

                                                    <tr>

                                                       <td colspan="3"> <canvas id="verified_sign" class="signature-padc" width=110 height=50> <p>Sign Here</p> </canvas></td>

                                                        <!-- <td colspan="3" width="50%">{{ selected_order.WO_verified_by }}</td> -->

                                                        <td colspan="3">{{ selected_order.WO_verified_date }}</td>

                                                    </tr>

                                                    <tr>

                                                        <th colspan="6">COMMENTS/GENERAL NOTES</th>

                                                    </tr>

                                                    <tr>

                                                        <td colspan="6">{{ selected_order.WO_general_notes }}</td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 col-sm-6 col-xs-6">

                                        <div class="clearfix m-t-40">

                                            <h5 class="small text-inverse font-600">

                                            Verified By : <span>NAME GOES HERE</span>

                                            </h5>

                                        </div>

                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-6">

                                        <div class="clearfix m-t-40">

                                            <h5 class="small text-inverse font-600">

                                            Verified Date : <span>DATE GOES HERE</span>

                                            </h5>

                                        </div>

                                    </div>

                                </div>

                                <hr>

                                <div class="hidden-print">

                                    <div class="pull-right">

                                        <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i> Print</a>

                                        <a href="reports.html" class="btn btn-primary waves-effect waves-light" @click="setDashMenuItem('reports',$event)">Cancel</a>

                                    </div>

                                </div>

                            </div>

                        </div>



                    </div>



                </div>

                <!-- end row -->







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 © Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'edit_equipment'">

    <div class="content-page">

        <!-- Start content -->

        <div class="content">

            <div class="container">





                <div class="row">

                    <div class="col-xs-12">

                        <div class="page-title-box">

                            <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                            <ol class="breadcrumb p-0 m-0">

                                <li>

                                    <a href="#">Home</a>

                                </li>

                                <li class="active">

                                    Dashboard

                                </li>

                            </ol>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

                <!-- end row -->

                <div class="row">

                    <div class="col-md-3 col-md-offset-1">

                        <div class="eq-img-box">

                            <!-- <i class="fa fa-image"></i> -->

                            <!-- <img src="assets/images/dust.png" alt=""> -->

                            <img v-if="selected_equipment.image == ''" src="assets/images/dust.png" alt="">

                            <img v-else :src="'uploads/equipments/'+selected_equipment.id +'/'+ selected_equipment.image" alt="">

                        </div>

                        <div class="form-group">

                            <input name="file" type="file"  id="change_equipment_image" >

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" id="equipment_name" placeholder="Equipment Name" v-model="selected_equipment.name" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" id="equipment_serialNum" placeholder="Serial No" v-model="selected_equipment.serial_number" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" id="equipment_modelNum" placeholder="Model No" v-model="selected_equipment.model_number" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" id="equipment_make" placeholder="Make" v-model="selected_equipment.make" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" id="equipment_asset" placeholder="Asset #" v-model="selected_equipment.asset" required>

                        </div>

                    </div>

                </div>



                <div class="row hidden" id="missing_values">



                </div>



                <div class="row m60">

                    <form action="" class="form-horizontal" id="purchase_order_form">

                        <div class="col-md-5">

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Part No</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" id="equipment_partNum" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Supplier</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" id="equipment_supplier" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Link</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" id="equipment_link" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Unit Price</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" id="equipment_unitPrice" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Quantity</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" id="equipment_qty" placeholder="" required>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-5">

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Invoice / PO</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" id="equipment_invNum" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Shipping Cost</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" id="equipment_shippingCost" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group text-right">

                                <div class="col-sm-12">

                                    <button type="submit" class="btn btn-success btn-sm waves-effect" id="save_equipment_details_btn">

                                        Submit

                                    </button>

                                    <button type="reset" class="btn btn-default btn-sm waves-effect m-l-5">

                                        Clear

                                    </button>

                                </div>

                            </div>



                        </div>

                    </form>

                </div>



                <div class="row">

                    <div class="col-lg-12">

                        <div class="card-box">



                            <div class="table-responsive">

                                <table class="table table-striped mails m-0 table ">

                                    <thead>

                                        <tr>

                                            <th>Part No</th>

                                            <th>Supplier</th>

                                            <th>Link</th>

                                            <th>Unit Price</th>

                                            <th>Quantity</th>

                                            <th>Invoice / PO</th>

                                            <th>Shipping Cost</th>

                                            <th>Time / Date</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>



                                    <tbody>

                                        <tr v-for="(order,indx) in equipment_pur_orders.slice().reverse()">

                                            <td>{{ order.part_number }}</td>

                                            <td>{{ order.supplier }}</td>

                                            <td>{{ order.link }}</td>

                                            <td>${{ order.unit_price }}</td>

                                            <td>{{ order.quantity }}</td>

                                            <td>{{ order.invoice_number }}</td>

                                            <td>${{ order.shipping_cost }}</td>

                                            <td>{{ order.created_on }}</td>

                                            <td>

                                            	<a href="#" class="table-action-btn h3" data-toggle="modal" data-target="#edit_purchase_order" :id="indx">

                                                    <i class="mdi mdi-pencil-box-outline text-success edit-pur-order" :id="indx"></i>

                                                </a>

                                                <a href="#" class="table-action-btn h3 delete-pur-order" data-toggle="modal" data-target="#delete_pur_order" :id="order.id">

                                                    <i class="mdi mdi-close-box-outline text-danger" :id="order.id"></i>

                                                </a>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                        </tr>



                                    </tbody>

                                </table>

                            </div> <!-- end table responsive -->

                        </div> <!-- end card-box -->



                        <div class="text-right">

                            <ul class="pagination pagination-split m-t-0">

                                <!-- <li class="disabled">

                                    <a href="#"><i class="fa fa-angle-left"></i></a>

                                </li> -->

                                <li>

                                    <a href="#">1</a>

                                </li>

                                <!-- <li class="active">

                                    <a href="#">2</a>

                                </li>

                                <li>

                                    <a href="#">3</a>

                                </li>

                                <li>

                                    <a href="#">4</a>

                                </li>

                                <li>

                                    <a href="#">5</a>

                                </li>

                                <li>

                                    <a href="#"><i class="fa fa-angle-right"></i></a>

                                </li> -->

                            </ul>

                        </div>



                    </div> <!-- end col -->





                </div>







            </div> <!-- container -->



        </div> <!-- content -->



        <footer class="footer text-right">

            2017 &copy; Buy Fresh Produce Inc.

        </footer>



    </div>

</div>



<div v-if="dash_menu == 'edit_work_order'">



    <!-- issued user section -->

    <div v-if="selected_order.WO_issue_to == '<?php echo $this->ion_auth->user()->row()->username; ?>' && selected_order.status == 'new' && <?php echo $this->ion_auth->get_users_groups()->row()->id ?> != '3' && selected_order.WO_issue_to_qa == '1'">

            <div id='1'></div>

            <div class="content-page">

                <!-- Start content -->

                <div class="content">

                    <div class="container">





                        <div class="row">

                            <div class="col-xs-12">

                                <div class="page-title-box">

                                    <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                    <ol class="breadcrumb p-0 m-0">

                                        <li>

                                            <a href="#">Home</a>

                                        </li>

                                        <li class="active">

                                            New Work Order

                                        </li>

                                    </ol>

                                    <div class="clearfix"></div>

                                </div>

                            </div>

                        </div>

                        <!-- end row -->



                        <div class="row">

                            <form method="post" id="edit_wo_form">

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label for="">Work Order Issue Date</label>

                                        <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Work Order No</label>

                                        <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Attachments</label>

                                        <div class="attachment-scroll">
                                            <div v-for="image in work_order_images" >

                                                <div v-if="explodeFileName(image.image) == 'pdf'">

                                                    <a :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" src="assets/images/file.png" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div v-else-if="explodeFileName(image.image) == 'mp4' || explodeFileName(image.image) == 'avi'">

                                                	<a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" src="assets/images/mp4.png" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div v-else>

                                                    <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div><hr></div>


                                            </div>
                                        </div>

                                    </div>

                                    <!-- <div class="form-group">

                                        <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                    </div> -->

                                </div>

                                <div class="col-md-7">

                                    <div class="row">

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Equipment No</label>

                                                <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Location</label>

                                                <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Work Order Issued To</label>

                                                <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to" readonly style="pointer-events:none;">

                                                    <option value="Maintanance">Maintanance</option>

                                                    <option value="Quality Check">Quality Check</option>

                                                    <option value="Returns">Returns</option>

                                                    <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Due By</label>

                                                <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label for="">Description</label>

                                                <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                            </div>

                                            <div class="form-group">

                                                <label for="">Corrective Action Description</label>

                                                <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description" readonly></textarea>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="">QC Inspection and Approved By</label>

                                                        <input type="text" name="approved_by" class="form-control" id="Text" readonly>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">

                                                        <label for="">Date</label>

                                                        <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" v-if="selected_order.WO_issue_date != null" :value="selected_order.WO_issue_date" readonly>

                                                        <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" name="date" v-else>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label for="">Comments / General Notes</label>

                                                <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes" readonly></textarea>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="">Verified By</label>

                                                        <canvas id="" class="signature-padc" width=300 height=150> <p>Sign Here</p> </canvas>

                                                        <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                        <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">

                                                        <label for="">Verified Date</label>

                                                        <input type="text" class="form-control datepicker-autoclose" id="Text" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                        <input type="text" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" v-else id="Text" value="<?php echo date("Y-m-d"); ?>" readonly>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group" >

                                        <label for="">Assigned To</label>

                                        <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to" style="pointer-events:none;" disabled>

                                            <option v-for="user in all_users" :value="user.username" >{{ user.username }}</option>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                            <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                            <input id="qa_hold" type="checkbox" v-else>

                                            <label for="checkbox1">

                                                QA Hold

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                            <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                            <input id="qa_inspection" type="checkbox" v-else>

                                            <label for="checkbox2">

                                                QA Inspection Required

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                            <input id="emply_safety_haz" type="checkbox" v-else>

                                            <label for="checkbox3">

                                                Employee Safety Hazard

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Corrected By</label>

                                        <div disabled>

                                            <canvas id="corrected_sign" class="signature-padc" width=300 height=150></canvas>

                                        </div>

                                        <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect">Save Sign.</button>

                                        <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect">Clear Sign.</button>

                                    </div>



                                    <div class="form-group">

                                        <label for="">Corrective Action Date</label>

                                        <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date" >

                                        <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d">

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox4" name="eq_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                            <input id="checkbox4" name="eq_wash" v-else type="checkbox">

                                            <label for="checkbox4">

                                                Equipment Wash &amp; Sanitized

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox5" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked>

                                            <input id="checkbox5" name="qa_formed" v-else type="checkbox">

                                            <label for="checkbox5">

                                                QA Formed for Equipment Inspection &amp; Approval

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox6" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked>

                                            <input id="checkbox6" name="qa_qc_inspec" v-else type="checkbox">

                                            <label for="checkbox6">

                                                QA/QC Inspection &amp; Approval

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="exampleInputFile">Attachments</label>

                                        <input type="file" id="edit_image_file">

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-sm-offset-8">

                                        <button type="submit" class="btn btn-success waves-effect">

                                            Save

                                        </button>

                                        <button type="reset" class="btn btn-default waves-effect m-l-5">

                                            Clear

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>







                    </div> <!-- container -->



                </div> <!-- content -->



                <footer class="footer text-right">

                    2017 &copy; Buy Fresh Produce Inc.

                </footer>

            </div>

    </div>



    <div v-else-if="selected_order.WO_issue_to == '<?php echo $this->ion_auth->user()->row()->username; ?>' && selected_order.status == 'new' && <?php echo $this->ion_auth->get_users_groups()->row()->id ?> == '3' && selected_order.WO_issue_to_qa == '1'">

            <div id='2'></div>

            <div class="content-page">

                <!-- Start content -->

                <div class="content">

                    <div class="container">





                        <div class="row">

                            <div class="col-xs-12">

                                <div class="page-title-box">

                                    <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                    <ol class="breadcrumb p-0 m-0">

                                        <li>

                                            <a href="#">Home</a>

                                        </li>

                                        <li class="active">

                                            New Work Order

                                        </li>

                                    </ol>

                                    <div class="clearfix"></div>

                                </div>

                            </div>

                        </div>

                        <!-- end row -->



                        <div class="row">

                            <form method="post" id="edit_wo_form">

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label for="">Work Order Issue Date</label>

                                        <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Work Order No</label>

                                        <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Attachments</label>

                                        <div class="attachment-scroll">

                                            <div v-for="image in work_order_images">

                                                <div v-if="explodeFileName(image.image) == 'pdf'">

                                                    <a  :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image">

                                                        <img class="upld_img" src="assets/images/file.png" style="width:80px; height:auto;">

                                                    </a>

                                                </div>

                                                <div v-else-if="explodeFileName(image.image) == 'mp4' || explodeFileName(image.image) == 'avi'">

                                                	<a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" src="assets/images/mp4.png" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div v-else>

                                                    <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div><hr></div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- <div class="form-group">

                                        <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                    </div> -->

                                </div>

                                <div class="col-md-7">

                                    <div class="row">

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Equipment No</label>

                                                <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Location</label>

                                                <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Work Order Issued To</label>

                                                <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to" readonly style="pointer-events:none;">

                                                    <option value="Maintanance">Maintanance</option>

                                                    <option value="Quality Check">Quality Check</option>

                                                    <option value="Returns">Returns</option>

                                                    <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Due By</label>

                                                <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label for="">Description</label>

                                                <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                            </div>

                                            <div class="form-group">

                                                <label for="">Corrective Action Description</label>

                                                <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description"></textarea>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="">QC Inspection and Approved By</label>

                                                        <input type="text" name="approved_by" class="form-control" id="Text" readonly>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">

                                                        <label for="">Date</label>

                                                        <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" v-if="selected_order.WO_issue_date != null" :value="selected_order.WO_issue_date" readonly>

                                                        <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" name="date" v-else>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label for="">Comments / General Notes</label>

                                                <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes" readonly></textarea>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="">Verified By</label>

                                                        <canvas id="" class="signature-padc" width=300 height=150> <p>Sign Here</p> </canvas>

                                                        <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                        <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">

                                                        <label for="">Verified Date</label>

                                                        <input type="text" class="form-control datepicker-autoclose" id="Text" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                        <input type="text" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d"  v-else id="Text" value="<?php echo date("Y-m-d"); ?>" readonly>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group" >

                                        <label for="">Assigned To</label>

                                        <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to" style="pointer-events:none;" disabled>

                                            <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                            <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                            <input id="qa_hold" type="checkbox" v-else>

                                            <label for="checkbox1">

                                                QA Hold

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                            <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                            <input id="qa_inspection" type="checkbox" v-else>

                                            <label for="checkbox2">

                                                QA Inspection Required

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                            <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                            <input id="emply_safety_haz" type="checkbox" v-else>

                                            <label for="checkbox3">

                                                Employee Safety Hazard

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Corrected By</label>

                                        <div disabled>

                                            <canvas id="corrected_sign" class="signature-padc" width=300 height=150></canvas>

                                        </div>

                                        <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect">Save Sign.</button>

                                        <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect">Clear Sign.</button>

                                    </div>



                                    <div class="form-group">

                                        <label for="">Corrective Action Date</label>

                                        <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date">

                                        <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d">

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox4" name="eq_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                            <input id="checkbox4" name="eq_wash" v-else type="checkbox">

                                            <label for="checkbox4">

                                                Equipment Wash &amp; Sanitized

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox5" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked>

                                            <input id="checkbox5" name="qa_formed" v-else type="checkbox">

                                            <label for="checkbox5">

                                                QA Formed for Equipment Inspection &amp; Approval

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox6" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked>

                                            <input id="checkbox6" name="qa_qc_inspec" v-else type="checkbox">

                                            <label for="checkbox6">

                                                QA/QC Inspection &amp; Approval

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="exampleInputFile">Attachments</label>

                                        <input type="file" id="edit_image_file">

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-sm-offset-8">

                                        <button type="submit" class="btn btn-success waves-effect">

                                            Save

                                        </button>

                                        <button type="reset" class="btn btn-default waves-effect m-l-5">

                                            Clear

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>







                    </div> <!-- container -->



                </div> <!-- content -->



                <footer class="footer text-right">

                    2017 &copy; Buy Fresh Produce Inc.

                </footer>

            </div>

    </div>



    <div v-else-if="selected_order.WO_issue_to == '<?php echo $this->ion_auth->user()->row()->username; ?>' && selected_order.status == 'new' && <?php echo $this->ion_auth->get_users_groups()->row()->id ?> != '3' && selected_order.WO_issue_to_qa != '1'">

            <div id='3'></div>

            <div class="content-page">

                <!-- Start content -->

                <div class="content">

                    <div class="container">





                        <div class="row">

                            <div class="col-xs-12">

                                <div class="page-title-box">

                                    <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                    <ol class="breadcrumb p-0 m-0">

                                        <li>

                                            <a href="#">Home</a>

                                        </li>

                                        <li class="active">

                                            New Work Order

                                        </li>

                                    </ol>

                                    <div class="clearfix"></div>

                                </div>

                            </div>

                        </div>

                        <!-- end row -->



                        <div class="row">

                            <form method="post" id="edit_wo_form">

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label for="">Work Order Issue Date</label>

                                        <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Work Order No</label>

                                        <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Attachments</label>

                                        <div class="attachment-scroll">

                                            <div v-for="image in work_order_images" >

                                                <div v-if="explodeFileName(image.image) == 'pdf'">

                                                    <a :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image">

                                                        <img class="upld_img" src="assets/images/file.png" style="width:80px; height:auto;">

                                                    </a>

                                                </div>

                                                <div v-else-if="explodeFileName(image.image) == 'mp4' || explodeFileName(image.image) == 'avi'">

                                                	<a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" src="assets/images/mp4.png" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div v-else>

                                                    <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div><hr></div>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- <div class="form-group">

                                        <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                    </div> -->

                                </div>

                                <div class="col-md-7">

                                    <div class="row">

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Equipment No</label>

                                                <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Location</label>

                                                <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Work Order Issued To</label>

                                                <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to" readonly style="pointer-events:none;">

                                                    <option value="Maintanance">Maintanance</option>

                                                    <option value="Quality Check">Quality Check</option>

                                                    <option value="Returns">Returns</option>

                                                    <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Due By</label>

                                                <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label for="">Description</label>

                                                <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                            </div>

                                            <div class="form-group">

                                                <label for="">Corrective Action Description</label>

                                                <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description"></textarea>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="">QC Inspection and Approved By</label>

                                                        <input type="text" name="approved_by" class="form-control" id="Text" readonly>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">

                                                        <label for="">Date</label>

                                                        <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" v-if="selected_order.WO_issue_date != null" :value="selected_order.WO_issue_date" readonly>

                                                        <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" name="date" v-else>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label for="">Comments / General Notes</label>

                                                <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes" readonly></textarea>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="">Verified By</label>

                                                        <canvas id="" class="signature-padc" width=300 height=150> <p>Sign Here</p> </canvas>

                                                        <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                        <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">

                                                        <label for="">Verified Date</label>

                                                        <input type="text" class="form-control datepicker-autoclose" id="Text" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                        <input type="text" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" v-else id="Text" value="<?php echo date("Y-m-d"); ?>" readonly>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group" >

                                        <label for="">Assigned To</label>

                                        <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to">

                                            <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                            <input id="qa_hold" type="checkbox" v-else>

                                            <label for="checkbox1">

                                                QA Hold

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                            <input id="qa_inspection" type="checkbox" v-else>

                                            <label for="checkbox2">

                                                QA Inspection Required

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                            <input id="emply_safety_haz" type="checkbox" v-else>

                                            <label for="checkbox3">

                                                Employee Safety Hazard

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Corrected By</label>

                                        <div disabled>

                                            <canvas id="corrected_sign" class="signature-padc" width=300 height=150></canvas>

                                        </div>

                                        <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect">Save Sign.</button>

                                        <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect">Clear Sign.</button>

                                    </div>



                                    <div class="form-group">

                                        <label for="">Corrective Action Date</label>

                                        <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date">

                                        <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d">

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox4" name="eq_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                            <input id="checkbox4" name="eq_wash" v-else type="checkbox">

                                            <label for="checkbox4">

                                                Equipment Wash &amp; Sanitized

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox5" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked>

                                            <input id="checkbox5" name="qa_formed" v-else type="checkbox">

                                            <label for="checkbox5">

                                                QA Formed for Equipment Inspection &amp; Approval

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="checkbox6" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked>

                                            <input id="checkbox6" name="qa_qc_inspec" v-else type="checkbox">

                                            <label for="checkbox6">

                                                QA/QC Inspection &amp; Approval

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="exampleInputFile">Attachments</label>

                                        <input type="file" id="edit_image_file">

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-sm-offset-8">

                                        <button type="submit" class="btn btn-success waves-effect">

                                            Save

                                        </button>

                                        <button type="reset" class="btn btn-default waves-effect m-l-5">

                                            Clear

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>







                    </div> <!-- container -->



                </div> <!-- content -->



                <footer class="footer text-right">

                    2017 &copy; Buy Fresh Produce Inc.

                </footer>

            </div>

    </div>



    <!-- assigned user section -->

    <div v-else-if="selected_order.WO_assigned_to == '<?php echo $this->ion_auth->user()->row()->username; ?>' && selected_order.status == 'pending'">

            <div class="content-page">

                <!-- Start content -->

                <div class="content">

                    <div class="container">





                        <div class="row">

                            <div class="col-xs-12">

                                <div class="page-title-box">

                                    <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                    <ol class="breadcrumb p-0 m-0">

                                        <li>

                                            <a href="#">Home</a>

                                        </li>

                                        <li class="active">

                                            New Work Order

                                        </li>

                                    </ol>

                                    <div class="clearfix"></div>

                                </div>

                            </div>

                        </div>

                        <!-- end row -->



                        <div class="row">

                            <form method="post" id="edit_wo_form">

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label for="">Work Order Issue Date</label>

                                        <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Work Order No</label>

                                        <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Attachments</label>

                                        <div class="attachment-scroll">

                                            <div v-for="image in work_order_images">

                                                <div v-if="explodeFileName(image.image) == 'pdf'">

                                                    <a :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image">

                                                        <img class="upld_img" src="assets/images/file.png" style="width:80px; height:auto;">

                                                    </a>

                                                </div>

                                                <div v-else-if="explodeFileName(image.image) == 'mp4' || explodeFileName(image.image) == 'avi'">

                                                	<a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" src="assets/images/mp4.png" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div v-else>

                                                    <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                                </div>

                                                <div><hr></div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- <div class="form-group">

                                        <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                    </div> -->

                                </div>

                                <div class="col-md-7">

                                    <div class="row">

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Equipment No</label>

                                                <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Location</label>

                                                <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Work Order Issued To</label>

                                                <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to" readonly style="pointer-events:none;">

                                                    <option value="Maintanance">Maintanance</option>

                                                    <option value="Quality Check">Quality Check</option>

                                                    <option value="Returns">Returns</option>

                                                    <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="">Due By</label>

                                                <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label for="">Description</label>

                                                <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                            </div>

                                            <div class="form-group">

                                                <label for="">Corrective Action Description</label>

                                                <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description" readonly></textarea>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="">QC Inspection and Approved By</label>

                                                        <div disabled>

                                                            <canvas id="qaqc_sign" class="signature-padc" width=300 height=150></canvas>

                                                        </div>

                                                        <button type="button" id="qaqc_sign_save" class="btn btn-sm btn-purple waves-effect">Save Sign.</button>

                                                        <button type="button" id="qaqc_sign_clear" class="btn btn-sm btn-default waves-effect">Clear Sign.</button>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">

                                                        <label for="">Date</label>

                                                        <input type="text" name="qc_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="qc_date" v-if="selected_order.QC_date != null" :value="selected_order.QC_date">

                                                        <input v-else type="text" name="qc_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="qc_date" name="date" value="<?php echo date("Y-m-d"); ?>">

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label for="">Comments / General Notes</label>

                                                <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes"></textarea>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="">Verified By</label>

                                                        <canvas id="" class="signature-padc" width=300 height=150> <p>Sign Here</p> </canvas>

                                                        <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                        <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                    </div>

                                                </div>

                                                <div class="col-md-3">

                                                    <div class="form-group">

                                                        <label for="">Verified Date</label>

                                                        <input type="text" class="form-control datepicker-autoclose" id="Text" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                        <input type="text" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" v-else id="Text" value="<?php echo date("Y-m-d"); ?>" readonly>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group" >

                                        <label for="">Assigned To</label>

                                        <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to" style="pointer-events:none;" disabled>

                                            <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                            <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                            <input id="qa_hold" type="checkbox" v-else>

                                            <label for="checkbox1">

                                                QA Hold

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                            <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                            <input id="qa_inspection" type="checkbox" v-else>

                                            <label for="checkbox2">

                                                QA Inspection Required

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                            <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                            <input id="emply_safety_haz" type="checkbox" v-else>

                                            <label for="checkbox3">

                                                Employee Safety Hazard

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="">Corrected By</label>

                                        <div disabled>

                                            <canvas id="corrected_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                        </div>

                                        <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                        <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                    </div>



                                    <div class="form-group">

                                        <label for="">Corrective Action Date</label>

                                        <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date" readonly>

                                        <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d" value="<?php echo date("Y-m-d"); ?>" readonly>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="qc_wash_inspec" name="qa_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                            <input id="qc_wash_inspec" name="qa_wash" v-else type="checkbox">

                                            <label for="checkbox4">

                                                Equipment Wash &amp; Sanitized

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="qc_equipment_inspec" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked>

                                            <input id="qc_equipment_inspec" name="qa_formed" v-else type="checkbox">

                                            <label for="checkbox5">

                                                QA Formed for Equipment Inspection &amp; Approval

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="checkbox checkbox-primary">

                                            <input id="qa_qc_inspec" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked>

                                            <input id="qa_qc_inspec" name="qa_qc_inspec" v-else type="checkbox">

                                            <label for="checkbox6">

                                                QA/QC Inspection &amp; Approval

                                            </label>

                                        </div>

                                    </div>

                                    <div class="form-group" style="pointer-events:none;">

                                        <div id="testing"></div>

                                        <label for="exampleInputFile">Attachments</label>

                                        <input type="file" id="edit_image_file">

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-sm-offset-8">

                                        <button type="submit" class="btn btn-success waves-effect">

                                            Save

                                        </button>

                                        <button type="reset" class="btn btn-default waves-effect m-l-5">

                                            Clear

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>







                    </div> <!-- container -->



                </div> <!-- content -->



                <footer class="footer text-right">

                    2017 &copy; Buy Fresh Produce Inc.

                </footer>

            </div>

    </div>



    <div v-else-if="selected_order.WO_issued_by == '<?php echo $this->ion_auth->user()->row()->username; ?>' && selected_order.status == 'approved'">

        <div id='final_step'></div>

        <div class="content-page">

            <!-- Start content -->

            <div class="content">

                <div class="container">





                    <div class="row">

                        <div class="col-xs-12">

                            <div class="page-title-box">

                                <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                <ol class="breadcrumb p-0 m-0">

                                    <li>

                                        <a href="#">Home</a>

                                    </li>

                                    <li class="active">

                                        New Work Order

                                    </li>

                                </ol>

                                <div class="clearfix"></div>

                            </div>

                        </div>

                    </div>

                    <!-- end row -->



                    <div class="row">

                        <form method="post" id="edit_wo_form">

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label for="">Work Order Issue Date</label>

                                    <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Work Order No</label>

                                    <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Attachments</label>

                                    <div class="attachment-scroll">

                                        <div v-for="image in work_order_images">

                                            <div v-if="explodeFileName(image.image) == 'pdf'">

                                                <a  :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image">

                                                    <img class="upld_img" src="assets/images/file.png" style="width:80px; height:auto;">

                                                </a>

                                            </div>

                                            <div v-else-if="explodeFileName(image.image) == 'mp4' || explodeFileName(image.image) == 'avi'">

                                                	<a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" src="assets/images/mp4.png" style="width:80px; height:auto;"></a>

                                                </div>

                                            <div v-else>

                                                <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                            </div>

                                            <div><hr></div>

                                        </div>
                                    </div>

                                </div>

                                <!-- <div class="form-group">

                                    <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                </div> -->

                            </div>

                            <div class="col-md-7">

                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Equipment No</label>

                                            <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Location</label>

                                            <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Work Order Issued To</label>

                                            <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to" readonly style="pointer-events:none;">

                                                <option value="Maintanance">Maintanance</option>

                                                <option value="Quality Check">Quality Check</option>

                                                <option value="Returns">Returns</option>

                                                <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Due By</label>

                                            <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="">Description</label>

                                            <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Corrective Action Description</label>

                                            <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description" readonly></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">QC Inspection and Approved By</label>

                                                    <div disabled>

                                                        <canvas id="qaqc_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                                    </div>

                                                    <button type="button" id="qaqc_sign_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="qaqc_sign_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Date</label>

                                                    <input type="text" name="qc_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="qc_date" v-if="selected_order.QC_date != null" :value="selected_order.QC_date">

                                                    <input v-else type="text" name="qc_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="qc_date" name="date" value="<?php echo date("Y-m-d"); ?>">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Comments / General Notes</label>

                                            <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes"></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">Verified By</label>

                                                    <canvas id="verified_sign" class="signature-padc" width=300 height=150> <p>Sign Here</p> </canvas>

                                                    <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect">Save Sign.</button>

                                                    <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect">Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Verified Date</label>

                                                    <input type="text" class="form-control datepicker-autoclose" id="verified_date" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                    <input type="text"  class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" v-else id="verified_date" value="<?php echo date("Y-m-d"); ?>">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group" >

                                    <label for="">Assigned To</label>

                                    <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to" style="pointer-events:none;" disabled>

                                        <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                        <input id="qa_hold" type="checkbox" v-else>

                                        <label for="checkbox1">

                                            QA Hold

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                        <input id="qa_inspection" type="checkbox" v-else>

                                        <label for="checkbox2">

                                            QA Inspection Required

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                        <input id="emply_safety_haz" type="checkbox" v-else>

                                        <label for="checkbox3">

                                            Employee Safety Hazard

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="">Corrected By</label>

                                    <div disabled>

                                        <canvas id="corrected_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                    </div>

                                    <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                    <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                </div>



                                <div class="form-group">

                                    <label for="">Corrective Action Date</label>

                                    <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date" readonly>

                                    <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d" value="<?php echo date("Y-m-d"); ?>" readonly>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary">

                                        <input id="qc_wash_inspec" name="qa_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                        <input id="qc_wash_inspec" name="qa_wash" v-else type="checkbox">

                                        <label for="checkbox4">

                                            Equipment Wash &amp; Sanitized

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary">

                                        <input id="qc_equipment_inspec" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked>

                                        <input id="qc_equipment_inspec" name="qa_formed" v-else type="checkbox">

                                        <label for="checkbox5">

                                            QA Formed for Equipment Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary">

                                        <input id="qa_qc_inspec" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked>

                                        <input id="qa_qc_inspec" name="qa_qc_inspec" v-else type="checkbox">

                                        <label for="checkbox6">

                                            QA/QC Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group" style="pointer-events:none;">

                                    <label for="exampleInputFile">Attachments</label>

                                    <input type="file" id="edit_image_file">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12 col-sm-offset-8">

                                    <button type="submit" class="btn btn-success waves-effect">

                                        Save

                                    </button>

                                    <button type="reset" class="btn btn-default waves-effect m-l-5">

                                        Clear

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>







                </div> <!-- container -->



            </div> <!-- content -->



            <footer class="footer text-right">

                2017 &copy; Buy Fresh Produce Inc.

            </footer>

        </div>

    </div>



    <!-- Unauthorized user section -->

    <div v-else>

        <div class="content-page">

            <!-- Start content -->

            <div class="content">

                <div class="container">





                    <div class="row">

                        <div class="col-xs-12">

                            <div class="page-title-box">

                                <h4 class="page-title">Work Orders | Buy Fresh Produce Inc. </h4>

                                <ol class="breadcrumb p-0 m-0">

                                    <li>

                                        <a href="#">Home</a>

                                    </li>

                                    <li class="active">

                                        New Work Order

                                    </li>

                                </ol>

                                <div class="clearfix"></div>

                            </div>

                        </div>

                    </div>

                    <!-- end row -->



                    <div class="row">

                        <form method="post" id="edit_wo_form">

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label for="">Work Order Issue Date</label>

                                    <input type="text" name="issue_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_issue_date" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Work Order No</label>

                                    <input type="text" name="wo_number" class="form-control" id="Text" v-model="selected_order.WO_id" readonly>

                                </div>

                                <div class="form-group">

                                    <label for="">Attachments</label>

                                    <div class="attachment-scroll">

                                        <div v-for="image in work_order_images">

                                            <div v-if="explodeFileName(image.image) == 'pdf'">

                                                <a :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image">

                                                    <img class="upld_img" src="assets/images/file.png" style="width:80px; height:auto;">

                                                </a>

                                            </div>

                                            <div v-else-if="explodeFileName(image.image) == 'mp4' || explodeFileName(image.image) == 'avi'">

                                                	<a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" src="assets/images/mp4.png" style="width:80px; height:auto;"></a>

                                                </div>

                                            <div v-else>

                                                <a data-fancybox="gallery" :href="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image"><img class="upld_img" :src="'uploads/workorders/' + selected_order.WO_id +'/'+ image.image" style="width:80px; height:auto;"></a>

                                            </div>

                                            <div><hr></div>

                                        </div>
                                    </div>

                                </div>

                                <!-- <div class="form-group">

                                    <div><img :src="'uploads/workorders/' + selected_order.WO_id +'/'+selected_order.WO_edit_image" style="width:80px; height:auto;"> </div>

                                </div> -->

                            </div>

                            <div class="col-md-7">

                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Equipment No</label>

                                            <input type="text" name ="eqp_number" class="form-control" id="Text" v-model="selected_order.eqp_no" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Location</label>

                                            <input type="text" name="location" class="form-control" id="Text" v-model="selected_order.location" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Work Order Issued To</label>

                                            <select name="option" id="wo_option" class="form-control" v-model="selected_order.WO_issue_to"  style="pointer-events:none;" disabled>

                                                <option value="Maintanance">Maintanance</option>

                                                <option value="Quality Check">Quality Check</option>

                                                <option value="Returns">Returns</option>

                                                <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="">Due By</label>

                                            <input type="text" name="due_date" class="form-control datepicker-autoclose" id="Text" v-model="selected_order.WO_due_date" readonly>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="">Description</label>

                                            <textarea name="description" id="" rows="5" class="form-control" v-model="selected_order.WO_description" readonly></textarea>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Corrective Action Description</label>

                                            <textarea name="corr_description" id="" rows="3" class="form-control" v-model="selected_order.WO_corrective_action_description" disabled></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">QC Inspection and Approved By</label>

                                                    <div disabled>

                                                        <canvas id="qaqc_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                                    </div>

                                                    <button type="button" id="qaqc_sign_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="qaqc_sign_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Date</label>

                                                    <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" v-if="selected_order.WO_issue_date != null" :value="selected_order.WO_issue_date" readonly>

                                                    <input type="text" name="approve_date" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" id="Text" name="date" v-else>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label for="">Comments / General Notes</label>

                                            <textarea name="comments" id="wo_comments" rows="5" class="form-control" v-model="selected_order.WO_general_notes" readonly></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="">Verified By</label>

                                                    <canvas id="" class="signature-padc" width=300 height=150> <p>Sign Here</p> </canvas>

                                                    <button type="button" id="varified_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                                    <button type="button" id="varified_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">

                                                    <label for="">Verified Date</label>

                                                    <input type="text" class="form-control datepicker-autoclose" id="Text" v-if="selected_order.WO_verified_date !=null" :value="selected_order.WO_verified_date" readonly>

                                                    <input type="text" class="form-control datepicker-autoclose" data-provide="datepicker" data-date-start-date="+0d" v-else id="Text" value="<?php echo date("Y-m-d"); ?>" readonly>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group" >

                                    <label for="">Assigned To</label>

                                    <select id="assigned_to" class="form-control" v-model="selected_order.WO_assigned_to" style="pointer-events:none;" disabled >

                                        <option v-for="user in all_users" :value="user.username">{{ user.username }}</option>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_hold" type="checkbox" v-if="selected_order.QA_hold == '1'" checked>

                                        <input id="qa_hold" type="checkbox" v-else>

                                        <label for="checkbox1">

                                            QA Hold

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="qa_inspection" type="checkbox" v-if="selected_order.QA_inspection_required == '1'" checked>

                                        <input id="qa_inspection" type="checkbox" v-else>

                                        <label for="checkbox2">

                                            QA Inspection Required

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="emply_safety_haz" type="checkbox" v-if="selected_order.WO_employee_saftey_hazard == '1'" checked>

                                        <input id="emply_safety_haz" type="checkbox" v-else>

                                        <label for="checkbox3">

                                            Employee Safety Hazard

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="">Corrected By</label>

                                    <div disabled>

                                        <canvas id="corrected_sign" class="signature-padc" width=300 height=150 style="pointer-events:none;"></canvas>

                                    </div>

                                    <button type="button" id="corrected_save" class="btn btn-sm btn-purple waves-effect" disabled>Save Sign.</button>

                                    <button type="button" id="corrected_clear" class="btn btn-sm btn-default waves-effect" disabled>Clear Sign.</button>

                                </div>



                                <div class="form-group">

                                    <label for="">Corrective Action Date</label>

                                    <input type="text" class="form-control datepicker-autoclose" v-if="selected_order.WO_corrected_date != null" id="correction_date" data-provide="datepicker" data-date-start-date="+0d" :value="selected_order.WO_corrected_date" readonly>

                                    <input type="text" class="form-control datepicker-autoclose" v-else id="correction_date" data-provide="datepicker" data-date-start-date="+0d" readonly>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox4" name="eq_wash" type="checkbox"  v-if="selected_order.WO_equipment_washed == '1'" checked>

                                        <input id="checkbox4" name="eq_wash" v-else type="checkbox" >

                                        <label for="checkbox4">

                                            Equipment Wash &amp; Sanitized

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox5" name="qa_formed" type="checkbox"  v-if="selected_order.WO_formed == '1'" checked >

                                        <input id="checkbox5" name="qa_formed" v-else type="checkbox" >

                                        <label for="checkbox5">

                                            QA Formed for Equipment Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="checkbox checkbox-primary" style="pointer-events:none;">

                                        <input id="checkbox6" name="qa_qc_inspec" type="checkbox"  v-if="selected_order.QA_QC_inspection_approval == '1'" checked >

                                        <input id="checkbox6" name="qa_qc_inspec" v-else type="checkbox" >

                                        <label for="checkbox6">

                                            QA/QC Inspection &amp; Approval

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group" style="pointer-events:none;">

                                    <label for="exampleInputFile">Attachments</label>

                                    <input type="file" id="edit_image_file">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12 col-sm-offset-8">

                                    <button type="submit" class="btn btn-success waves-effect" disabled>

                                        Save

                                    </button>

                                    <button type="reset" class="btn btn-default waves-effect m-l-5" disabled>

                                        Clear

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>







                </div> <!-- container -->



            </div> <!-- content -->



            <footer class="footer text-right">

                2017 &copy; Buy Fresh Produce Inc.

            </footer>

        </div>

    </div>



</div>