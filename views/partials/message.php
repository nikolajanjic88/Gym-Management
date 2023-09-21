<?php if(isset($_SESSION['success_message'])): ?>
  <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['success_message'];
          unset($_SESSION['success_message']);
    ?>
    <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif ?>