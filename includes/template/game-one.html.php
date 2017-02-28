<div id="container">
    <div class="score">SCORE : <span id="score">0</span></div>
    <div class="timer"><div class="time"></div></div>
    <div class="start" id="startscreen"><button type="button" class="startbtn" id="start">START <i class="fa fa-play"></i></button></div>
    <div class="logcon" id="logcon"></div>
    <div class="incon">
        <div id="prefix" class="inputc">&nbsp;</div>
        <div class="inputc">
            <input type="text" name="word" id="wordinput" autocomplete="off" disabled="on">
        </div>
        <div class="inputc sw"><button type="button" name="switch" class="sw" id="switch"><i class="fa fa-refresh"></i></button></div>
    </div>
    <div class="start gone" style="display:none" id="gameover">
        <div class="gameover">
            <h1>GAME OVER</h1>
            <hr>
            <h3>Your Score is : <span id="finalscore"></span></h3>
            <button type="button" class="startbtn" name="button" id="start">AGAIN</button>
        </div>
    </div>
</div>
<script src="js/game-one.js" charset="utf-8"></script>
