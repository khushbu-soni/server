<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.stepframemodal.js'; ?>"></script> 

<style type="text/css">
body {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 16px;
  font-size: 1rem;
  line-height: 21px;
  line-height: 1.3125rem;
  color: #222222;
  background-color: #fff;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
}

.header {
  font-size: 150%;
  margin-bottom: 1em;
  padding: .5em;
}

.button {
  display: inline-block;
  padding: 1em 1.5em;
  background-color: #E24813;
  float: left;
  margin-right: 2em;
  text-decoration: none;
  color: white;
}

.button:hover { background-color: #BE4813; }

.popup {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0.8);
  display: none;
  height: 100%;
  left: 0;
  /*opacity: 0;*/
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 999;
  vertical-align: middle;
}

.popup-container {
  display: block;
  margin: 0 auto;
  padding: 24px;
  text-align: center;
  text-align: center;
}

.popup-content {
  padding: 2em;
  background-color: #fff;
  text-align: left;
  display: inline-block;
  position: relative;
  min-width: 50%;
  min-height: 200px;
}

.popup-close {
  background: none repeat scroll 0 0 #fff;
  cursor: pointer;
  display: block;
  font-size: 150%;
  line-height: 1.33333em;
  width: 1.3333em;
  height: 1.3333em;
  line-height: 130%;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
  z-index: 2;
  color: #222222;
}


 .link_button1 {

    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    
    border: solid 1px #20538D;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    background: rgba(255, 255, 255, 0.5);
    color: #FFF;
   padding: 15px 20px 0px 20px;
    text-decoration: none;
    cursor: pointer;
    width: auto;
     height: 30px;
    float: right;
    margin-right: auto;
   
    

}

</style>


<div class="mainheader navbar-fixed-top">
<!-- <div class="tablenumber_kitchen_screen_fix rounded-4px pull-left"
 style="z-index:9;margin-left:85%; float:right; position:fixed; font-size:10px !important; height:10px !important; 
 padding: 5px 10px 10px 10px !important; margin-top: 0px !important; ">
                  
                      <b style="color:black;">Help Requests</b>
                    

</div>
<div class="tablenumber_kitchen_screen_fix rounded-4px pull-left"
 style="z-index:9;margin-left:85%; float:right; position:fixed; font-size:10px !important; height:33px !important; 
 padding: 29px 10px 10px 10px !important; margin-top: 24px !important;">
                  
                      <b style="color:black;">helprequests</b>
                    

</div> -->
  <div class="titlebar">
    <span class="title">Restaurant HOGO</span>
      
  </div>

  <div class="navbar">

    <div class="navbar-inner">
      <div class="">

        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

          <form class="navbar-form pull-left" style="margin-left:16px;">
           
            <a href="<?php echo site_url('waiter/menu/back'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-hand-left icon-white"></i> Back</a>
            
          </form>

          
               <a href="#profile-modal"  onclick="" data-toggle="modal" >
       
        </a>  
        
  
      

        
      </div>
    </div>
  </div>
</div>
