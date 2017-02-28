<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Permainan Kata</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav navbar-right">
        <?php if (!isset($_SESSION['login'])): ?>
          <li class="active"><a href="login.php">Sign In</a></li>
          <li><a href="register.php">Sign Up</a></li>
        <?php else: ?>
          <li><a href="user.php"><?php echo $_SESSION['login']['username']; ?></a></li>
          <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
