<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			function acceptRequest(event){
				request = $(event.target);
				requestid = request.attr('requestid');

				if (!request.hasClass('disabled')){
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('waiter/helprequests/accept'); ?>",
						data: "id=" + requestid,
						success: function(data, textStatus){
							request.addClass('disabled');
							request.html("Accepted");
							request.parent().parent().removeClass('pending');
						}
					});
				}
			}



			function resolveRequest(event){
				request = $(event.target);
				requestid = request.attr('requestid');

				if (!request.hasClass('disabled')){
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('waiter/helprequests/resolve'); ?>",
						data: "id=" + requestid,
						success: function(data, textStatus){
							request.addClass('disabled');
							request.html("Resolved");
							request.parent().parent().removeClass('pending');
						}
					});
				}
			}
		</script>

		<script type="text/javascript">
   setInterval("accepted();",3000);
    
    		function accepted(){

    	//alert(x);
    	
       	 $('#accepted').load(location.href + ' #accepted');
       
}

 setInterval("pending();",3000);
    
    		function pending(){

    	//alert(x);
    	
       	 $('#pending').load(location.href + ' #pending');
       
}
       

   function a_a(){
				
				//remove the active class from all the list items
				$('.nav li a').each(function(index){
					$("#a_a").removeClass('active');
					$("#a_p").addClass('active');
				});
			
				
				

			}

			 function a_p(){
				
				//remove the active class from all the list items
				$('.nav li a').each(function(index){
					$("#a_a").removeClass('active');
					$("#a_p").addClass('active');
				});
			
				
				

			}

</script>

 <style type="text/css">
            .pagination > li {
              display: inline;
              float: right !important;
            }
            .img-thumbnail{
                width: 75px;
                height: 75px;

               }
               #dialog{
                display: none;
               }
               .ui-dialog{
                  
                  width: 50% !important;
                  height: 315px !important;
                  /*left: 309px !important;*/
               }
               nav{
                margin-top: 25px !important;
                /*margin-bottom: -43px !important;*/
                
               }
               hr {
                  -moz-border-bottom-colors: none;
                  -moz-border-left-colors: none;
                  -moz-border-right-colors: none;
                  -moz-border-top-colors: none;
                  border-color: #eee -moz-use-text-color -moz-use-text-color;
                  border-image: none;
                  border-right: 0 none;
                  border-style: solid none none;
                  border-width: 1px 0 0;
                  margin-bottom: 10px;
                  margin-top: 0;
              }

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
						<div class="boxheading toprounded-4px">
							Help Requests
						</div>
						<div class="singlecontent padding-10px">
							<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active" ><a  id="a_p" onclick="ap()" class="active btn btn-info" href="#pending" data-toggle="tab">Pending</a></li>
									<li><a id="a_a" onclick="aa()" class="active btn btn-success" href="#accepted" data-toggle="tab">Accepted</a></li>
								</ul>
								<div class="tab-content" style="max-height:620px; overflow-y: scroll;">
									<div class="tab-content">
										<div class="tab-pane active"  id="pending">
											<?php if (empty($unacceptedrequests)): ?>
												<div class="alert alert-danger">
													There are no pending help requests at this time.
												</div>
											<?php endif; ?>
											<?php foreach ($unacceptedrequests as $unaccepted): ?>
												<div class="kitchenorder pending">
													<div class="ordereditems pull-left" style="">
														<div class="tablenumber rounded-4px pull-left" style="width:auto;">
															<?php echo $unaccepted->tablenumber; ?>
														</div>
														<p><b>Table <?php echo $unaccepted->tablenumber; ?></b> needs attention.</p>
													</div>
													<div class="orderaction pull-right">
														<a href="#" onclick="acceptRequest(event)" requestid="<?php echo $unaccepted->id; ?>" class="btn btn-success"><i class="icon-eye-open"></i> Accept</a>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
										<div class="tab-pane " id="accepted">
											<?php if (empty($acceptedrequests)): ?>
												<div class="alert alert-danger">
													There are no unresolved requests at this time.
												</div>
											<?php endif; ?>
											<?php foreach ($acceptedrequests as $accepted): ?>
												<div class="kitchenorder pending">
													<div class="ordereditems pull-left" style="">
														<div class="tablenumber rounded-4px pull-left">
															<?php echo $accepted->tablenumber; ?>
														</div>
														<p><b>Table <?php echo $accepted->tablenumber; ?></b> needs attention.</p>
													</div>
													<div class="orderaction pull-right">
														<a href="#" requestid="<?php echo $accepted->id; ?>" onclick="resolveRequest(event)" class="btn btn-large"><i class="icon-ok"></i> Resolved</a>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br />
	</body>
</html>