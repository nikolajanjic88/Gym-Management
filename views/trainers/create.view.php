<?php include_once base_path('views/partials/head.php'); ?>
<?php include_once base_path('views/partials/nav.php'); ?>

<div class="col-md-6 mt-3">
  <h2><?= $heading ?></h2>
    <form action="" method="post">
      First Name: <input type="text" class="form-control" name="first_name" value="<?= $_POST['first_name'] ?? '' ?>">
      <?php if(isset($errors['first_name'])): ?>
        <p class="text-danger small"><?= $errors['first_name'] ?></p>
      <?php endif ?>
      Last Name: <input type="text" class="form-control" name="last_name" value="<?= $_POST['last_name'] ?? '' ?>">
      <?php if(isset($errors['last_name'])): ?>
        <p class="text-danger small"><?= $errors['last_name'] ?></p>
      <?php endif ?>
      Email: <input type="email" class="form-control" name="email" value="<?= $_POST['email'] ?? '' ?>">
      <?php if(isset($errors['email'])): ?>
        <p class="text-danger small"><?= $errors['email'] ?></p>
      <?php endif ?>
      Phone Number: <input type="text" class="form-control" name="phone" value="<?= $_POST['phone'] ?? '' ?>">
      <?php if(isset($errors['phone'])): ?>
        <p class="text-danger small"><?= $errors['phone'] ?></p>
      <?php endif ?>
      <button class="btn btn-primary mt-3">Add Trainer</button>
    </form>
</div>

<?php include_once base_path('views/partials/footer.php');