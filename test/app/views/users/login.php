<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <?php flash('register_success'); ?>
      <h2>Login An Account</h2>
      <p>Please fill in your data to login</p>
      <form method="post" action="<?php echo URLROOT; ?>/users/login">
        <div class="form-group">
          <label for="name">Name: <sup>*</sup></label>
          <input id="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"  type="text" name="name" value="<?php echo $data['name']; ?>">
          <span class="invalid-feedback"><?php echo $data['name_err'];?> </span>
        </div>
        <div class="form-group">
          <label for="password">Password: <sup>*</sup></label>
          <input id="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" type="password" name="password" value="<?php echo $data['password']; ?>">
          <span class="invalid-feedback"><?php echo $data['password_err'];?> </span>
        </div>

        <div class="row">
          <div class="col">
            <input class="btn btn-success btn-block" type="submit" value="Login"></input>
          </div>
          <div class="col">
            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">No account? Register</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>