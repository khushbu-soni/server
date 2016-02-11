<div class="row">
                    <div class="col-md-12 rounded-6px">
                
                       
                      
                        <?php   if ($this->session->flashdata('successmsg') != ''): ?>
                                <div class="alert alert-success" >
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
                                </div>
                            <?php endif; ?>
                            <div class="table-responsive">
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading" style="padding:2px 2px;">
                                    <h4 class="text-center">Stock Inward</h4>

                                 </div>
                                 <div class="row">
                                        <div class="col-md-4">
                                        <div class="form-group">
                                        <label>From Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="from_date_inward" data-date-format="mm/dd/yyyy" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-4 ">
                                        <div class="form-group">
                                        <label>To Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="to_date_inward" data-date-format="mm/dd/yyyy" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-4 ">
                                        <div class="form-group">
                                        <label>Export</label>
                                            <select name="exp" id="exp" aria-controls="dataTables-example1" class="form-control input-sm">
                                            <option value="">Select Format</option>
                                            <option value="excel">excel</option>
                                            <option value="csv">csv</option>
                                            </select>
                                        </div>
                                        </div>
                                        
                                    </div>
                                     <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Date</th>
                                           
                                        </tr>
                                    </thead>
                     

                            <tbody id="old_inward">
                        
                                    <?php foreach ($stock_info_inward as $st): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                            <?php
                                                echo $st->name;
                                            ?>
                                            </td>
                                            <td class="odd gradeX" width="150px;">
                                            <?php                                               
                                                echo $st->qty;
                                            ?>
                                            </td>
                                            <td>
                                            <?php                                               
                                                echo $st->date;
                                            ?>
                                            
                                            </td>
                                            
                                        </tr>
                                       <?php endforeach; ?>
                                        
                                    </tbody>
                                    <tbody id="filer_inward_table">
                                        
                                    </tbody>
                                </table>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-danger">
                                <div class="panel-heading" style="padding:2px 2px;">
                                    <h4 class="text-center">Stock Consume</h4>
                                 </div>
                                 <div class="row">
                                        <div class="col-md-4">
                                        <div class="form-group">
                                        <label>From Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="from_date_consume" data-date-format="mm/dd/yyyy" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-4 ">
                                        <div class="form-group">
                                        <label>To Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control datepicker" id="to_date_consume" data-date-format="mm/dd/yyyy" value="<?php echo date('Y-m-d');?>" />
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
                                        
                                    </div>
                                    
                                     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Date</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="old_consume">
                            
                                    <?php foreach ($stock_info_consume as $st): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                            <?php
                                                echo $st->name;
                                            ?>
                                            </td>
                                            <td class="odd gradeX" width="150px;">
                                            <?php                                               
                                                echo $st->qty;
                                            ?>
                                            </td>
                                            <td>
                                            <?php                                               
                                                echo $st->date;
                                            ?>
                                            
                                            </td>
                                            
                                        </tr>
                                       <?php endforeach; ?>
                                        
                                    </tbody>
                                    <tbody id="filer_consume_table">
                                        
                                    </tbody>
                                </table>
                                </div>


                                </div>
                            </div>
                            
                        </div>

                    </div>
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
      
    
         <!-- CUSTOM SCRIPTS -->

        <script type="text/javascript">

    


        $(document).ready(function () {
                $('#dataTables-example').DataTable(); 
                $('#dataTables-example1').DataTable();
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
        $('#old_inward').hide(); 
      var url = "<?php echo site_url('admin/stock/filter_by_date'); ?>" 
      var start_date = $('#from_date_inward').val();
      var end_date = $('#to_date_inward').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':'Inward'};
                $.post(url,postdata, function(data){

                            $('#filer_inward_table').html(data);
                    });
        });

     $( "#from_date_consume" ).change(function() {
        $('#old_consume').hide(); 
      var url = "<?php echo site_url('admin/stock/filter_by_date'); ?>" 
      var start_date = $('#from_date_consume').val();
      var end_date = $('#to_date_consume').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':'Consume'};
                $.post(url,postdata, function(data){

                            $('#filer_consume_table').html(data);
                    });
        });

     $( "#to_date_inward" ).change(function() {
        $('#old_inward').hide(); 
      var url = "<?php echo site_url('admin/stock/filter_by_date'); ?>" 
      var start_date = $('#from_date_inward').val();
      var end_date = $('#to_date_inward').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':'Inward'};
                $.post(url,postdata, function(data){

                            $('#filer_inward_table').html(data);
                    });
        });

     $( "#to_date_consume" ).change(function() {
        $('#old_consume').hide(); 
      var url = "<?php echo site_url('admin/stock/filter_by_date'); ?>" 
      var start_date = $('#from_date_consume').val();
      var end_date = $('#to_date_consume').val();
            var postdata = {'start_date' :start_date,'end_date':end_date,'type':'Consume'};
                $.post(url,postdata, function(data){

                            $('#filer_consume_table').html(data);
                    });
        });

      $( "#exp" ).change(function() {
            var val =$('#exp').val();
           
            $('#dataTables-example1').tableExport({type:val,escape:'false'})
                
        });

 $( "#exp1" ).change(function() {
            var val =$('#exp1').val();
           
            $('#dataTables-example').tableExport({type:val,escape:'false'})
                
        });


        $( "#user" ).change(function() {
            $(location).attr('href'," <?php echo site_url('manager/stock_info/filter/'); ?>/"+$('#user').val());
        });
        $( "#role" ).change(function() {
            $(location).attr('href'," <?php echo site_url('manager/stock_info/filter_by_role/'); ?>/"+$('#role').val());
        });
        </script>