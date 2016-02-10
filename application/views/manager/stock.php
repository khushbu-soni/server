<!DOCTYPE html>
<html>
    <head>

        <title>Biryani House.</title>
        
        <?php echo $dependencies; ?>
        <link href="<?php echo base_url() . 'assets/css/tabs.css'?>" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/css/select2.css'?>" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/css/select2-bootstrap.css'?>" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/highcharts.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/exporting.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/select2.js'; ?>"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"> -->

    </head>
  <body>
    <div id="wrapper" style="margin-top: 25px;">
      <?php echo $header;?>
      <?php echo $sidebar;?>

     <!--  -->


      <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">

   

<div class="container">
    <div class="row">
    <div class="col-md-12">
      <h3 class="text-center">Invetory & Stock</h3>

      <div class="tabbable-panel">
        <div class="tabbable-line">
          
            <button class="btn btn-cyan" id="received-btn">
              <a href="#tab_default_1" id="received" data-toggle="tab">
              Inward Stock </a>
            </button>
            <button id="paid-btn" class="btn btn-pink">
              <a href="#tab_default_2" id="paid" data-toggle="tab">
              Consume Stock </a>
            </button>
             <button id="report-btn" class="btn btn-golden">
              <a href="#tab_default_3" id="report" data-toggle="tab">
              Consume Report </a>
            </button>
             <button id="day_report-btn" class="btn btn-warning" style="display:none">
              <a href="#tab_default_4" id="report" data-toggle="tab">
              Day End Report </a>
            </button>
            
         
          <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
              <!-- Table -->

                <div class="container">
  <div class="row">
    
        
        <div class="col-md-12">
       

        <div class="table-responsive">
        <h4 class="text-center" style="border-bottom:4px solid cyan; width:300px">Add Inward</h4>
       <form class="form-inline" name="form_inward">
        <div class="form-group">
            <div class='input-group date'>
                <input type='text' class="form-control datepicker" id="inward_date" data-date-format="mm/dd/yyyy" value="<?php echo date('Y-m-d');?>" required />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
       
        <div class="form-group">
            <label class="sr-only" for="inputEmail">ITEM</label>
           <select id="inward_item"  class=" input-default form-control" required>
            <?php 
        // print_r($ingredients);
        foreach ($ingredients as $value) {
          echo "<option value=".$value['id'].">".$value['name']."</option>";
          # code...
        }
        ?>
           
          </select> 
        </div>
        <div class="form-group">
            <label class="sr-only" for="inputEmail">ITEM</label>
           <select id="inward_item_unit"  class=" input-default form-control" required>
           <option value="KG">KG</option>
           <option value="LTRS">LTRS</option>
           <option value="BOTTLE">BOTTLE</option>
           <option value="PTS">PTS</option>
           <option value="TRAYS">TRAYS</option>
           <option value="TRAY">TRAY</option>
           <option value="PACKET">PACKET</option>
          </select> 
        </div>
        <div class="form-group">
            <label class="sr-only" for="inputEmail">QTY</label>
            <input type="number" class="form-control" id="inwardQty" placeholder="QTY" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="inputEmail">PRICE</label>
            <input type="number" class="form-control" id="inwardPrice" placeholder="PRICE" required>
        </div>
        <button type="button" id='add_inward' class="btn btn-primary">ADD</button>

    </form>
                
              <table id="mytable" class="table table-bordred table-striped" style="width:97%">
                   
                   <thead>
                   
                       <th>Date</th>
                       <th>Item</th>
                    
                       <th>Qty</th>
                       <th>Price</th>
                       <th>Current InStock</th>
                       <th>Delete</th>
                      
                   </thead>
    <tbody id="received-body">
    
    </tbody>
        
</table>

