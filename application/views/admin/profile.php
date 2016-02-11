<div class="row">
  <div class="col-md-4"></div>
<div class="col-md-4">
<?php 
$owner_info=$this->data['owner_info'][0];
?>
<div id="msg_box" class=""></div>
<form action="<?php echo site_url('admin/profile/update');?>" method="post" name="profile_form">
  <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter email" value="<?php echo $owner_info->fname;?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" class="form-control" id="lname" name="lname" placeholder="Password" value="<?php echo $owner_info->lname;?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Username</label>
    <input type="text" class="form-control" id="uname" name="uname" placeholder="Username" value="<?php echo $owner_info->uname;?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="logincode" name="logincode" placeholder="Password" value="<?php echo $owner_info->logincode;?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" id="re_pass_lable">Re Password</label>
    <input type="password" class="form-control" id="re_password" placeholder="Password" value="<?php echo $owner_info->logincode;?>">
  </div>
  <div id="error_box" class="text text-danger">Password Must Match</div>

  
  <button type="button" id="submit_btn" onclick="" class="btn btn-default">Submit</button>
</form>
</div>
</div>

<script>
$(document).ready(function(){
$('#re_password').hide();
$('#error_box').hide();
$('#re_pass_lable').hide();
$('#logincode').focus(function(){

  $('#re_password').show();
  $('#re_pass_lable').show();

});

$('#submit_btn').click(function(){
  if($('#logincode').val()!=$('#re_password').val()){
    $('#error_box').show();
    
  }else{
    $('#error_box').hide();
      var fname=$('#fname').val();
             var lname=$('#lname').val();
             var uname=$('#uname').val();
             var logincode=$('#logincode').val();
             var id=<?php echo $this->session->userdata['userid'];?>;
             url= "<?php echo site_url('admin/profile/update'); ?>",
              postdata ={'id' : id,'fname':fname,'lname':lname,'uname':uname,'logincode':logincode},
             $.post(url,postdata, function(data){
                
                $('#msg_box').html(data);

              });

    
    
  }
});

});
</script>