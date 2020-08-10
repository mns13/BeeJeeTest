<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Create An Account</h2>
      <p>Please fill out this form to register with us</p>
      <form action="<?php echo URLROOT; ?>/users/register" method="post">
        <div class="form-group">
          <label for="name">Name: <sup>*</sup></label>
          <input id="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" type="text" name="name">
          <span class="invalid-feedback"><?php echo $data['name_err'];?> </span>
        </div>

        <div class="form-group">
          <label for="password">Password: <sup>*</sup></label>
          <input id="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" type="password" name="password">
          <span class="invalid-feedback"><?php echo $data['password_err'];?> </span>
        </div>

        <div class="form-group">
          <label for="confirm_password">Confirm Password: <sup>*</sup></label>
          <input id="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>" type="password" name="confirm_password">
          <span class="invalid-feedback"><?php echo $data['confirm_password_err'];?> </span>
        </div>

        <div class="row">
          <div class="col">
            <input class="btn btn-success btn-block" type="submit" name="submit" value="Register"></input>
          </div>
          <div class="col">
            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