<div class="clearfix"></div>

                
            </div>
            
        </div>
  </div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body" id="edit_received_data">
        
          </div>
          <div class="modal-footer ">
        <button type="button" id='update' data-dismiss='modal' class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
  
  </div>
    </div>
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       <input type="hidden" id="del_id" value="" />
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="yes"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>

    <div class="modal fade" id="paiddelete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       <input type="hidden" id="received_del_id" value="" />
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="yes"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>



              
              
            </div>
            <div class="tab-pane" id="tab_default_2">
              
               <div class="container">
      <div class="row">
            <div class="col-md-12">
            <h4 class="text-center" style="border-bottom:4px solid pink; width:300px">Add Consume</h4>
            <form class="form-inline" name="form_inward">
        <div class="form-group">
            <div class='input-group date'>
                <input type='text' class="form-control datepicker" id="consume_date" data-date-format="mm/dd/yyyy" value="<?php echo date('Y-m-d');?>" required />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
       
        <div class="form-group">
            <label class="sr-only" for="inputEmail">ITEM</label>
           <select id="consume_item"  class=" input-default form-control" required>
            <?php 
        // print_r($ingredients);
        foreach ($inward_ingredients as $value) {
          echo "<option value=".$value['id'].">".$value['name']."</option>";
          # code...
        }
        ?>
           
          </select> 
        </div>
        <div class="form-group">
            <label class="sr-only" for="inputEmail">ITEM</label>
           <select id="consume_item_unit"  class=" input-default form-control" required>
           <option value="KG">KG</option>
           <option value="LTRS">LTRS</option>
           <option value="BOTTLE">BOTTLE</option>
           <option value="PTS">PTS</option>
           <option value="TRAYS">TRAYS</option>
           <option value="TRAY">TRAY</option>
           <option value="PACKET">PACKET</option>
          </select> 
        </div>
        <div class="form-group">
            <label class="sr-only" for="inputEmail">QTY</label>
            <input type="number" class="form-control" id="consumeQty" placeholder="QTY" required>
        </div>
       
        <button type="button" id='add_consume' class="btn btn-primary">ADD</button>

    </form>
            <div class="table-responsive">

                    
                  <table id="mytable" class="table table-bordred table-striped" style="width:97%">
                       
                        <thead>
                   
                       <th>Date</th>
                       <th>Item</th>
                    
                       <th>Qty</th>
                       
                         <th>Current InStock</th>
                       <th>Delete</th>
                      
                   </thead>
        <tbody id="paid-body">
        
        
        </tbody>
            
    </table>




<div class="modal fade" id="mypaidModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Paid Your Detail</h4>
      </div>
          <div class="modal-body" id="edit_paid_data">
        
          </div>
          <div class="modal-footer ">
        <button type="button" id='update_paid' data-dismiss='modal' class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
</div>

    <!-- paid EDIt -->

    <div class="clearfix"></div>
   
                    
                </div>
                
            </div>
      </div>
</div>
              
            </div>
            <div class="tab-pane" id="tab_default_3">
             
              <div class="row">
                                        <div class="col-md-4">
                                        <div class="form-group">
                                        <label>From Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="from_date_payment" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-4 ">
                                        <div class="form-group">
                                        <label>To Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="to_date_payment" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-2 ">
                                        <div class="form-group">
                                        <label>Type</label>
                                            <select name="filter_payment" id="filter_payment" aria-controls="dataTables-example1" class="form-control input-sm">
                                            <option value="other">All</option>
                                            <option value="salary">Salary</option>
                                            <option value="supplier">Supplier Payment</option>
                                            <option value="bank">Bank Deposite</option>
                                            <option value="directors">Directors</option>
                                            </select>
                                        </div>
                                        </div><div class="col-md-2 ">
                                        <div class="form-group">
                                        <label>Export</label>
                                            <select name="exp" id="exp" aria-controls="dataTables-example1" class="form-control input-sm">
                                            <option value="">Select Format</option>
                                            <option value="excel">excel</option>
                                            <option value="csv">csv</option>
                                            </select>
                                        </div>
                                        </div>
                                         

                                        
                                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                     
                                        <tr>

                                            <th>Item Name</th>
                                            <th>QTY</th>
                                            <th>Last Purchase</th>
                                                                                      
                                        </tr>
                                    </thead>
                     

                                    <tbody id="report_table">
                                    
                                   
                                        
                                    </tbody>
                                    
                                
                                     </table>
                                    </div>

            </div>
            
          </div>
          <div class="tab-pane" id="tab_default_4"> 
          <div class="row">
          <div class="col-md-4">
                                        <div class="form-group">
                                        <label>From Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="from_date_day" data-date-format="mm/dd/yyyy" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-4 ">
                                        
                                        <div class="form-group">
                                        <label>To Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="to_date_day" data-date-format="mm/dd/yyyy" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-4 ">
                                        <div class="form-group">
                                        <label>Export</label>
                                            <select name="exp" id="exp1" aria-controls="dataTables-example1" class="form-control input-sm">
                                            <option value="">Select Format</option>
                                            <option value="excel">excel</option>
                                            <option value="csv">csv</option>
                                            </select>
                                        </div>
                                        </div>

            <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>

                                        <tr>
                                            <th>Item No.</th>
                                            <th>Item Name</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Total Amount</th>
                                        </tr>
                                           
                                    </thead>
                     

                                    <tbody id="day_report_table">
                                    
                                   
                                        
                                    </tbody>
                                    
                                
                                     </table>
          </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

