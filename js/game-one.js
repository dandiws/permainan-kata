$(document).ready(function() {

    var wordinput = $('#wordinput');
    var switchBtn = $('#switch');
    var startBtn = $('button.startbtn');
    var prefix;
    var isPrefixSet = false;
    var started = false;

    startBtn.click(function() {
        gameStart();
    });

    wordinput.keydown(function(event) {
        if (started) {
            //disallow typing while prefix is not set
            if (!isPrefixSet) {
                event.preventDefault();
            }
            if (event.ctrlKey) {
              if (event.keyCode == 32) {
                  wordinput.val("");
                  getPrefix();
              }
            }
            //if enter pressed
            if (event.keyCode == "13") {
                if (wordinput.val()) {
                    event.preventDefault();
                    //cheking word(prefix+user input) on database with ajax
                    word = wordvalid(prefix + wordinput.val());
                    $.ajax({
                        url: 'includes/game/game-one.php',
                        type: 'post',
                        data: "word=" + word,
                        dataType: 'json',
                        success: function(data) {
                            if (data == 1011) {
                                li = '<li>' + word + ' <i class="fa fa-times"></i></li>';
                                correctmsg = '<div class="correctmsg incorrect">' + word + '</div>';
                            } else if (data == 1012) {
                                li = "";
                                correctmsg = '<div class="correctmsg incorrect">already used</div>';
                            } else {
                                li = '<li>' + word + ' <i class="fa fa-check"></i></li>';
                                correctmsg = '<div class="correctmsg correct">' + word + '</div>';
                                $('#score').html(data);
                            }
                            $('#logcon').append(li);
                            wordinput.val("");
                            $('#container').prepend(correctmsg);
                            if ($('div.correctmsg').length > 2) {
                                $('div.correctmsg')[2].remove();
                            }
                        }
                    });

                }
            }
        }
    });

    switchBtn.click(function() {
        if (started) {
            getPrefix();
        }
    });

    wordinput.blur(function() {
        $(this).focus();
    });

    function gameOver() {
        started = false;
        wordinput.val("");
        wordinput.attr('disabled', 'disabled');
        timeStopped();
        $('.logcon > li').remove();
        $.ajax({
            url: 'includes/game/game-one.php',
            dataType: 'json',
            success: function(res) {
              console.log("game over");
              if (res['isbest']) {
                console.log("NEW BEST SCORE: "+res['score']);
              }
              else {
                console.log("YOUR SCORE IS: "+res['score']+" BEST SCORE: "+res['best']);
              }
                $('#finalscore').html(res['score']);
                gameOverShow();
            },
            error:function (er) {
              console.log(er.responseText);
            }
        });
    }

    function gameStart() {
        started = true;
        setTimeout(function() {
            gameOver();
        }, 60 * 1000);
        startScreenGone();
        timeStarted();
        gameOverGone();
        $('#score').html('0');
        $.ajax({
            url: 'includes/game/game-one.php',
            type: 'POST',
            data: "start=1",
            success:function () {
              getPrefix();
            }
        });

    }

    function getPrefix() {
        if (started) {
            console.log("prefix requested");
            wordinput.attr('disabled', 'disabled');
            $('#prefix').html('<div class="loader"><label></label> <label></label> <label></label> </div>');
            isPrefixAvailable();
        }
    }

    function isPrefixAvailable() {
        //checking in database with ajax
        $.ajax({
                url: 'includes/game/game-one.php',
                type: 'POST',
                data: "prefix=",
                dataType: 'json',
                //if success:
                success: function(res) {
                    if (res == 1010) {
                        isPrefixAvailable();
                    }
                    else {
                        wordinput.removeAttr('disabled');
                        wordinput.focus();
                        isPrefixSet = true;
                        prefix = res[0];
                        //write prefix on screen
                        $('#prefix').html(res[0]);
                    }
                }
            })
            .fail(function(er) {
                console.log(er.responseText);
            });
    }

    function shuffle(arr) {
        var j, x, i;
        for (i = arr.length; i; i--) {
            j = Math.floor(Math.random() * i);
            x = arr[i - 1];
            arr[i - 1] = arr[j];
            arr[j] = x;
        }
    }

    function wordvalid(str) {
        str = str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        str = str.toLowerCase();
        return str;
    }
});
