<!DOCTYPE html>
<html>
    <head>
        <title>Biryani House.</title>
        <?php echo $dependencies; ?>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
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
        
        // $(document).ready(function(){
        //       $("#status").click(function(){
        //         var id=$.(this).attr(data);

        //        alert(id);
        //       });
        //     });
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
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Notification</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                     
                        
                            

                            <?php if (empty($notifications_info)): ?>
                                <div class="alert alert-danger">
                                    There are no user accounts to display.
                                </div>
                            <?php endif; ?>
                                     <?php foreach ($notifications_info as $notify): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                            <?php echo $notify->notification;?>
                                            
                                            </td>
                                            <td>
                                            <?php 
                                            $class="btn btn-info";
                                            $status="Active";
                                            if(!$notify->is_active){
                                                $class="btn btn-danger";
                                                $status="DeActive";
                                            }
                                            ?>
                                                <a href="<?php echo site_url('manager/notification_list/status/' . $notify->id); ?>" >
                                                <button  id="status" class="<?php echo $class;?>" data="<?php echo $notify->id;?>">
                                                <?php echo $status;?>
                                                </button>
                                                </a>
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
            $(location).attr('href'," <?php echo site_url('manager/useraccounts/filter/'); ?>/"+$('#user').val());
        });
        </script>
    </body>
</html>