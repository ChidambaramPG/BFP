        <div class="modal fade" id="delete_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Delete User</h4>

              </div>

              <div class="modal-body">

                Are you sure you want to delete user?

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <button type="button" class="btn btn-danger" id='delete_user_btn'>Delete</button>

              </div>

            </div>

          </div>

        </div>

        <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Add New User</h4>

              </div>

              <div class="modal-body">

                <form action="" id="add_user_form" method="post">

                    <div class="form-group">

                        <input type="text" class="form-control" placeholder="Username" name= "username" required>

                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control" placeholder="First Name" name= "firstname" required>

                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control" placeholder="Last Name" name= "lastname" required>

                    </div>

                    <div class="form-group">

                        <input type="email" class="form-control" placeholder="Email" name= "email" required>

                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control" placeholder="Password" name= "password" required>

                    </div>

                    <div class="form-group">

                        <select name="level" id="" class="form-control">

                            <option value="standard">User Level</option>

                            <option value="standard">Standard</option>

                            <option value="qc">QC</option>

                        </select>

                    </div>

                </form>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <button id="add_user_btn" type="button" class="btn btn-success">Save</button>

              </div>

            </div>

          </div>

        </div>

        <div class="modal fade" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Edit User</h4>

              </div>

              <div class="modal-body">

                <form action="" id="edit_user_form" method="post">

                    <div class="form-group">

                        <input type="text" class="form-control" placeholder="Username" name="username" v-model="selected_user.username" required>

                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control" placeholder="First Name" name="firstname" v-model="selected_user.first_name" required>

                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control" placeholder="Last Name" name="lastname" v-model="selected_user.last_name" required>

                    </div>

                    <div class="form-group">

                        <input type="email" class="form-control" placeholder="Email" name="email" v-model="selected_user.email" required>

                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control" name="password" placeholder="Password" required>

                    </div>

                    <div class="form-group">

                        <select name="level" id="" class="form-control">

                            <option value="standard">User Level</option>

                            <option value="standard">Standard</option>

                            <option value="stage 4">Stage 4</option>

                            <option value="qc">QC</option>

                        </select>

                    </div>

                </form>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <button type="button" class="btn btn-success" id="edit_user_btn">Save</button>

              </div>

            </div>

          </div>

        </div>



        <div class="modal fade" id="delete_equipment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

              <div class="modal-dialog" role="document">

                <div class="modal-content">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="myModalLabel">Delete Equipment</h4>

                  </div>

                  <div class="modal-body">

                    Are you sure you want to delete it?

                  </div>

                  <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    <button type="button" class="btn btn-danger" id="delete_equipment_btn">Delete</button>

                  </div>

                </div>

              </div>

        </div>



        <div class="modal fade" id="add_equipment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">New Equipment</h4>

              </div>

              <div class="modal-body">

                <div class="row">

                    <div class="alert alert danger" id="equipment_error"></div>

                    <div class="col-md-6">

                        <div class="eq-img-box">

                            <i class="fa fa-image"></i>

                        </div>

                        <form id="image_form" enctype="multipart/form-data">

                            <div class="form-group">

                                <input name="file" type="file"  id="image_file" >

                            </div>

                        </form>



                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" placeholder="Equipment Name" name="name" id="equipment_name" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" placeholder="Serial No" name="serialNum" id="equipment_serialNum" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" placeholder="Model No" name="modelNum" id="equipment_modelNum" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" placeholder="Make" name="make" id="equipment_make" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" placeholder="Asset #" name="asset" id="equipment_asset" required>

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control input-sm" placeholder="Repair Cost" name="repair_cost" id="repair_cost" required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="">Notes (350 Char Max)</label>

                            <textarea rows="5" class="form-control" name="note" id="equipment_note"></textarea>

                        </div>

                    </div>

                </div>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <button type="submit" class="btn btn-success" id="add_equipment_btn">Add Now</button>

              </div>

            </div>

          </div>

        </div>



        <div class="modal fade" id="edit_equipment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Edit Equipment</h4>

              </div>

              <div class="modal-body">

                <div class="row">

                    <div class="alert alert danger" id="equipment_error"></div>

                    <div class="col-md-6">

                        <div class="eq-img-box">

                            <i class="fa fa-image"></i>

                        </div>

                        <form id="image_form" enctype="multipart/form-data">

                            <div class="form-group">

                                <input name="file" type="file" id="edit_image_file" >

                            </div>

                        </form>



                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <input type="text" v-model="selected_equipment.name" class="form-control input-sm" placeholder="Equipment Name" name="name" id="edit_equipment_name" required>

                        </div>

                        <div class="form-group">

                            <input type="text" v-model="selected_equipment.serial_number" class="form-control input-sm" placeholder="Serial No" name="serialNum" id="edit_equipment_serialNum" required>

                        </div>

                        <div class="form-group">

                            <input type="text" v-model="selected_equipment.model_number" class="form-control input-sm" placeholder="Model No" name="modelNum" id="edit_equipment_modelNum" required>

                        </div>

                        <div class="form-group">

                            <input type="text" v-model="selected_equipment.make" class="form-control input-sm" placeholder="Make" name="make" id="edit_equipment_make" required>

                        </div>

                        <div class="form-group">

                            <input type="text" v-model="selected_equipment.asset" class="form-control input-sm" placeholder="Asset #" name="asset" id="edit_equipment_asset" required>

                        </div>

                        <div class="form-group">

                            <input type="text" v-model="selected_equipment.repair_cost" class="form-control input-sm" placeholder="Repair Cost" name="edit_repair_cost" id="edit_repair_cost" required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="">Notes (350 Char Max)</label>

                            <textarea rows="5" v-model="selected_equipment.note" class="form-control" name="note" id="edit_equipment_note"></textarea>

                        </div>

                    </div>

                </div>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <button type="submit" class="btn btn-success" id="edit_equipment_btn">Add Now</button>

              </div>

            </div>

          </div>

        </div>

        <div class="modal fade" id="task_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Success</h4>

              </div>

              <div class="modal-body">

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <h3 style="color:#4bd396;">Saved Succesfully</h3>

                        </div>

                    </div>

                </div>

              </div>

            </div>

          </div>

        </div>



        <div class="modal fade" id="no_signatures_alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">



              <div class="modal-body">

                <div class="row">

                    <div class="col-md-12">

                        <div class="account-content">

                            <div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                                <i class="mdi mdi-check-all"></i>

                                <strong>Need Signatures!</strong>

                            </div>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div>

              </div>

            </div>

          </div>

        </div>



        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="alertModal" style="margin: 150px auto;">

            <div class="row" style="padding-top: 10px;" >

                <div class="col-md-4"></div>

                <div class="col-md-4">

                    <div class="modal-content">

                        <div class="modal-body cart-addon">

                            <h5 :class="messageClass">{{ modalMessage }}</h5>

                        </div>

                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">

                          <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                </div>

                <div class="col-md-4">



                </div>

            </div>

        </div>



        <div class="modal fade" id="delete_pur_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

              <div class="modal-dialog" role="document">

                <div class="modal-content">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="myModalLabel">Delete Purchase Order</h4>

                  </div>

                  <div class="modal-body">

                    Are you sure you want to delete it?

                  </div>

                  <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    <button type="button" class="btn btn-danger" id="delete_purchase_order_btn">Delete</button>

                  </div>

                </div>

              </div>

        </div>

        <div class="modal fade" id="edit_purchase_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Edit Purchase Order</h4>

              </div>

              <div class="modal-body">
                <div class="row hidden" id="missing_values">
                </div>

                <div class="row">

                    <form action="" class="form-horizontal" id="purchase_order_form">

                        <div class="col-md-5">

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Part No</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" v-model="selectedPurchaseOrder.part_number" id="edit_equipment_partNum" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Supplier</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" v-model="selectedPurchaseOrder.supplier" id="edit_equipment_supplier" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Link</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" v-model="selectedPurchaseOrder.link" id="edit_equipment_link" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Unit Price</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" v-model="selectedPurchaseOrder.unit_price" id="edit_equipment_unitPrice" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Quantity</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" v-model="selectedPurchaseOrder.quantity" id="edit_equipment_qty" placeholder="" required>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-5">

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Invoice / PO</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" v-model="selectedPurchaseOrder.invoice_number" id="edit_equipment_invNum" placeholder="" required>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="" class="col-sm-4 control-label">Shipping Cost</label>

                                <div class="col-sm-8">

                                  <input type="text" class="form-control input-sm" v-model="selectedPurchaseOrder.shipping_cost" id="edit_equipment_shippingCost" placeholder="" required>

                                </div>

                            </div>


                        </div>

                    </form>

                </div>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <button type="submit" class="btn btn-success" id="save_purchase_btn">Save</button>

              </div>

            </div>

          </div>

        </div>



        <div class="modal fade" id="delete_work_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

              <div class="modal-dialog" role="document">

                <div class="modal-content">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="myModalLabel">Delete Work Order</h4>

                  </div>

                  <div class="modal-body">

                    Are you sure you want to delete it?

                  </div>

                  <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    <button type="button" class="btn btn-danger" id="delete_work_order_btn">Delete</button>

                  </div>

                </div>

              </div>

        </div>



    </div>

</div>

        <script>

            var resizefunc = [];

        </script>



        <!-- jQuery  -->

        <script src="assets/js/jquery.min.js"></script>

        <script src="assets/js/bootstrap.min.js"></script>

        <script src="assets/js/detect.js"></script>

        <script src="assets/js/fastclick.js"></script>

        <script src="assets/js/jquery.blockUI.js"></script>

        <!-- <script src="assets/js/waves.js"></script> -->

        <script src="assets/js/jquery.slimscroll.js"></script>

        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>

        <script src="assets/js/jquery.app.js"></script>

        <script src="assets/js/vue.js"></script>

        <script src="assets/js/jquery.easy-autocomplete.min.js"></script>

        <script src="assets/js/jquery.autocomplete.js"></script>

        <script src="assets/js/jquery.loadingModal.js"></script>

        <script src="assets/js/jcanvas.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>

        <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script> -->

        <script src="assets/js/main.js"></script>


        <script>
            $(function () {
                jQuery('.datepicker').datepicker();
                jQuery('.datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    startDate: '-3d'
                });
            });
        </script>


    </body>

</html>