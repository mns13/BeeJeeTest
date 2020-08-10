<?php require_once APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
  <h2 class="mb-3">Edit Post</h2>

  <form method="post" action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>">
    <div class="form-group row">
      <div class="col-sm-1">Status</div>
      <div class="col-sm-1">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="status" value="New" checked>
          <label class="form-check-label" for="status">
            New
          </label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="status" value="Complete">
          <label class="form-check-label" for="status">
            Complete
          </label>
        </div>
      </div>
    </div>
    
    <!-- <div class="form-group">
      <label for="status">Status: <sup>*</sup></label>
      <input id="status" class="form-control form-control-lg "  type="text" name="status" value="<?php echo $data['status']; ?>">
    </div> -->
    <div class="form-group">
      <label for="email">Email: <sup>*</sup></label>
      <input id="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"  type="text" name="email" value="<?php echo $data['email']; ?>">
      <span class="invalid-feedback"><?php echo $data['email_err'];?> </span>
    </div>
    <div class="form-group">
      <label for="body">Body: <sup>*</sup></label>
      <textarea id="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" type="text" name="body"><?php echo $data['body']; ?></textarea>
      <span class="invalid-feedback"><?php echo $data['body_err'];?> </span>
    </div>
    <input class="btn btn-success btn-block" type="submit" value="Edit"></input>
  </form>
</div>



<?php require_once APPROOT . '/views/inc/footer.php'; ?>