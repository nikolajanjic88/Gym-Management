<?php include_once base_path('views/partials/head.php'); ?>
<?php include_once base_path('views/partials/message.php'); ?>
<?php include_once base_path('views/partials/nav.php'); ?>

<div class="row">
  <div class="col-md-12 mt-3">
    <h2><?= $heading ?></h2>
    <a href="/export?export=members" class="btn btn-success">Export</a>
    <table class="w-100">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Trainer</th>
          <th>Photo</th>
          <th>Training Plan</th>
          <th>Access Card</th>
          <th>Created at</th>
          <th>Action</th>
        </tr>       
      </thead>
      <tbody>
        <?php foreach($members as $member): ?>
        <tr>
          <td><?= $member['first_name'] ?></td>
          <td><?= $member['last_name'] ?></td>
          <td><?= $member['email'] ?></td>
          <td><?= $member['phone'] ?></td>
          <td><?= $member['trainer_id'] ? $member['trainer_first_name'] . ' ' . $member['trainer_last_name'] : 'No trainer' ?></td>
          <td><img src="<?= $member['image'] ?? 'images/noimage.jpg' ?>" width="50px" height="50px" alt=""></td>
          <td><?= $member['training_plan_name'] ?? 'No plan' ?></td>
          <td><a href="<?= $member['access_card'] ?>" target="_blank">Access Card</a></td>
          <td><?php
              $created_at = strtotime($member['created_at']); 
              $date = date('F, jS Y', $created_at);
              echo $date;
              ?>
          </td>
          <td>
            <form action="" method="POST">
              <input type="hidden" name="id" value="<?= $member['id'] ?>">
              <button class="btn btn-danger w-100 inline-block" onclick="return confirm('Are you sure?')">Delete</button>
            </form>  
            <a href="/member?id=<?= $member['id'] ?>" class="btn btn-primary w-100 mt-1">Edit</a>             
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
  
<?php include_once base_path('views/partials/footer.php');