<?php include_once base_path('views/partials/head.php'); ?>
<?php include_once base_path('views/partials/nav.php'); ?>

<div class="col-md-6 mt-3">
  <h2><?= $heading ?></h2>
  <form method="POST" enctype="multipart/form-data">
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
    Phone Number: <input type="text" class="form-control" name="phone"  value="<?= $_POST['phone'] ?? '' ?>">
    Training Plan:
    <select class="form-control" name="training_plan_id" id="">
      <option value="0" selected>Training Plans</option>
      <?php foreach($training_plans as $training_plan): ?>
        <option value="<?= $training_plan['id'] ?>"><?= $training_plan['name'] ?></option>
      <?php endforeach ?>           
    </select>
    <?php if(isset($errors['training_plan_id'])): ?>
      <p class="text-danger small"><?= $errors['training_plan_id'] ?></p>
    <?php endif ?>
    Trainer:
    <select class="form-control" name="trainer_id" id="">
      <option value="0" selected>Chose Trainer</option>
      <?php foreach($trainers as $trainer): ?>
        <option value="<?= $trainer['id'] ?>"><?= $trainer['first_name'] . ' ' . $trainer['last_name'] ?></option>
      <?php endforeach ?>            
    </select>
    <?php if(isset($errors['trainer_id'])): ?>
      <p class="text-danger small"><?= $errors['trainer_id'] ?></p>
    <?php endif ?>
    <br>
    <input type="hidden" id="photoPathInput" name="photo_path">
    <div id="dropzone-upload" class="dropzone"></div>
    <button class="btn btn-primary mt-3">Register Member</button>
  </form>
</div>

<?php include_once base_path('views/partials/footer.php');