<?php require_once APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
  <h2>Add Post</h2>
  <p>Create a post</p>
  <form method="post" action="<?php echo URLROOT; ?>/posts/add">
      <div class="form-group">
        <label for="username">Name: <sup>*</sup></label>
          <input id="username" class="form-control form-control-lg <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>"  type="username" name="username" value="<?php echo $data['username']; ?>">
          <span class="invalid-feedback"><?php echo $data['username_err'];?> </span>
        </div>
        <div class="form-group">
          <label for="email">Email: <sup>*</sup></label>
          <input id="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"  type="email" name="email" value="<?php echo $data['email']; ?>">
          <span class="invalid-feedback"><?php echo $data['email_err'];?> </span>
        </div>
    <div class="form-group">
      <label for="body">Body: <sup>*</sup></label>
      <textarea id="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" type="text" name="body"><?php echo $data['body']; ?></textarea>
      <span class="invalid-feedback"><?php echo $data['body_err'];?> </span>
    </div>
    <input class="btn btn-success btn-block" type="submit" value="Add"></input>
  </form>
</div>



<?php require_once APPROOT . '/views/inc/footer.php'; ?>