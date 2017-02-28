<nav class="sidenav">
  <div class="header">
    <div class="avatar" id="avatarcont">
    <?php if (!$_SESSION['login']['avatar']): ?>
      <img src="img/default.png" alt="avatar" class="profile" id="avatarimg">
    <?php else: ?>
      <img src="img/avatars/<?php echo $_SESSION['login']['avatar']; ?>" alt="avatar" class="profile" id="avatarimg">
    <?php endif; ?>
    <noscript>
      <a href="edit.php?act=upload-avatar" onclick="return false" class="upload-ava"><i class="fa fa-camera"></i></a>
    </noscript>
    <script type="text/javascript">
      document.write('<form id="avatarform" enctype="multipart/form-data"><input type="file" name="avatar" id="upavatar" style="display:none;"><label for="upavatar" class="upload-ava"><i class="fa fa-camera"></i></label><input type="submit" id="sendavatar" style="display:none;"></form>');
    </script>
    </div>
    <label for="sendavatar"><i class="fa fa-check"></i></label>
    <h5><?php echo $_SESSION['login']['name']; ?></h5>
  </div>
  <div class="menu">
    <a href="index.php">Play</a>
    <a href="edit.php">Edit Profile</a>
    <a href="logout.php">Logout</a>
  </div>
</nav>
<button type="button" id="collapse-nav"><i class="fa fa-chevron-circle-left"></i></button>
<script type="text/javascript">
  $('#collapse-nav').click(function() {
    if (!$(this).hasClass('collapsed')) {
      $('.sidenav').addClass('collapsed');
      $('.wrapper').addClass('full');
      $(this).addClass('collapsed');
      $(this).find('.fa').removeClass('fa-chevron-circle-left').addClass('fa-chevron-circle-right');
    }
    else {
      $('.sidenav').removeClass('collapsed');
      $('.wrapper').removeClass('full');
      $(this).removeClass('collapsed');
      $(this).find('.fa').removeClass('fa-chevron-circle-right').addClass('fa-chevron-circle-left');
    }
  });
</script>