</div>
</div>
</div>


<div class="modal fade" id="myModalX" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       <input type="hidden" id="paid_del_id" value="" />
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="yes_paid"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    
  </div>
</div>


         
    
    <!-- 
<script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap-datetimepicker.js'?>" charset="UTF-8"></script>
  <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap-datetimepicker.fr.js'?>" charset="UTF-8"></script>
     -->
    
  </body>

  <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery-1.10.2.js'?>"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap.min.js'?>"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery.metisMenu.js'?>"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/dataTables.bootstrap.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap-datetimepicker.js'?>" charset="UTF-8"></script>
  <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap-datetimepicker.fr.js'?>" charset="UTF-8"></script>
  <script src="<?php echo base_url() . 'assets/binary-assets/js/tableExport.js'?>" charset="UTF-8"></script>
  <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery.base64.js'?>" charset="UTF-8"></script>
    <script type="text/javascript">
  

    $(document).ready(function(){

       $('#dataTables-example').DataTable();

      $('.datepicker').datetimepicker({
             weekStart: 1,
                  todayBtn:  1,
                  autoclose: 1,
                  todayHighlight: 1,
                  startView: 2,
                  minView: 2,
                  forceParse: 0
      });


      $('#staff').hide();
      $('#supplier').hide();
      $('#supplier_msg').hide();

      $( "#exp" ).change(function() {
            var val =$('#exp').val();
           
            $('#dataTables-example').tableExport({type:val,escape:'false'})
                
        });

       $( "#exp1" ).change(function() {
            var val =$('#exp1').val();
           
            $('#dataTables-example1').tableExport({type:val,escape:'false'})
                
        });
      
    $( "#from_date_payment" ).change(function() {
        
      var url = "<?php echo site_url('manager/inventory/consume_report'); ?>" 
      var start_date = $('#from_date_payment').val();
      var end_date = $('#to_date_payment').val();
      var type = $('#filter_payment').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':type};
                $.post(url,postdata, function(data){

                            $('#report_table').html(data);
                    });
        });

    // $( "#from_date_day" ).change(function() {
        
    //   var url = "<?php echo site_url('manager/inventory/consume_report'); ?>" 
    //   var start_date = $('#from_date_day').val();
    //   var end_date = $('#to_date_day').val();
    //   var type = $('#filter_payment').val();
    //         var postdata = {'start_date' :start_date,'end_date':end_date,'type':type};
    //             $.post(url,postdata, function(data){

    //                         $('#day_report_table').html(data);
    //                 });
    //     });

      $( "#to_date_payment" ).change(function() {
        
      var url = "<?php echo site_url('manager/inventory/consume_report'); ?>" 
      var start_date = $('#from_date_payment').val();
      var end_date = $('#to_date_payment').val();
      var type = $('#filter_payment').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':type};
                $.post(url,postdata, function(data){

                            $('#report_table').html(data);
                    });
        });

      // $( "#to_date_day" ).change(function() {
        
      // var url = "<?php echo site_url('manager/inventory/consume_report'); ?>" 
      // var start_date = $('#from_date_day').val();
      // var end_date = $('#to_date_day').val();
      // var type = $('#filter_payment').val();
      //       var postdata = {'start_date' :start_date,'end_date':end_date,'type':type};
      //           $.post(url,postdata, function(data){

      //                       $('#day_report_table').html(data);
      //               });
      //   });

      $( "#filter_payment" ).change(function() {
        
      var url = "<?php echo site_url('manager/accounts/get_report'); ?>" 
      var start_date = $('#from_date_payment').val();
      var end_date = $('#to_date_payment').val();
      var type = $('#filter_payment').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':type};
                $.post(url,postdata, function(data){

                            $('#report_table').html(data);
                    });
        });
    });

 
     


       function get_value(){
        var res= $('#transaction_type').val();
          if(res=='salary_payment'){
              $('#staff').show();
              $('#supplier').hide();
          }

          if(res=='supplier_payment'){
              $('#staff').hide();
             
               $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/accounts/supplier');?>",
               
                success: function(result){
                  
                 $('#supplier_dropdown').html(result);

                   $('#supplier').show();

                }
            });
            }

            if(res=='other'){
               $('#staff').hide();
              $('#supplier').hide();
            }

          }

          function delete_paid_record(id){
      $('#paid_del_id').val(id);
    }

       function delete_received_record(id){
      $('#del_id').val(id);
    }
    function set_received_id(id){
        

        $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/inventory/edit_inward');?>",
                data:{id:id},
                success: function(result){
                
                 $('#edit_received_data').html(result);

                
                }
            });
      }

      function set_paid_id(id){
        // );$('#tr_id').val(id

        $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/accounts/edit_data');?>",
                data:{id:id},
                success: function(result){
                  // alert(result);
                  // return false;
                 $('#edit_paid_data').html(result);

                
                }
            });
      }

        
    $(document).ready(function(){

      $('#tab_default_2').hide();
      $('#tab_default_1').hide();
      $('#tab_default_3').hide();
      $('#tab_default_4').hide();

      $('#received-btn').click(function(){
        $('#type').val('Received');
      $('#tab_default_1').toggle();
      $('#tab_default_2').hide();
      $('#tab_default_3').hide();
      $('#tab_default_4').hide();
        $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/inventory/inward');?>",
              
                success: function(result){
                  // alert('hjg');
                 $('#received-body').html(result);
                  $('#paid-body').html('');

                }
            });
      });



      $('#paid-btn').click(function(){
        $('#type').val('Paid');
      $('#tab_default_2').toggle();
      $('#tab_default_1').hide();
      $('#tab_default_3').hide();
      $('#tab_default_4').hide();

       $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/inventory/consume');?>",
              
                success: function(result){
                  // alert('hjg');
                 $('#paid-body').html(result);
                $('#received-body').html('');

                }
            });

      });


      $('#add_inward').click(function(){
       
        var inward_item=$('#inward_item').val();
        var inward_date=$('#inward_date').val();
    var inwardQty=$('#inwardQty').val();
    var inwardPrice=$('#inwardPrice').val();
    var inward_item_unit=$('#inward_item_unit').val();

    if(!inwardQty){
      alert('Please Provide QTY');
      return false;
    }
    if(!inwardPrice){
      alert('Please Provide Price');
      return false;
    }

       $.ajax({
                type:'GET',
               url: "<?php echo site_url('manager/inventory/addinward');?>",
               data:{inward_date:inward_date,inward_item:inward_item,inwardQty:inwardQty,inwardPrice:inwardPrice,inward_item_unit:inward_item_unit},
              
                success: function(result){
                   $('#received-body').html(result);
                // $('#received-body').html('');
                }
            });

      });


      $('#add_consume').click(function(){
        var consume_item=$('#consume_item').val();
       alert(consume_item);
        var consume_date=$('#consume_date').val();
    var consumeQty=$('#consumeQty').val();
    var consumePrice=$('#consumePrice').val();
    var consume_item_unit=$('#consume_item_unit').val();

    if(!consumeQty){
      alert('Please Provide QTY');
      return false;
    }
    if(!consumePrice){
      alert('Please Provide Price');
      return false;
    }

       $.ajax({
                type:'GET',
               url: "<?php echo site_url('manager/inventory/addconsume');?>",
               data:{consume_date:consume_date,consume_item:consume_item,consumeQty:consumeQty,consume_item_unit:consume_item_unit},
              
                success: function(result){
                   $('#paid-body').html(result);
                // $('#received-body').html('');
                }
            });

      });

     
 



      $('#report-btn').click(function(){
        $('#type').val('Paid');
      $('#tab_default_3').toggle();
      $('#tab_default_1').hide();
      $('#tab_default_2').hide();
      $('#tab_default_4').hide();
     var start_date = "<?php echo date('Y-m-d');?>"
      var end_date = "<?php echo date('Y-m-d');?>"
       $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/inventory/consume_report');?>",
                data:{start_date:start_date,end_date:end_date},
                success: function(result){
                  // alert('hjg');
                 $('#paid-body').html(result);
                $('#received-body').html('');

                }
            });

      });

       $('#day_report-btn').click(function(){
          $('#type').val('Paid');
          $('#tab_default_4').toggle();
          $('#tab_default_1').hide();
          $('#tab_default_2').hide();
          $('#tab_default_3').hide();

       $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/accounts/paid_data');?>",
              
                success: function(result){
                  // alert('hjg');
                 $('#paid-body').html(result);
                $('#received-body').html('');

                }
            });

      });

      $('#inward_del1').click(function(){
        alert('f');
        return false;
      });


      function delete_record(id){
        $('#paid_del_id').val(id);
      }

      $('#yes').click(function(){
        var id=$('#del_id').val();


          $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/inventory/delete_record');?>",
                data:{id:id},
                success: function(result){
                  
                    $.ajax({
                        type:'GET',
                        url: "<?php echo site_url('manager/inventory/inward');?>",
                      
                        success: function(result){
                          // alert('hjg');
                         $('#received-body').html(result);

                        }
                    });

                }
            });

      });

       $('#yes_paid').click(function(){
       
        var id=$('#paid_del_id').val();

          $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/inventory/delete_record');?>",
                data:{id:id},
                success: function(result){
                  
                    $.ajax({
                        type:'GET',
                        url: "<?php echo site_url('manager/inventory/consume');?>",
                      
                        success: function(result){
                          // alert('hjg');
                         $('#paid-body').html(result);

                        }
                    });

                }
            });

      });

      $('#update').click(function(){
       
        var amount=$('#amount').val();
        var narration=$('#narration').val();
        var id=$('#tr_id').val();
        var edit_mode=$('#edit_mode').val();
        var edit_payment_against=$('#edit_payment_against').val();

          $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/accounts/update_data');?>",
                data:{amount:amount,narration:narration,id:id,supplier:'0',staff:'0',payment_against:edit_payment_against,mode:edit_mode},
                success: function(result){
                  
                    $.ajax({
                        type:'GET',
                        url: "<?php echo site_url('manager/accounts/received_data');?>",
                      
                        success: function(result){
                         
                         $('#received-body').html(result);

                        }
                    });

                }
            });

      });
       $('#update_paid').click(function(){
        alert(supplier=$('#edit_supplier').val());
        var amount=$('#amount').val();
        var narration=$('#narration').val();
        var supplier=$('#edit_supplier').val();
        var staff=$('#edit_staff').val();
        var id=$('#tr_id').val();
         var edit_mode=$('#edit_mode').val();
        var edit_payment_against=$('#edit_payment_against').val();
        if(!supplier)
          supplier='0';
        if(!staff)
            staff='0';

          $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/accounts/update_data');?>",
                data:{amount:amount,narration:narration,id:id,supplier:supplier,staff:staff,mode:edit_mode,payment_against:edit_payment_against},
                success: function(result){
                 
                    $.ajax({
                        type:'GET',
                        url: "<?php echo site_url('manager/accounts/paid_data');?>",
                      
                        success: function(result){
                          // alert('hjg');
                         $('#paid-body').html(result);

                        }
                    });

                }
            });

      });
       



      $('#save').click(function(){
        var type=$('#type').val();
        var amount =$('#amount').val();
      
          if(amount!=0){
            
            
              $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/accounts/received');?>",
                data:{amount:$('#amount').val(),date:$('#date').val(),narration:$('#narration').val(),payment_against:$('#payment_against').val(),mode:$('#mode').val()},
              
                success: function(data_res){


                  
                    $.ajax({
                        type:'GET',
                        url: "<?php echo site_url('manager/accounts/received_data');?>",
                      
                        success: function(result){
                          
                         $('#received-body').html(result);

                        }
                    });

                   
                }
            });  

          }else{
            alert('Please Provide amount');
          }

          
      });


             
      $('#save_paid').click(function(){
       

          var amount=$('#amount_paid').val();
          if(amount!=0){
            $.ajax({
                type:'GET',
                url: "<?php echo site_url('manager/accounts/paid');?>",
                data:{amount:$('#amount_paid').val(),supplier:$('#supplier_dropdown').val(),staff:$('.staff').val(),narration:$('#narration_paid').val(),'payment_against':$('#transaction_type').val(),mode:$('#paid_mode').val()},
              
                success: function(data_res){
                  // alert(data_res);
                    $.ajax({
                        type:'GET',
                        url: "<?php echo site_url('manager/accounts/paid_data');?>",
                      
                        success: function(result){
                         
                         $('#paid-body').html(result);

                        }
                    });

                   
                }
            }); 
          }else{
            alert('Please Provide Amount ');
          }
          

      });    

      $('#received').addClass('active');
      $('#paid').removeClass('active');
   
});

</script>
</html>