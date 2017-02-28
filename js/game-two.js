$(document).ready(function() {
  var input="";
  var label=["","","","","","","","",""];
  var startBtn = $('button.startbtn');
  var delBtn=$('#delete');
  var trans=0;
  var started=false;
  var playtime=60;

  startBtn.click(function() {
    startGame();
    $('#score').html('0');
    startScreenGone();
    gameOverGone();
    getLettersAnim();
    setTimeout(function () {
      getLetters();
    },1000);
  });

  $(document).keydown(function(event) {
    event.preventDefault();
    if (started) {
      char=String.fromCharCode(event.keyCode);
      inp=$('input[value="'+char+'"]:not(:checked)');
      if (inp.length) {
        inp.first().prop('checked', 'checked');
        input+=char;
        $('#input').text(input);
      }
      if (event.keyCode==8) {
        deleteLetter();
      }
      if (event.keyCode==13) {
        $.ajax({
          url: 'includes/game/game-two.php',
          type: 'POST',
          dataType: 'json',
          data: 'word='+input,
          success: function (res) {
            if (res==1096) {
              console.log("TIDAK ADA "+res);
              gameBegin();
            }
            else if (res==1012){
              console.log("SUDAH DIPAKAI "+res);
              gameBegin();
            }
            else {
              console.log("BENAR, score: "+res);
              $('#score').text(res);
              gameBegin();
            }
          },
          error:function (er) {
            console.log(er.responseText);
          }
        });

      }
      if (event.ctrlKey) {
        if (event.keyCode==32) {
          gameBegin();
          getLetters();
        }
      }
    }
    else {
      console.log("Game is over");
    }
  });

  $(document).on('change', '.char', function() {
    if (started) {
      input+=$(this).val();
      $('#input').text(input);
    }
    else {
      console.log("Game is over");
    }
  });

  delBtn.click(function() {
    deleteLetter();
  });

  function gameBegin() {
    $('.char').prop('checked', false);
    input="";
    $('#input').text("");
  }

  function getLetters() {
    $.ajax({
      url: 'includes/game/game-two.php',
      type: 'POST',
      dataType: 'json',
      data: "chars=",
      success: function (res) {
        //
        trans-=90;
        for (var x=0;x<res.length;x++){
            label[x]+='</br>'+res[x];
            $('#ch'+x+'+ label > div').html(label[x]);
            $('#ch'+x+'+ label > div').css('transform', 'translateY('+trans+'px)').css('transition', '0.5s');
            $('#ch'+x).val(res[x]);
        }
        //
      },
      error: function (res) {
        console.log(res.responseText);
      }
    });
  }

  function getLettersAnim() {
    var alpha="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for (var x=0;x<9;x++){
      shuf=alpha.split('').sort(function () {
        return 0.5-Math.random()}).join('</br>');
      $('#ch'+x+'+ label > div').html(shuf);
      $('#ch'+x+'+ label > div').css('transform', 'translateY(calc(-100% + 90px))').css('transition', '1s');
    }
  }

  function gameOver() {
    started=false;
    $('input.char').attr('disabled', 'disabled');
    timeStopped();
    gameBegin();
    $.ajax({
      url: 'includes/game/game-two.php',
      dataType: 'json',
      success:function (res) {
        console.log("game over,score: "+res);
        $('#finalscore').html(res);
        gameOverShow();
      }
    });

  }

  function startGame() {
    started=true;
    /*--GAME OVER IN--*/
    setTimeout(function () {
      gameOver();
    }, playtime*1000);
    timeStarted();
    $.ajax({
      url: 'includes/game/game-two.php',
      type: 'POST',
      dataType: 'json',
      data: {start: ''},
      success:function (res) {
        console.log(res);
      }
    });

  }

  function deleteLetter() {
    if (input!="") {
      va=input.slice(-1);
      var un=$('input[value='+va+']:checked');
      if (un.length) {
        un.first().prop('checked', false);
        input=input.slice(0, -1);
        $('#input').text(input);
      }
    }
  }
});
