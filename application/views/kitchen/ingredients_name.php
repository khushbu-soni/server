<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Biryani House</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-responsive.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/general.js'; ?>"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<style type="text/css">

		.result_show
{
 position:absolute;
 width:218px;
 max-height: 200px;
 z-index: 1;
 background-color: white;
 overflow: scroll;
}
.form-horizontal input{
	height: 30px !important;
}
</style>
		<script type="text/javascript">



		function processForm() {
			//get form variables
			
			var thepercentage = form1.min_limit.options[form1.min_limit.selectedIndex].value;
			var quantity = document.getElementById( "quantity" ).value;
			var countper = document.getElementById( "countpercent" );
			
			//Calculate Percent
			percentage = (thepercentage * quantity) / 100;	
			countper.value =  Math.round(percentage);
			
			document.getElementById('countpercent').setAttribute('value',Math.round(percentage));
			document.getElementById('countpercent2').setAttribute('value',Math.round(percentage));
		     
			
			}


function search_func()
{
		var val=document.getElementById('Ingredients').value;
	//alert(val);
            $.ajax({
              type: "POST",
			url: "<?php echo site_url('kitchen/ingredients/get_available_ingredients'); ?>",
               data: "search_key=" + val,
               success: function(data){
               			document.getElementById("search").style.display = "block";
               			//$('#search').style.display = "block";
                        $('#search').html(data);
                           //Receiving the result of search here
               }
            });
}
function hide()
{
		
       document.getElementById("search").style.display = "none";
               			
             
            
}
			$(document).ready(function(){

				$('#countpercent').on('keydown',function(e){
    var deleteKeyCode = 8;
    var backspaceKeyCode = 46;
    if ((e.which>=48 && e.which<=57) ||
         (e.which>=96 && e.which<=105)  || // for num pad numeric keys
         e.which === deleteKeyCode || // for delete key,
             e.which === backspaceKeyCode) // for backspace
         // you can add code for left,right arrow keys
    {
        $(this).removeClass('error');
        return true;
    }
    else
    {
        $(this).addClass('error');
        return false;
    }
});

				$('#tablesetupform').validationEngine();	


		
			});

			
		</script>
		<?php echo $dependencies; ?>
	</head>
	<body>
	<?php 
if(isset($ing_info) && !empty($ing_info)){
	 foreach ($ing_info as $ing) {
	$id = $ing->id; 	
$name = $ing->name;
$quantity = $ing->quantity;
$min_ingr = $ing->min_ingr;
$ing_type = $ing->ing_type;

}
}else{
$name = set_value('name');
$quantity = set_value('quantity');
$id = set_value('id');
$min_ingr = set_value('min_ingr');
$ing_type = set_value('ing_type');
}
	?>
		
		<div id="wrapper">
			<?php echo $header;?>
		    <?php echo $sidebar;?>
		    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <?php 	if ($this->session->flashdata('errormsg') != ''): ?>
								<div class="alert" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('errormsg'); ?></h4>
								</div>
							<?php endif; ?>
                    <div class="col-md-12 rounded-6px">
				<div class="panel panel-default">
                        <div class="panel-heading">
                             Add Menu Type
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                       			
                            	<form class="form-horizontal" id="tablesetupform" name="form1" method="post"
                            	 action="<?php echo site_url('kitchen/ingredients/addIngName'); ?>">
						<div class="control-group">
						<input type="hidden" id="id" value="<?php echo $id; ?>" class="" name="id" />

							<label class="control-label" for="tabletnumber">Ingredients</label>
							<div class="controls">
							 <input type="text" onblur="hide()" autocomplete="off" 	onkeyup="search_func()" value="<?php echo $name; ?>" id="Ingredients" class="validate[required]" name="name" /> 
							</div>
							
						<div class="controls">	
					<div id="search" style="display: none;" class="result_show">
						<b>Available</b>

					</div>

					</div>
							
					
						
						<br/>
					<label class="control-label" for="tabletnumber"  >Minimum Limits</label>
					<div class="controls">
					<input type="text" onclick="" value="<?php echo $min_ingr; ?>" id="countpercent" class="validate[required]" name="min_ingr"/>
					<!--<input type="text"   value="<?php echo $min_ingr; ?>" class="validate[required]"  />-->
					</div>
							<br>
							<label class="control-label" for="tabletnumber">Type</label>
					<div class="controls">
					   <select style="background-color: #ffffa0" name="ing_type" required>
      <option>Select Type</option>
      
      <option value="nou">Number of Unit</option>
      <option value="kg">KG</option>
      <option value="grm">Gram</option>
   </select>	
   </div>

						</div>
						<div class="form-actions nobottomspace" style="padding-left:0;text-align:center;background-color:inherit;border-color:#99A2B6">
							<a onclick="$('#tablesetupform').submit()" class="btn btn-info"><i class="icon-ok"></i> Save</a>
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url('kitchen/ingredients'); ?>" class="btn btn-danger transition"><i class="icon-remove"></i> Cancel</a>
						</div>
					</form>

                            </div>
                            
                        </div>

                    </div>
		</div>
		</div>
		</div>
		</div>
		</div>
	</body>

</html>