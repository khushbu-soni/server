<button type="button"  class="btn btn-info btn-lg dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">
                 Notifications <span class="badge" id="notify" ><?php echo sizeof($notification_limit);?></span></a>
</button>
                <ul id="abc" class="dropdown-menu pull-right" role="menu" data-spy="scroll" style="max-height:600px; overflow-y: scroll; margin-bottom:10px;" >

                  <?php foreach ($notification_limit as $info) {?>
                  <input type="hidden" value="<?php echo $info->name;?>" />
                  <li style="background-color:#d0d8ea; padding:10px 0px 10px 0px; border-bottom: #9cacd3 1px solid;" id="hide" id="<?php echo $info->id;?>">
                  <a href="<?php echo site_url('kitchen/ingredients/filter/'.$info->id); ?>">
                  <?php echo $info->name; echo "Available Quantity [".$info->quantity."] is Lower Min Quantity [".$info->min_ingr."]";?>
                  </a>
                  </li>
                   
                  <?php }?>
                </ul>
