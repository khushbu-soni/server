<?php foreach ($received_info as $received): ?>
    
    <tr>
    <td><?php echo $received['order_id'];?></td>
    <td><?php echo round($received['amount'],2);?></td>
    <td><?php echo $received['transaction_date'];?></td>
    <td><?php echo $received['narration'];?></td>
    
    <td>
    <p data-placement="top" data-toggle="tooltip" title="Edit">
    <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span>
    </button>
    </p>
    </td>
    <td>
    <p data-placement="top" data-toggle="tooltip" title="Delete">
    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
    <span class="glyphicon glyphicon-trash">
      
    </span>
    </button>
    </p>
    </td>
    </tr>
  <?php endforeach ;?>