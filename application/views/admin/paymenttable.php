<?php if (empty($filter_stock_info)): ?>
							<tr class="alert alert-danger">
								<td colspan="3">
									There are no Records to display.
								</td>
								</tr>
							<?php endif; ?>
<?php 
if(!empty($filter_stock_info)){
foreach ($filter_stock_info as $st): ?>
                                        <tr class="odd gradeX">
                                            <td >
                                            <?php
                                            	echo $st['customername'];
                                            ?>
                                            </td>
                                            <td class="odd gradeX text-center" width="150px;">
                                            <?php	                                            
                                            	echo $st['amount'];
                                            ?>
                                            </td>
                                            <td class="text-center " id="tax">
                                            <?php	                                            
                                            	echo $st['tax']."%";
                                            ?>
                                            </td>
                                            <td class="text-center">
                                            <?php                                               
                                                echo $st['date'];
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Total</td>
                                            <?php print_r($this->data['total_info']);?>
                                            <td class="text-center"><?php echo $total_info[0]['total_amount']?></td>
                                            <td id="tax"></td>
                                            <td></td>
                                        </tr>
                                            
                                            
                                       <?php endforeach; ?>
                                       <?php } ?>