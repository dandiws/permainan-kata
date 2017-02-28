    <link rel="stylesheet" href="css/game-three.css">
    <div>
      <div class="start" id="startscreen">
        <button type="button" name="button" id="start" class="startbtn">START</button>
      </div>
      <!--SCORE BOX-->
      <div class="score">SCORE : <span id="score">0</span></div>
      <!--SCORE BOX END-->
      <!-- TIMER-->
      <div class="timer">
          <div class="time"></div>
      </div>
      <!-- TIMER END -->
      <!--GAME OVER SCREEN-->
      <div class="start gone" style="display:none" id="gameover">
          <div class="gameover">
              <h1>GAME OVER</h1>
              <hr>
              <h3>Your Score is : <span id="finalscore"></span></h3>
              <button type="button" class="startbtn" name="button" id="start">AGAIN</button>
          </div>
      </div>
      <!--GAME OVER SCREEN END-->
      <div class="game3">
        <div class="letters" id="letters">
          <div class="rowodd">
          <input type="radio" class="char"  id="ch0"><label for="ch0">1</label>
          <input type="radio" class="char"  id="ch1"><label for="ch1">2</label>
          <input type="radio" class="char"  id="ch2"><label for="ch2">3</label>
          <input type="radio" class="char"  id="ch3"><label for="ch3">4</label>
          </div>
          <div class="roweven">
          <input type="radio" class="char"  id="ch4"><label for="ch4">5</label>
          <input type="radio" class="char"  id="ch5"><label for="ch5">6</label>
          <input type="radio" class="char"  id="ch6"><label for="ch6">7</label>
          <input type="radio" class="char"  id="ch7"><label for="ch7">8</label>
          </div>
          <div class="rowodd">
          <input type="radio" class="char"  id="ch8"><label for="ch8">9</label>
          <input type="radio" class="char"  id="ch9"><label for="ch9">10</label>
          <input type="radio" class="char"  id="ch10"><label for="ch10">11</label>
          <input type="radio" class="char"  id="ch11"><label for="ch11">12</label>
          </div>
          <div class="roweven">
          <input type="radio" class="char"  id="ch12"><label for="ch12">13</label>
          <input type="radio" class="char"  id="ch13"><label for="ch13">14</label>
          <input type="radio" class="char"  id="ch14"><label for="ch14">15</label>
          <input type="radio" class="char"  id="ch15"><label for="ch15">16</label>
        </div>
        </div>
        <div id="showword" class="showword">
        </div>
        <div id="guestword" class="showword">
        </div>
      </div>
    </div>
  <script src="js/game-three.js" charset="utf-8"></script>
