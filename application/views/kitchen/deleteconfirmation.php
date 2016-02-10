
<!-- Modal -->
<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
      </div>
      <div class="modal-body">
     <p>Are you sure you want to delete this entry?</p>
      </div>
     <div class="modal-footer">
		<a class="btn btn-info" accountid="" href="<?php echo site_url('manager/useraccounts/delete/'); ?>" id="btnDelete" class="btn btn-large transition">Yes</a>
		&nbsp;&nbsp;
		<a class="btn btn-danger" href="#" data-dismiss="modal" class="btn btn-large">No</a>
	</div>
    </div>
  </div>
</div>