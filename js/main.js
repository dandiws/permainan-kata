function startScreenGone() {
  $('#startscreen').addClass('gone');
  setTimeout(function () {
    $('#startscreen').remove();
  }, 300);
}
function timeStarted() {
  $('.time').addClass('started');
}
function gameOverGone() {
  $('#gameover').addClass('gone');
  setTimeout(function () {
    $('#gameover').css('display', 'none');
  }, 300);
}
function timeStopped() {
  $('.time').removeClass('started');
}
function gameOverShow() {
  $('#gameover').css('display', 'block').removeClass('gone');
}
$(document).ready(function() {
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader=new FileReader();
      reader.onload=function (e) {
        $('#avatarimg').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $('#upavatar').change(function() {
    readURL(this);
    $('label[for="sendavatar"]').addClass('show');
  });
  $('#avatarform').submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: 'includes/game/uploadAvatar.php',
      type: 'POST',
      data: new FormData(this),
      contentType: false,
      cache:false,
      processData: false,
      success:function (res) {
        $('#avatarimg').attr('src', 'img/avatars/'+res);
        $('label[for="sendavatar"]').removeClass('show');
      }
    });

    return false;
  });
});
