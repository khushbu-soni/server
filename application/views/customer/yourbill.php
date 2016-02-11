<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to Restaurant</title>
    <?php echo $dependencies; ?>
   <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
    <link rel="stylesheet"  href="<?php echo base_url() . 'assets/css/rating.css'; ?>" type="text/css"/>
    <script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.js'; ?>" type="text/javascript" charset="utf-8"></script>
     <script src="<?php echo base_url() . 'assets/js/rating.js'; ?>" type="text/javascript" charset="utf-8"></script>
     <style type="text/css">
      .ratings_stars {
            background: url("<?php echo base_url().'assets/img/star_blank.png'; ?>") no-repeat;
            float:      left;
            height:     28px;
            padding:    2px;
            width:      32px;
        }
.ratings_vote {
            background: url("<?php echo base_url().'assets/img/star_voted.png'; ?>") no-repeat;
        }
.ratings_over {
            background: url("<?php echo base_url().'assets/img/latest.png'; ?>") no-repeat;
        }


            .comments { width: 300px; height: 18px }

            .link_button {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: solid 1px #20538D;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    background: #4479BA;
    color: #FFF;
    padding: 8px 10px;
    text-decoration: none;
    cursor: pointer;
}
   
     </style>

    <script type="text/javascript">

    //rating start js

     $(document).ready(function() {

 
     /*  var id=$('.ratings_stars').parent().attr("id");
     
      var menuid=$('.ratings_stars').parent().attr("menuid");
       var orderid=$('.ratings_stars').parent().attr("orderid");
          var num=$('.ratings_stars').attr("class");
             var numrow=$('.ratings_stars').parent().attr("numrow");
                
          //var res = num.split("_");
         // var res = num.substr(5, 1);

         // var cls = id.substr(0, 7);
          

       
      $.ajax({
          type: "POST",
          url: "<?php echo site_url('customer/yourbill/getrate'); ?>",
          data: "menuid="+menuid+"&orderid="+orderid+"&id="+id,
          success: function(data, textstatus){
          
                  document.getElementById(id).innerHTML=data;
          
                      
        
     }
  

        });
*/


 $('.ratings_stars').hover(

            // Handles the mouseover

            function() {

                $(this).prevAll().andSelf().addClass('ratings_over');
               

            },

            // Handles the mouseout

            function() {

                $(this).prevAll().andSelf().removeClass('ratings_over');

            }

        );
//send ajax request to rate.php
        $('.ratings_stars').bind('click', function() {

          var id=$(this).parent().attr("id");
      
      var menuid=$(this).parent().attr("menuid");
       var orderid=$(this).parent().attr("orderid");
          var num=$(this).attr("class");
         
          //var res = num.split("_");
          var res = num.substr(5, 1);
          

       
      $.ajax({
          type: "POST",
          url: "<?php echo site_url('customer/yourbill/rate'); ?>",
          data: "menuid="+menuid+"&orderid="+orderid+"&rate="+res,
          success: function(data, textstatus){
            document.getElementById(id).innerHTML=data;
        
     }
   });  
    });

 
        });



     //rating end js
      $(document).ready(function(){
       
      //  $('#paymentform').validationEngine();

        itemsPaidFor = "";

        taxRate = 0.08;
        totalPrice = <?php echo $values->total; ?>;
        taxAmount = <?php echo $values->tax; ?>;
        subTotal = <?php echo $values->subtotal; ?>;

        $('.itemordered').each(function(index){
          if ($(this).attr('checked')){
            if (itemsPaidFor == ""){
              itemsPaidFor = itemsPaidFor + $(this).attr('orderid');
            } else { 
              itemsPaidFor = itemsPaidFor + "," + $(this).attr('orderid');
            }
          }
        });

        $('.itemordered').click(function(e){
          itemsPaidFor = "";
          subTotal = 0.00;
          totalPrice = 0.00;
          taxAmount = 0.00;

          //set the coupon used flag back to zero since all coupons redeemed would be reset
          $('input[name=couponused').val('0');
          //remove any alerts about coupon codes
          $('#invalidcode').hide();
          $('#codesuccess').hide();
          
          $('.itemordered').each(function(index){
            if ($(this).attr('checked')){
              if (itemsPaidFor == ""){
                itemsPaidFor = itemsPaidFor + $(this).attr('orderid');
                subTotal = subTotal + parseFloat($(this).attr('price'));
              } else { 
                itemsPaidFor = itemsPaidFor + "," + $(this).attr('orderid');
                subTotal = subTotal + parseFloat($(this).attr('price'));
              }
            }
          });
          //alert(itemsPaidFor);
          $('input[name=ordereditems]').val(itemsPaidFor);
          //alert($('input[name=ordereditems]').val());

          taxAmount = (taxRate * subTotal).toFixed(2);
          totalPrice = (totalPrice + subTotal).toFixed(2);
          subTotal = subTotal.toFixed(2);

          //update subtotal
          $('#subtotalamount').html(subTotal);

          //update taxamount
          $('#taxamount').html(taxAmount);
          $('input[name=tax]').val(taxAmount);

          //update total
          $('input[name=total]').val(totalPrice);
          $('#totalamount').html(totalPrice);
        });
      });

      function redeemCode()
      {
        code = $('input[name=couponcode]').val();
        if (code == '')
          return;

        $.ajax({
          type: "POST",
          url: "<?php echo site_url('customer/payment/redeemcode'); ?>",
          data: "code=" + code,
          success: function(data, textstatus){
            if (data == '1'){
              //coupon code is valid
              $('#invalidcode').hide();
              $('#codesuccess').slideDown('fast');

              subTotal = subTotal * 0.9;
              subTotal = subTotal.toFixed(2);

              taxAmount = parseFloat(subTotal) * taxRate
              taxAmount = taxAmount.toFixed(2);

              totalPrice = parseFloat(subTotal) + parseFloat(taxAmount);
              totalprice = totalPrice.toFixed(2);

              //update values in DOM

              //update subtotal
              $('#subtotalamount').html(subTotal);

              //update taxamount
              $('#taxamount').html(taxAmount);
              $('input[name=tax]').val(taxAmount);

              //update total
              $('input[name=total]').val(totalPrice);
              $('#totalamount').html(totalPrice);

              //set the coupon used flag to 1
              $('input[name=couponused]').val('1');
            } else {
              //coupon code is invalid
              $('#codesuccess').hide(); 
              $('#invalidcode').slideDown('fast');
            }
          }
        });
      }



   
    </script>
  </head>

  <body >
    <?php echo $menuheader; ?>
    <?php $img_path = $this->config->item('img_path'); ?>
    <div class="container-fluid" style="margin-top:120px; padding: 5px 350px;">
      <div class="row-fluid">
        <div class="outer-frame rounded-6px">
          <div class="rounded-4px paymentorder"   >
            <div class="boxheading toprounded-4px">
           <!--  <pre> <?php print_r($this->session->all_userdata()); print_r($unpaid_items);?></pre> -->
              Your Order
            </div>
            <div class="paymentordercontent" style="max-height:600px; overflow-y: scroll;">
              
              <?php  $sum = 0;   $i=1;?>
              <?php $size = sizeof($unpaid_items);?>
              <?php foreach ($unpaid_items as $unpaid_item): ?>
                <form method="post" action="<?php echo site_url('customer/yourbill/comment_insert').'/'.$unpaid_item->menuid.'/'. $unpaid_item->orderid?>">
                <div class="ordereditem">
                  <img alt="<?php echo $unpaid_item->name;?>" src="<?php echo  $img_path . $unpaid_item->picturepath?>" class='menuimg pull-left img-polaroid'  />
                  <div  class="ordered pull-left" style=""><?php echo $unpaid_item->name; ?></div><br/>
                 $<?php echo $unpaid_item->ogprice; ?> x  <?php echo $unpaid_item->quantity; ?>
                  =<b> $<?php echo $unpaid_item->price; ?></b>
                  
                  

                  <?php if($unpaid_item->comment_status == 1) { ?>

                  <div id="comment-div <?php echo $unpaid_item->menuid;?>">

                    <?php echo "<textarea class=comments readonly>".$unpaid_item->comment."</textarea>
                    </div>";

                    ?>

                      

                  <?php }
                    else{?>
                  <br/><br/>
                  <div class="cmt-div" id="comment-div <?php echo $unpaid_item->menuid;?>">
                  <textarea  required class="comments input-xlarge validate[required, custom[onlyNumberSp]], maxSize[4], minSize[4]" name="comment" id="comment" placeholder="Comments"><?php echo $unpaid_item->comment; ?></textarea>
                  <!-- <a class="link_button" menuid="<?php echo $unpaid_item->menuid;?>" orderid="<?php echo $unpaid_item->orderid;?>" orderitemid="<?php echo $unpaid_item->id;?>" menuname="<?php echo $unpaid_item->name;?>" quantity="<?php echo $unpaid_item->quantity;?>" price="<?php echo $unpaid_item->price;?>" onclick="comments(event)">Comment</a> -->
                  <input class="link_button"  type="submit" value="Comment" name="comment-btn">
                  </div>

                  <?php } ?>


      
            <div id="rating_<?php echo $i;?>" numrow="<?php echo $size;?>" menuid="<?php echo $unpaid_item->menuid;?>" orderid="<?php echo $unpaid_item->orderid;?>">
                
                <?php if($unpaid_item->total_votes == 1){ ?>

                 <div class="star_1 ratings_stars ratings_vote"></div>
                  <div class="star_2 ratings_stars"></div>
                <div class="star_3 ratings_stars"></div>
                <div class="star_4 ratings_stars"></div>
                <div class="star_5 ratings_stars"></div>  
                 <?php } elseif ($unpaid_item->total_votes == 2) { ?>
                  
                  <div class="star_1 ratings_stars ratings_vote"></div>
                  <div class="star_2 ratings_stars ratings_vote"></div>

                <div class="star_3 ratings_stars"></div>
                <div class="star_4 ratings_stars"></div>
                <div class="star_5 ratings_stars"></div>
                


                <?php  } elseif ($unpaid_item->total_votes == 3) { ?>
                  
                    <div class="star_1 ratings_stars ratings_vote"></div>
                  <div class="star_2 ratings_stars ratings_vote"></div>
                   <div class="star_3 ratings_stars ratings_vote"></div>

             
                <div class="star_4 ratings_stars"></div>
                <div class="star_5 ratings_stars"></div>

               <?php  } elseif ($unpaid_item->total_votes == 4) { ?>
                 
               <div class="star_1 ratings_stars ratings_vote"></div>
                  <div class="star_2 ratings_stars ratings_vote"></div>
                   <div class="star_3 ratings_stars ratings_vote"></div>
                    <div class="star_4 ratings_stars ratings_vote"></div>

                            
                <div class="star_5 ratings_stars"></div>

               <?php } elseif ($unpaid_item->total_votes == 5) { ?>
                 

                  <div class="star_1 ratings_stars ratings_vote"></div>
                  <div class="star_2 ratings_stars ratings_vote"></div>
                   <div class="star_3 ratings_stars ratings_vote"></div>
                    <div class="star_4 ratings_stars ratings_vote"></div>
                    <div class="star_5 ratings_stars ratings_vote"></div>

                            
                
               <?php } else{ ?>
                
                <div class="star_1 ratings_stars"></div>
                <div class="star_2 ratings_stars"></div>
                <div class="star_3 ratings_stars"></div>
                <div class="star_4 ratings_stars"></div>


                <div class="star_5 ratings_stars"></div>

                <?php } ?>

               
               
               
            </div>


           

       
            <?php //echo $unpaid_item->total_votes;?>
        <?php  $i++; ?>
        
           
       
                  
                </div>
                <?php $sum =  $sum + $unpaid_item->price; ?>
              
                </form>
              <?php endforeach; ?>

               <input type="hidden" value="<?php echo $sum; ?>"  id="total">
            </div>
          
            
          </div>
        </div>
      
        
      </div>
      <br/>
    </div>

 <div class="modal hide fade" id="call-alert" style="display:none;">
  
  
  <div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-large">Close</a>
  </div>
</div>

    <?php echo $callwaiter; ?>
    <?php echo $cashpayment; ?>
    <?php echo $game; ?>
      <?php echo $profile; ?>

   


  </body>

</html>