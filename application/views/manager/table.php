 <table class="table table-bordered">
                        <tr>
                            <th>Menu Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            </tr>
                            <?php foreach ($order_details as $order) {
                                $i=0;
                                ?>

                            <tr><td>
                                <?php echo $order->name;?>
                                </td>
                                <td>
                                <?php echo $order->quantity;?>
                                </td>
                                <td>
                                  <?php echo $order->price;?>
                                </td>
                            </tr>
                            <?php }?>
                        
</table>