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
			
		</style>
	</head>

	<body >
		
	    <div id="wrapper">
	    <?php echo $header;?>
	    <?php echo $sidebar;?>


	    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 rounded-6px" style='width: 100%;overflow-x: scroll;'>
				<div class="panel panel-default">
					<button type="button"  class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add More Items</button>
          <a type="button" target='_blank'  class="btn btn-info btn-lg"  href="<?php echo site_url('manager/dashboard/dashboard_kot_update/' . $order_id); ?>" >Print Kot</a>
					<table class="table" style="width:1198px; overflow:hidden;">
            
  <thead>
    <tr>
      <th>Include in KOT</th>
      <th>Item No</th>
      <th>Item Name</th>
      <th>Qty</th>
      <th>Note</th>
      <!-- <th>Edit</th> -->
      <th>Remove</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  $exlude_style='display:block';
	$include_style='display:block';
foreach ($orderitems as $value) {
	# code...
  
  if($value['isInKotPrint']){
      $exlude_style='display:none';
      $include_style='display:block';
    
  }
    else{
       $exlude_style='display:block';
      $include_style='display:none';
    
    }
  	 ?>
    <tr class='main_tr'>
      <th >
        <input type='button' value="+ " class='btn btn-success include' id='include_<?php echo $value['id'];?>' 
        style='<?php echo $include_style; ?>'  onclick="remove_from_kot('<?php echo $value['id'];?>')"/>
        <input type='button' value="-" style='<?php echo $exlude_style; ?>'  class=' btn btn-warning exclude' id='exclude_<?php echo $value['id'];?>'  onclick="add_in_kot('<?php echo $value['id'];?>')"/>

      </th>
      <th scope="row"><input type='text' name='item_no' id='item_no' value='<?php echo $value['item_no'];?>' readonly/></th>
      <td><input type='text' name='item_name' id='item_name' value='<?php echo $value['name'];?>' readonly/></td>
      <td><input type='text' name='qty' id='qty_<?php echo $value['id'];?>' value='<?php echo $value['quantity'];?>' onblur="updateQty('<?php echo $value['id'];?>')"/></td>
      <td><input type='text' name='note' id='notes_<?php echo $value['id'];?>' value='<?php echo $value['notes'];?>' onblur="updateNotes('<?php echo $value['id'];?>')"/></td>
     <!--  <td><button class='btn btn-info' data-toggle="modal" data-target="#myModal" onclick="edit(<?php echo $value['orderid'];?>,<?php echo $value['id'];?>)">Edit</button></td> -->
      
      <td class='btn btn-danger' onclick="deleteItem('<?php echo $value['id'];?>','<?php echo $order_id;?>')">Delete</td>
    </tr>
    <?php }?>
  </tbody>
</table>
				</div>
		</div>
		</div>
		</div>
		</div>
		</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Place Order</h4>
      </div>
      <link rel="stylesheet" href="<?php echo base_url() . 'assets/autocomplete/fm.selectator.jquery.css';?>"/>
  <style>
      
    #select4 {
      width: 350px;
      height: 36px;
      margin-bottom: 9px !important; 
    }

     #selectator_select4 {
      margin-bottom: 9px !important; 
    }

     #selectator_select5 {
      margin-bottom: 10px;
      margin-left: 9px; 
    }

     #selectator_select6 {
      margin-left: 13px; 
    }

        #select5 {
      width: 350px;
      height: 36px;
    }   

    #select6 {
      width: 350px;
      height: 36px;
    }   
      #el {
      width: 350px;
      height: 36px;
      border: 1px solid #D0D1D4;
