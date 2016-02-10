<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>

<script type="text/javascript">
$(document).ready(function(){


    $.ajax({
        url:"<?php echo site_url('manager/sidebar/sidebarMENU'); ?>",
        type:"POST",
        success:function(data){
            $(".nav").html(data)
           
            }
    });

        $.ajax({
        url:"<?php echo site_url('manager/sidebar/sidebarMENURESPONS'); ?>",
        type:"POST",
        success:function(data){
            $(".list-box").html(data)
           
            }
    });
 
    $('li').click(function(){
        $(this).addClass('menu');
    });
   
});
</script>
<style type="text/css">
        
.navbar-side {
    padding-top: 24px !important;
    position: absolute;
    width: 260px;
    z-index: 1;
}
.menu{
color:red !important;

}
</style>
<div class="hidden-sm hidden-xs">
<nav class="navbar-default navbar-side navbar-transparent" role="navigation" style="padding-top: 24px;">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center"></li>

                
            </ul>
            </div>
           
        </nav> 
        </div>

<div class="hidden-lg hidden-md">
        <br/><br/><br/><br/><br/><br/>
        <div class="list-box">
           
        </div>
        <br/>
</div>

