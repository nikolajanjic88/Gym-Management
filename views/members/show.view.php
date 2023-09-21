<?php include_once base_path('views/partials/head.php'); ?>
<?php include_once base_path('views/partials/nav.php'); ?>

<div class="col-md-6 mt-3">
  <h2><?= $heading ?></h2>
  <form method="POST">
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
    <button class="btn btn-primary mt-3">Save Changes</button>
  </form>
</div>

<?php include_once base_path('views/partials/footer.php');