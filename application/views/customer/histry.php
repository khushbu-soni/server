<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to Restaurant</title>
    <?php echo $dependencies; ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
    <script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>

      <link rel="stylesheet"  href="<?php echo base_url() . 'assets/css/rating.css'; ?>" type="text/css"/>
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
      $(document).ready(function(){
       
        $('#paymentform').validationEngine();

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



     function comments(event){
        order = $(event.target);
        
        orderid = order.attr('orderid');
        menuid = order.attr('menuid');
         price = order.attr('price');
        orderitemid = order.attr('orderitemid');

        menuname = order.attr('menuname');
        quantity = order.attr('quantity');  

        var  comment = document.getElementById('comment').value ;
        var  total = document.getElementById('total').value ;
        
       
        //alert(comments);
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('customer/yourbill/comment_insert'); ?>",
          data: "price=" + price + "&orderitemid=" + orderitemid + "&menuid=" + menuid + "&orderid=" + orderid + "&menuname=" + menuname + "&quantity=" + quantity + "&comment=" + comment + "&total=" + total ,
          success: function(data){
           
           // alert('Comment Sucessfully');
            $('#comment-div').hide();
            window.location.href = "<?php echo site_url('customer/yourbill'); ?>";

          }
        });
      }
    </script>

    <style type="text/css">

 .comments { width: 300px; height: 18px }

    </style>
  </head>

  <body  >
    <?php echo $menuheader; ?>
    <?php $img_path = $this->config->item('img_path'); ?>
    <div class="container-fluid" style="margin-top:120px; padding: 0px 30%;">
      <div class="row-fluid">
        <div class="outer-frame rounded-6px" >
          <div class="rounded-4px paymentorder"  >
            <div class="boxheading toprounded-4px" >
              Your Order
             <!--  <pre><?php print_r($this->session->all_userdata());?></pre> -->
            </div>
            <div class="rightmenucol rounded-4px" style="max-height:600px; overflow-y: scroll;" >
              
              <?php  $sum = 0; ?>
              <?php foreach ($prev_item as $unpaid_item): ?>
                <div class="ordereditem">

               
                    
                      <img alt="<?php echo $unpaid_item->name;?>" src="<?php echo  $img_path . $unpaid_item->pic?>" class='menuimg pull-left img-polaroid'  />

                   
                     
             <?php echo $unpaid_item->name; ?><br/><b>$<?php echo $unpaid_item->price; ?></b>
                  &nbsp;
                  <?php if($unpaid_item->comment_status == 1) { echo "<br><textarea class=comments readonly>".$unpaid_item->comment."</textarea><br/>";
                    echo $unpaid_item->comment_date;  ?>



           

                    <?php  }else{?>
                 
                  <?php } ?>



                     <div id="rating_1" numrow="" menuid="<?php echo $unpaid_item->menuid;?>" orderid="<?php echo $unpaid_item->orderid;?>">
                
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




                </div>


                <?php $sum =  $sum + $unpaid_item->price; ?>
              <?php endforeach; ?>

               <input type="hidden" value="<?php echo $sum; ?>"  id="total">
            </div>

            
          
            
          </div>
        </div>
      
        
      </div>
      <br/>
    </div>
    <?php echo $callwaiter; ?>
    <?php echo $cashpayment; ?>
    <?php echo $game; ?>
     <?php echo $drinkrefill; ?>
      <?php echo $profile; ?>
  </body>

</html>