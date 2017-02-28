$(document).ready(function() {
  var input=$('form input');
  input.blur(function() {
    val=$(this).val();
    field=$(this).attr('placeholder');
    errormsg=$(this).parent().parent().find('.errormsg');
    if (val=="") {
      errormsg.html(field+" field is required");
    }
    else {
      errormsg.html("");
    }
  });

  input.keypress(function() {
    errormsg=$(this).parent().parent().find('.errormsg');
    if (errormsg.html()) {
      errormsg.html("");
    }
  });

  $('form[name="register"] input[type="password"][name="confirmpassword"]').blur(function() {
    errormsg=$(this).parent().parent().find('.errormsg');
    if ($(this).val()!==$('form[name="register"] input[type="password"][name="password"]').val()) {
      errormsg.html("Confirm password must be same");
    }
  });

  $('form').submit(function(event) {
    errormsg=$(this).parent().find('.errormsg');
    val=$(this).find('input');
    filled=false;
    for (var i = 0; i < 4; i++) {
      if (val[i].value=="") {
        filled=false;
        break;
      }
      else {
        filled=true;
      }
    }
    if (!filled) {
      errormsg.html("All field must be filled");
      return false;
    }
    else if (val[2].value!=val[3].value) {
      errormsg.html("Confirm Password must be same");
      return false;
    }
  });
});