box-sizing: border-box;
background-color: #FFF;
display: inline-block;
text-decoration: none;
    }  
     .select8 {
      border: 1px solid #D0D1D4;
box-sizing: border-box;
background-color: #FFF;
display: inline-block;
text-decoration: none;
      width: 300px;
      height: 36px;
    }   
      
      
  </style>
  
      <div class="modal-body">
        <label for="select4">
      Biryani House Menu Item:
    </label>
  
    <select id="select4" name="select4" multiple required>
      <optgroup label="" class="group_one">
        <?php foreach ($this->data['biryani_menuitems'] as $biryani_menuitems) {?>
          
        <option value="<?php echo $biryani_menuitems['item_no'];?>" class="option_one" data-subtitle="<?php echo $biryani_menuitems['name'];?>" ><?php echo $biryani_menuitems['item_no'];?></option>
        <?php }?>
        <?php if(empty($this->data['biryani_menuitems'])) {    ?>
       
        <option value="" class="option_one" data-subtitle="No Items Available" >No Items Available</option>
        <?php }?>
      </optgroup>
      
    </select>
    <input style="display:none;" value="activate selectator" id="activate_selectator4" type="button">

     <label for="select5">
      Cafe One Six Menu Item:
    </label>

    <select id="select5" name="select5" multiple required>
      <optgroup label="" class="group_one">
      <?php if(!empty($this->data['cafe_menuitems'])) {    ?>
        <?php foreach ($this->data['cafe_menuitems'] as $cafe_menuitems) {?>
          
        <option value="<?php echo $cafe_menuitems['item_no'];?>" class="option_one" data-subtitle="<?php echo $cafe_menuitems['name'];?>" ><?php echo $cafe_menuitems['item_no'];?></option>
        <?php }?>
        <?php }?>

        <?php if(empty($this->data['cafe_menuitems'])) {    ?>
       
        <option value="" class="option_one" data-subtitle="No Items Available" >No Items Available</option>
        <?php }?>
      </optgroup>
      
    </select>
    <input style="display:none;" value="activate selectator" id="activate_selectator5" type="button">
      <!-- Button trigger modal -->

<label for="select6">
      BAR Menu Item:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </label>

    <select id="select6" name="select6" multiple required>
      <optgroup label="" class="group_one">
        <?php if(!empty($this->data['bar_menuitems'])) {?>
        <?php foreach ($this->data['bar_menuitems'] as $bar_menuitems) {?>
          
        <option value="<?php echo $bar_menuitems['item_no'];?>" class="option_one" data-subtitle="<?php echo $bar_menuitems['name'];?>" ><?php echo $bar_menuitems['item_no'];?></option>
        <?php }?>
        <?php }?>
        <?php if(empty($this->data['bar_menuitems'])) {    ?>
       
        <option value="" class="option_one" data-subtitle="No Items Available" >No Items Available</option>
        <?php }?>
      </optgroup>
      
    </select>
    <input style="display:none;" value="activate selectator" id="activate_selectator6" type="button">

<!--     <div class="form-group">
    <label for="qty">Qty:</label>
    <input type="number" class="form-control" id="qty_update">
  </div>
  <div class="form-group">
    <label for="notes">Notes:</label>
    <input type="text" class="form-control" id="notes_update">
  </div> -->

<button type="submit"  id="add" onclick='add(<?php echo $order_id;?>)' class="btn btn-primary btn-sm" data-toggle="modal" data-dismiss="modal" data-target="#myModal4">
  Add
</button>


<p id="msg" style="color:red; text-align:center">Please Provide Item No.</p>
<input type="hidden" value="" id="select_order" />
<input type="hidden" value="" id="order_add_type" />

<!-- Modal -->

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>

<!--  -->

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
 <script type="text/javascript" src="<?php echo base_url() . 'assets/autocomplete/jquery-1.11.0.min.js'; ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/autocomplete/fm.selectator.jquery.js'; ?>"></script>
    <script type="text/javascript">

      // $('.include').hide();
      $(function () {
      

      var $activate_selectator4 = $('#activate_selectator4');
      $activate_selectator4.click(function () {
        var $select4 = $('#select4');
        if ($select4.data('selectator') === undefined) {
          $select4.selectator({
            showAllOptionsOnFocus: true
          });
          // $activate_selectator4.val('destroy selectator');
        } else {
          $select4.selectator('destroy');
          $activate_selectator4.val('activate selectator');
        }
      });
      $activate_selectator4.trigger('click');

    });


      $(function () {
      

      var $activate_selectator5 = $('#activate_selectator5');
      $activate_selectator5.click(function () {
        var $select5 = $('#select5');
        if ($select5.data('selectator') === undefined) {
          $select5.selectator({
            showAllOptionsOnFocus: true
          });
          // $activate_selectator4.val('destroy selectator');
        } else {
          $select5.selectator('destroy');
          $activate_selectator5.val('activate selectator');
        }
      });
      $activate_selectator5.trigger('click');

    });
      

        $(function () {
      

      var $activate_selectator6 = $('#activate_selectator6');
      $activate_selectator6.click(function () {
        var $select6 = $('#select6');
        if ($select6.data('selectator') === undefined) {
          $select6.selectator({
            showAllOptionsOnFocus: true
          });
          // $activate_selectator4.val('destroy selectator');
        } else {
          $select6.selectator('destroy');
          $activate_selectator6.val('activate selectator');
        }
      });
      $activate_selectator6.trigger('click');

    });
		
      	$(document).ready(function () {
      		 $('#msg').hide();
            $('#customer_msg').hide();
            $('#mobile_msg').hide();
            $('#table_msg').hide();
            $('#waiter_msg').hide();
            $('#itemlist').hide();
            $('#table_order_block').hide();
            $('#common_block').hide();
            $('#take_away_block').hide();
            $('#order_placed_msg').hide();
            $('#waiter_msg').hide();
            $('#table_order').val(" ");
            $('#placeorder').hide();
            $('#kot').hide();
            $('#take_away').show();
            $('#table_order').show();
           
                // $('#dataTables-example').dataTable();
            });

		$( "#user" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/useraccounts/filter/'); ?>/"+$('#user').val());
		});
		$( "#role" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/useraccounts/filter_by_role/'); ?>/"+$('#role').val());
		});



