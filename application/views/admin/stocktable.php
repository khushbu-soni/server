<?php if (empty($filter_stock_info)): ?>
							<tr class="alert alert-danger">
								<td colspan="3">
									There are no Records to display.
								</td>
								</tr>
							<?php endif; ?>
<?php 
foreach ($filter_stock_info as $st): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                            <?php
                                            	echo $st->name;
                                            ?>
                                            </td>
                                            <td class="odd gradeX" width="150px;">
                                            <?php	                                            
                                            	echo $st->qty;
                                            ?>
                                            </td>
                                            <td>
                                            <?php	                                            
                                            	echo $st->date;
                                            ?>
                                            
                                            </td>
                                            
                                        </tr>
                                       <?php endforeach; ?>