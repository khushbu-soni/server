<!DOCTYPE html>
<html>
    <head>
        <title>Biryani House.</title>
        <?php echo $dependencies; ?>
        <script type="text/javascript">


            function deleteAccount(event){
                        account = $(event.target);
                        accountid = account.attr('accountid');

                        $.ajax({
             type: "GET",
             url: "<?php echo site_url('manager/useraccounts/delete'); ?>" + '/' + accountid,
             
             success: function(data){
              
              //$('#page-wrapper').html(data);
              location.reload();   
              
             }
            });
        }

            
                
        </script>
        <style type="text/css">
            .pagination > li {
              display: inline;
              float: right !important;
            }
            .navbar{
                margin-top: 25px !important;
            }
        </style>
    </head>

    <body>
        
        <div id="wrapper">
        <?php echo $header;?>
        <?php echo $sidebar;?>


        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 rounded-6px">
                <div class="panel panel-default">
                        <div class="panel-heading">
                        <div class='search-form'>
                        <select name='user' id="user">
                            <option value="All">Select Type</option>
                            <option value="All">All</option>
                            <?php foreach ($notification_type as $type) {?>
                            <option value="<?php echo $type->id;?>"><?php echo $type->notification;?></option>
                            <?php }?>

                        </select>
                </div>
                        </div>
                        <div class="panel-body">
                        <?php   if ($this->session->flashdata('successmsg') != ''): ?>
                                <div class="alert alert-success" >
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
                                </div>
                            <?php endif; ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Notification</th>
                                            <th>Date</th>
                                            <th>OrderID</th>
                                            <th>Table Number</th>
                                            <th>Staff</th>
                                            <th>Waiter</th>
                                            <th>Customer</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                     
                        
                            

                            <?php if (empty($notifications_info)): ?>
                                <div class="alert alert-danger">
                                    There are no user accounts to display.
                                </div>
                            <?php endif; ?>
                                        <?php $id_array=array();?>
                                     <?php foreach ($notifications_info as $notify): ?>
                                            
                                        <tr class="">
                                           <!--  <td >
                                                <input type="text" value="<?php echo $notify->log_id;?>" name="id"/>
                                            
                                            </td> -->
                                            <td>
                                            <?php echo $notify->notifications;?>
                                            
                                            </td>
                                            <td>
                                                <?php echo $notify->created_at;?>
                                            </td>
                                            <td>
                                                <?php echo $notify->order_id;?>
                                            </td>
                                            <td>
                                                <?php echo $notify->tablenumber;?>
                                            </td>
                                            <td>
                                                <?php echo $notify->staff;?>
                                            </td>
                                            <td>
                                                <?php echo $notify->waiter;?>
                                            </td>
                                            <td>
                                                <?php echo $notify->customer_unique_id;?>
                                            </td>
                                            
                                            
                                        </tr>
                                       <?php endforeach; ?>
                                        
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


     <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery-1.10.2.js'?>"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap.min.js'?>"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery.metisMenu.js'?>"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/dataTables.bootstrap.js'?>"></script>
    
      
    
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

        <script type="text/javascript">
        $(document).ready(function () {
                $('#dataTables-example').dataTable();
                

            });

        $( "#user" ).change(function() {
            $(location).attr('href'," <?php echo site_url('manager/notificationlist/filter/'); ?>/"+$('#user').val());
        });
        </script>
    </body>
</html>