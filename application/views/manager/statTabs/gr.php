<div class="span12 outer-frame rounded-6px">
                    <div class="paymentmain rounded-4px" style="">
                        <div class="boxheading toprounded-4px">
                            Payment Details
                        </div>
                        <div class="paymentdetails">
                            <div class="alert alert-danger hide" id="invalidcode">
                                <strong>The coupon code you provided is invalid.</strong>
                            </div>
                            <div class="alert alert-success hide" id="codesuccess">
                                <strong>Your coupon code is valid. Your payment amounts have been updated.</strong>
                            </div>
                            <form method="post" action="<?php echo site_url('customer/payment/success'); ?>" id="paymentform">
                                <p>
                                    <table class="form">
                                        <tr>
                                            <td class="formlabel">Subtotal</td>
                                            <td><span id="subtotalamount"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="formlabel">Tax</td>
                                            <td>$<span id="taxamount"><?php echo $values->tax; ?></span> <input type="hidden" value="<?php echo $values->tax; ?>" name="tax" /></td>
                                        </tr>
                                        <tr>
                                            <td class="formlabel">Tip</td>
                                            <td>$ <input name="tipamount" value="0.00" type="text" class="span3" /></td>
                                        </tr>
                                        <tr>
                                            <td class="formlabel">Total</td>
                                            <td>$<span id="totalamount"><?php echo $values->total; ?></span> <input name="total" type="hidden" value="<?php echo $values->total; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="formlabel">Payment Type</td>
                                            <td><a href="#" onclick="$('#creditpayment').show();" class="btn">Credit/Debit Card</a>&nbsp;&nbsp;<a href="#cash-modal" onclick="callWaiter(event); $('#creditpayment').slideUp('fast');" data-toggle="modal" class="btn">Cash</td>
                                        </tr>
                                        <tr>
                                            <td class="formlabel">Coupon Code</td>
                                            <td><input type="password" class="span5" name="couponcode" /><br/><a href="#" onclick="redeemCode()" class="btn">Redeem</a></td>
                                        </tr>
                                    </table>
                                    <br/>
                                    <table class="form" id="creditpayment">
                                        <tr>
                                            <td class="formlabel">Card Number</td>
                                            <td><input type="text" class="span12 validate[required]" name="cardnumber" /></td>
                                        </tr>
                                        <tr>
                                            <td class="formlabel">Expiry Date</td>
                                            <td><input type="text" class="span6 validate[required]" name="expirydate" /></td>
                                        </tr>
                                        <tr>
                                            <td class="formlabel">CVV</td>
                                            <td><input type="text" class="span4 validate[required]" name="cvvnumber" /></td>
                                        </tr>
                                    </table>
                                    <input type="hidden" value="<?php echo $unpaid_ids; ?>" name="ordereditems" />
                                    <input type="hidden" value="0" name="couponused" />
                                </p>
                                <a href="#" class="btn btn-large" onclick="$('#paymentform').submit()"><i class="icon-shopping-cart"></i> Make Payment</a>
                            </form>
                        </div>
                    </div>
                </div>