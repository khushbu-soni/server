<?php if (empty($filter_trash_info)): ?>
							<tr class="alert alert-danger">
								<td colspan="3">
									There are no Records to display.
								</td>
								</tr>
							<?php endif; ?>
<tr id="spin">
<td colspan="4">
    <div class="text-center">
      <i class="fa fa-spinner fa-pulse icon-spin fa-3x"></i>
    </div>
</td>
</tr>
<?php 
if(!empty($filter_trash_info)){
foreach ($filter_trash_info as $st): ?>

                                        <tr class="odd gradeX" attr="<?php echo $st['id'];?>">

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
                                            <button class="btn btn-md btn-info" id="single_record" attr="<?php echo $st['id'];?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                                Delete
                                            </button>
                                            </td>
                                            
                                        </tr>
                                       <?php endforeach; ?>
                                        
                                       <?php } ?>
<script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap-growl.js'?>"></script>
<script>
$(document).ready(function(){

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

                            $('#filer_inward_table').html(data);
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
    });


    

</script>