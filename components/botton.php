
<div class="fixed-bottom font-sriracha">
  <div class="d-flex bg-primary text-white mb-3">
    <div class="me-auto p-2 navbar-brand text-white">V. 2.0</div>
    <?php if (isset($_SESSION['b_login'])) { ?>
      <a class="navbar-brand p-2 text-white" href="/badminton/components/logout.php">Logout</a>
    <?php } ?>

  </div>
</div>