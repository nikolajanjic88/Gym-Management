<?php include_once base_path('views/partials/head.php'); ?>
<?php include_once base_path('views/partials/message.php'); ?>
<?php include_once base_path('views/partials/nav.php'); ?>

<div class="row">
  <div class="col-md-12 mt-3">
    <h2><?= $heading ?></h2>
    <a href="/export?export=trainers" class="btn btn-success">Export</a>
    <table class="w-100">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Created at</th>
          <th>Action</th>
        </tr>       
      </thead>
      <tbody>
        <?php foreach($trainers as $trainer): ?>
          <tr>
            <td><?= $trainer['first_name'] ?></td>
            <td><?= $trainer['last_name'] ?></td>
            <td><?= $trainer['email'] ?></td>
            <td><?= $trainer['phone'] ?></td>
            <td><?php
              $created_at = strtotime($trainer['created_at']); 
              $date = date('F, jS Y', $created_at);
              echo $date;
              ?>
            </td>
            <td>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $trainer['id'] ?>">
                <button class="btn btn-danger" onclick="confirm('Are you sure?')">Delete</button>
              </form>               
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?php include_once base_path('views/partials/footer.php');