$(document).ready(function() {
    var letters = $('#letters');
    var inputs = letters.find('input.char');
    var labels = letters.find('input.char+label');
    var startBtn = $('button.startbtn');
    var wordguest = new Array();
    $('input.char').attr('disabled', 'disabled');

    startBtn.click(function() {
        startScreenGone();
        gameOverGone();
        getLetters();
        playAnim(3.5);
        //Play anim again after 5s
        setTimeout(function() {
            reqThatLetters();
            playAnim(3.5);
            //after 3.5s print word and time is started
            setTimeout(function() {
                timeStarted();
                //gameover after 60s
                setTimeout(function() {
                    gameOverShow();
                    timeStopped();
                }, 60 * 1000);
                printWord();
                $('input.char').attr('disabled', false);
            }, 3500);
        }, 5000);
    });

    $('input.char').change(function() {
        index = $(this).val();
        activeltr = $('#showword input:checked');
        if (activeltr.val() != 'on') {
            ind = activeltr.val();
            $('input.char[value="' + ind + '"]').prop('checked', false);
        }
        $('#showword input:checked').val(index);
        id = $('#showword input:checked').attr('id');
        $('#g_' + id).html(index);
        prevNext('next');
    });

    $(document).keydown(function(event) {
        //right arrow
        if (event.keyCode == 39) {
            prevNext('next');
        }
        //left arrow
        else if (event.keyCode == 37) {
            prevNext('prev');
        } else if (event.keyCode == 13) {
            wordguest = new Array();
            pass = true;
            $('#showword input').each(function() {
                if ($(this).val() == 'on') {
                    $(this).next().addClass('focused');
                    pass = false;
                }
                wordguest.push($(this).val());
            });
            if (pass) {
                checkingAnswer();
            }
        }
    });

    function reqThatLetters() {
        $.ajax({
            url: 'includes/game/game-three.php',
            type: 'POST',
            dataType: 'json',
            data: {
                thatlettersagain: ''
            },
            success: function(res) {
                printLetters(res);
            }
        });
    }

    function checkingAnswer() {
        $.ajax({
                url: 'includes/game/game-three.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    answer: wordguest
                },
                success: function(res) {
                    $('#score').html(res['score']);
                    reqThatLetters();
                    $('input.char').attr('disabled', 'disabled');
                    $('input.char+label').each(function(index, el) {
                        index += 1;
                        if (res['correct'].indexOf(index) !== -1) {
                            $(this).addClass('correct')
                        } else if (res['incorrect'].indexOf(index) !== -1) {
                            $(this).addClass('incorrect');
                        }
                    });
                    $('.rowodd, .roweven').addClass('flipped');
                }
            })
            .fail(function(er) {
                console.log(er.responseText);
            });
    }

    function prevNext(val) {
        if (val == "next") {
            $('#showword input:checked').next().next().prop('checked', true);
        } else if (val == "prev") {
            $('#showword input:checked').prev().prev().prop('checked', true);
        }
    }

    function playAnim(t) {
        $('.rowodd, .roweven').addClass('play');
        setTimeout(function() {
            $('.rowodd, .roweven').removeClass('play');
            /*$('input.char+label > .card > .back').remove();*/
        }, t * 1000);
    }

    function getLetters() {
        wordguest = new Array();
        $('#showword').html("");
        $('#guestword').html("");
        $('input.char').prop('checked', false);
        $('input.char').attr('disabled', 'disabled');
        $('input.char+label').removeClass('correct').removeClass('incorrect');
        $('.roweven, .rowodd').removeClass('flipped');
        $.ajax({
            url: 'includes/game/game-three.php',
            type: 'POST',
            dataType: 'json',
            data: {
                getletter: ''
            },
            success: function(res) {
                printLetters(res);
            }
        });
    }

    function printLetters(res) {
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = i + 1;
            labels[i].innerHTML = '<div class="card"><div class="front">' + (i + 1) + '</div><div class="back">' + res[i] + '</div></div>';
        }
    }

    function printWord() {
        $.ajax({
            url: 'includes/game/game-three.php',
            type: 'POST',
            dataType: 'json',
            data: {
                printword: ''
            },
            success: function(res) {
                $('#showword').html("");
                $('#guestword').html("");
                for (var i = 0; i < res.length; i++) {
                    ltr = "ltr" + (i + 1);
                    g_letter = '<div id="g_' + ltr + '"></div>';
                    if (i == 0) {
                        letter = '<input type="radio" name="letterx" id="' + ltr + '" checked><label for="' + ltr + '">' + res[i] + '</label>';
                    } else {
                        letter = '<input type="radio" name="letterx" id="' + ltr + '"><label for="' + ltr + '">' + res[i] + '</label>';
                    }
                    $('#guestword').append(g_letter);
                    $('#showword').append(letter);
                }
            }
        });

    }
});