function add(orderid){
	
	if($('#select4').val() || $('#select5').val() || $('#select6').val()){
      if($('#select4').val()){
        var item_list_brirayni=$('#select4').val();
      }
      else{
        var item_list_brirayni='';
      }
      if($('#select5').val()){
        var item_list_cafe_one_six=$('#select5').val();
      }
      else{
        var item_list_cafe_one_six='';
      }
      if($('#select6').val()){
        var item_list_bar=$('#select6').val();
      }
      else{
        var item_list_bar='';
        }
        var itemes=item_list_cafe_one_six.concat(item_list_brirayni);

       

        var item_list=item_list_bar.concat(itemes);

      // $('#itemlist').val(item_list);
      // var item=$('#itemlist').val();

      var order=$('#select_order').val();
      var qty=$('#qty_update').val();
      var notes=$('#notes_update').val();



			$.ajax({
               type:'GET',
               url: "<?php echo site_url('update/order'); ?>",
	           data:{order:orderid,item:item_list},
         
      			success: function(result){
                // $('#table_dropdown').html(result);
                // $('#table_msg').hide();

                window.location.href='<?php echo site_url('update'); ?>?id='+orderid;
               }
               })
		}

	}

  function deleteItem(id,orderid){

    $.ajax({
               type:'GET',
               url: "<?php echo site_url('update/delete'); ?>",
             data:{id:id},
         
            success: function(result){
                // $('#table_dropdown').html(result);
                // $('#table_msg').hide();
                // $('#qty_msg'+id).show();
                window.location.href='<?php echo site_url('update'); ?>?id='+orderid;
               }
               })
  }

  function updateQty(id){
        var qty=$('#qty_'+id).val();
       
            $.ajax({
               type:'GET',
               url: "<?php echo site_url('update/qty'); ?>",
             data:{qty:qty,id:id},
         
            success: function(result){
                // $('#table_dropdown').html(result);
                // $('#table_msg').hide();
                // $('#qty_msg'+id).show();
                // window.location.href='<?php echo site_url('update'); ?>?id='+orderid;
               }
               })
  }


  function add_in_kot(id){

    $.ajax({
               type:'GET',
               url: "<?php echo site_url('update/add_in_kot_print'); ?>",
             data:{id:id},
         
            success: function(result){
              if(result){
                  $('#include_'+id).show()
                  $('#exclude_'+id).hide()
                
              }
                // $('#table_dropdown').html(result);
                // $('#table_msg').hide();
                // $('#qty_msg'+id).show();
                // window.location.href='<?php echo site_url('update'); ?>?id='+orderid;
               }
               })

    // alert(qty);
    // var exsiting_qty=$('#kot_qty').val();
    // var exsiting_item_name=$('#kot_name').val();
    // if(exsiting_qty!=null)
    //   $('#kot_qty').val(exsiting_qty+','+qty);
    // if(exsiting_item_name!=null)
    //   $('#kot_name').val(exsiting_item_name+','+name);
  
  }

  function remove_from_kot(id){

      $.ajax({
               type:'GET',
               url: "<?php echo site_url('update/remove_from_kot_print'); ?>",
             data:{id:id},
         
            success: function(result){
              if(result){
                  $('#include_'+id).hide()
                  $('#exclude_'+id).show()
                
              }
              
               }
               })
  }

  function updateNotes(id){
        var notes=$('#notes_'+id).val();
       
            $.ajax({
               type:'GET',
               url: "<?php echo site_url('update/notes'); ?>",
             data:{notes:notes,id:id},
         
            success: function(result){
                // $('#table_dropdown').html(result);
                // $('#table_msg').hide();
                // $('#qty_msg'+id).show();
                // window.location.href='<?php echo site_url('update'); ?>?id='+orderid;
               }
               })
  }


		</script>
	</body>
</html>