 <script type="text/javascript">

 $(document).ready(function(){

 $('#swip_info').hide();

 $('#card').click(function(){

 	$('#swip_info').toggle();
 	 document.getElementById('swiped').focus();
 });

 $('#cash').click(function(){
 	$('#swip_info').hide();
 });
 });
 </script>
 <div class="panel panel-default box" >
<div class="panel-heading">

</div>
<div class="panel-body text-center">
<!-- Button trigger modal -->
<button type="button" id="cash" class="btn btn-warning " data-toggle="modal" data-target="#myModal">
  Cash
</button>

<button type="button" class="btn btn-danger "  id="card">
  Make Payment
</button>


<div id="swip_info">
	
	 <table>
                          <tr>
                         <div>
                         <div class='fields1'>Swiped Information</div>
                           <input type=text name='swiped' id='swiped'>
                         </div>
                         
                         <div class='fields'>Full Name</div>
                         <div>
                          <input type='text' name='full_name' id='full_name'><span style='required'>*</span>
                         </div>
                         <div class='fields'>Expiration</div>
                         <div>
                          <input type='text' size='8' name='expiry' id='expiry'><span style='required'>*</span>(MM/YY)
                         </div>
                         
                         <div class='fields'>Credit Card Number</div>
                         <div>
                          <input type='text' name='card_no' id='card_no'><span style='required'>*</span>
                         </div>
                         <hr>
                         <div class='buttons'></div>
                         <div>
                          <a class="btn btn-info" onclick="readCard();" style="cursor:pointer; color:red;">Swipe Credit Card</a>
                         </div>

                        </tr>
                        </table>
</div>
<!-- Modal -->

</div>
