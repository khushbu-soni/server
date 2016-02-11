<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
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

       
           <!-- /. NAV TOP  -->
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <div id="info">
        <div class="row">
						<div class="boxheading toprounded-4px">
							Drink Refill Requests
						</div>
						<div class="singlecontent padding-10px">
							<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#pending" data-toggle="tab">Pending</a></li>
									<li><a href="#accepted" data-toggle="tab">Accepted</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-content">
										<div class="tab-pane active" id="pending">
											<?php if (empty($unacceptedrefills)): ?>
												<div class="alert alert-danger">
													There are no pending drink refill requests at this time.
												</div>
											<?php endif; ?>
											<?php foreach ($unacceptedrefills as $unaccepted): ?>
												<div class="kitchenorder pending">
													<div class="ordereditems pull-left" style="">
														<div class="tablenumber rounded-4px pull-left">
															<?php echo $unaccepted->tablenumber; ?>
														</div>
														<p><b>Table <?php echo $unaccepted->tablenumber; ?></b> requested a drink refill.<br/>
															<b>Drink Type:</b> <?php echo $unaccepted->getDrinkType()->name; ?></p>
													</div>
													<div class="orderaction pull-right">
														<a href="#" requestid="<?php echo $unaccepted->id; ?>" onclick="acceptRequest(event)" class="btn btn-large"><i class="icon-eye-open"></i> Accept</a>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
										<div class="tab-pane" id="accepted">
											<?php if (empty($acceptedrefills)): ?>
												<div class="alert alert-danger">
													There are no unresolved drink refill requests at this time.
												</div>
											<?php endif; ?>
											<?php foreach ($acceptedrefills as $accepted): ?>
												<div class="kitchenorder pending">
													<div class="ordereditems pull-left" style="">
														<div class="tablenumber rounded-4px pull-left">
															<?php echo $accepted->tablenumber; ?>
														</div>
														<p><b>Table <?php echo $accepted->tablenumber; ?></b> requested a drink refill.<br/>
															<b>Drink Type:</b> <?php echo $accepted->getDrinkType()->name; ?></p>
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