<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			function deleteAccount(event){
				account = $(event.target);
				accountid = account.attr('accountid');
				
				$('#btnDelete').attr('href', "<?php echo site_url('manager/useraccounts/delete'); ?>" + '/' + accountid);
			}
		</script>
	</head>

	<body>
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
				<div class='search-form'>
					<select name='user' id="user">
						<option value="All">Please Select</option>
						<option value="All">All</option>
						<?php foreach ($users_name as $user) {?>
						<option value="<?php echo $user->id;?>"><?php echo $user->fname." ".$user->lname ;?></option>
						<?php }?>

					</select>
				</div>
					<div class="whitebg">
						<div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							User Accounts
							<a href="<?php echo site_url('manager/useraccounts/create'); ?>" class="btn pull-right transition" style="margin-right:14px;">Create Account</a>
						</div>
						<div class="singlecontent padding-10px">
							<?php if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
								</div>
							<?php endif; ?>

							<?php if (empty($useraccounts)): ?>
								<div class="alert alert-danger">
									There are no user accounts to display.
								</div>
							<?php endif; ?>

							<?php foreach ($useraccounts as $useraccount): ?>
								<div class="kitchenorder alert alert-info ">
									<div class="orderitems pull-left" style="">
										<p class="">
											<?php 
												if ($useraccount->role == 0) $role = "Waiter"; else if ($useraccount->role == 1) $role = "Kitchen"; else $role = "Manager";
												echo $useraccount->fname . " " . $useraccount->lname . " ($role)<br/><b>Username:</b> " . $useraccount->uname."<br/><b>Password:</b> " . $useraccount->logincode;
											?>
										</p>
									</div>
									<div class="orderaction pull-right">
										<a href="<?php echo site_url('manager/useraccounts/edit/' . $useraccount->id); ?>" class="btn btn-large transition">Edit</a>
										&nbsp;&nbsp;
										<a href="#confirm-modal" accountid="<?php echo $useraccount->id; ?>" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-large">Delete</a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $deleteconfirm; ?>
		<script type="text/javascript">
		$( "#user" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/useraccounts/filter/'); ?>/"+$('#user').val());
		});
		</script>
	</body>
</html>