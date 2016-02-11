<div class="row">
                    <div class="col-md-12 rounded-6px">
                
                       
                      
                        <?php   if ($this->session->flashdata('successmsg') != ''): ?>
                                <div class="alert alert-success" >
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
                                </div>
                            <?php endif; ?>
                            <div class="table-responsive">
                        <div class="col-md-12">
                          
                                 <div class="row">
                                        <div class="col-md-3">
                                        <div class="form-group">
                                        <label>From Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="from_date_inward" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-3 ">
                                        <div class="form-group">
                                        <label>To Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="to_date_inward" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        


                                       <!--  <div class="col-md-3" id="filter_record_btn">
                                        <div class="form-group">
                                        <label>&nbsp;</label>
                                            <div class='input-group date'>
                                               <a href="#" class="btn btn-block btn-md btn-info">
                                            <span class="glyphicon glyphicon-trash"></span> Delete Filter Records </a>
                                            </div>
                                        </div>
                                        </div> -->
                                    </div>
                                    <div class="alert alert"></div>
                                     <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Amount</th>
                                            <th>Tax</th>
                                            <th>Date</th>
                                            <th>Delete</th>
                                           
                                        </tr>
                                    </thead>
                     

                            <tbody id="old_inward">
                                  <?php if (empty($payment_info)): ?>
                                              <tr class="alert alert-danger">
                                                <td colspan="3">
                                                  There are no Records to display.
                                                </td>
                                                </tr>
                                              <?php endif; ?>
                                
                                    <?php foreach ($payment_info as $st): ?>
                                        <tr class="odd gradeX">
                                           <td >
                                            <?php
                                              echo $st['customername'];
                                            ?>
                                            </td>
                                            <td class="odd gradeX text-center" width="150px;">
                                            <?php                                             
                                              echo $st['amount'];
                                            ?>
                                            </td>
                                            <td class="text-center " id="tax">
                                            <?php                                               
                                               echo $st['tax']."%";
                                            ?>
                                            </td>
                                            <td class="text-center " id="tax">
                                            <?php                                             
                                              echo  $st['date'];
                                            ?>
                                            </td>
                                            <td class="">
                                            <a href="#" class="btn btn-md btn-danger" id="single_record" attr="<?php echo $st['id'];?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                                Delete
                                            </a>
                                            </td>
                                            
                                        </tr>
                                       <?php endforeach; ?>
                                       
                                    </tbody>

                                    <tbody id="filer_inward_table">
                                      
                                    </tbody>
                                     <tr id="all_record">
                                            <td class="text-right"></td>
                                            <td id="tax"></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">
                                            <a href="#" class="btn btn-block btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span> Delete All Records </a>
                                            </td>
                                        </tr>
                                </table>
                                </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    <!-- Button trigger modal -->

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
      <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap-growl.js'?>"></script>

    
         <!-- CUSTOM SCRIPTS -->

        <script type="text/javascript">

    


        $(document).ready(function () {
           $('#spin').hide();

           $('#all_record').click(function(){

           });
            $('#filter_record_btn').hide();


          
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
                });
     

     $( "#from_date_inward" ).change(function() {
        $('#old_inward').fadeOut(); 
        $('#filter_record_btn').show();
      var url = "<?php echo site_url('admin/trash/filter_by_date'); ?>" 
      var start_date = $('#from_date_inward').val();
      var end_date = $('#to_date_inward').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':'Inward'};
                $.post(url,postdata, function(data){

                            $('#filer_inward_table').html(data);
                    });
        });


     $( "#to_date_inward" ).change(function() {
        $('#filter_record_btn').show();
        $('#old_inward').hide(); 
      var url = "<?php echo site_url('admin/trash/filter_by_date'); ?>" 
      var start_date = $('#from_date_inward').val();
      var end_date = $('#to_date_inward').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':'Inward'};
                $.post(url,postdata, function(data){
                            $('#filer_inward_table').html(data);
                    });

        });


      $( "#exp" ).change(function() {
            var val =$('#exp').val();
           
            $('#dataTables-example1').tableExport({type:val,escape:'false'})
                
        });
    $('#all_record').click(function(){
        var res=confirm('Are You Sure');
    if(res){
      
     $.ajax({
            type : 'POST',
            url : "<?php echo site_url('admin/trash/delete_all'); ?>",
           
            success : function (returnData) {
                   
                  $('#spin').show();
                  $('#old_inward').html(returnData);
            },
            
            complete : function (){
                $('#spin').hide();
                $.growl('<strong>Deleted </strong>Successfuly....', {
                    animate: {
                        enter: 'animated fadeInRight',
                        exit: 'animated fadeOutRight'
                    }   ,
                    offset:{
                        x:60,
                        y:280
                    },
                    type: 'info',
                    
                    spacing: 400,
                    z_index: 1031,
                    delay: 3000,
                    timer: 1000,
                    position: 'top-left'
                });
                
                
            }
        });
}
});



        $('#spin').hide();
    $('#single_record').click(function(){
        var id=$('#single_record').attr('attr');
        var res=confirm('Are You Sure');
    if(res){

     $.ajax({
            type : 'POST',
            url : "<?php echo site_url('admin/trash/delete'); ?>",
            data : {'id':id},
            beforeSend : function (){
            },
            success : function (returnData) {
                  $('#spin').show();
            var url = "<?php echo site_url('admin/trash/filter_by_date'); ?>" 
            var start_date = $('#from_date_inward').val();
            var end_date = $('#to_date_inward').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':'Inward'};
                $.post(url,postdata, function(data){

                            $('#old_inward').html(data);
                    });
            },
            error : function (xhr, textStatus, errorThrown) {
                //other stuff
            },
            complete : function (){
                $('#spin').hide();
                $.growl('<strong>Deleted </strong>Successfuly....', {
                    animate: {
                        enter: 'animated fadeInRight',
                        exit: 'animated fadeOutRight'
                    }   ,
                    offset:{
                        x:60,
                        y:280
                    },
                    type: 'info',
                    
                    spacing: 400,
                    z_index: 1031,
                    delay: 3000,
                    timer: 1000,
                    position: 'top-left'
                });
                
                
            }
        });
}
});

        </script>