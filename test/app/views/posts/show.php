<?php require_once APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<h1><?php echo $data['post']->email; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Status: <?php echo $data['post']->status; ?>
</div>
<p><?php echo $data['post']->body;?> </p>

<?php if(isset($_SESSION['user_status']) && $_SESSION['user_status'] == 'admin') : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>
<?php endif; ?>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>