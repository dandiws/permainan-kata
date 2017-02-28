    <div>
       <div class="start" id="startscreen">
         <button type="button" name="button" id="start" class="startbtn">START</button>
       </div>
       <!--SCORE BOX-->
       <div class="score">SCORE : <span id="score">0</span></div>
       <!--SCORE BOX END-->
       <div class="game2">
         <!-- TIMER-->
         <div class="timer game2">
             <div class="time"></div>
         </div>
         <!-- TIMER END -->
         <div class="letters" id="letters">
           <input type="radio" class="char"  id="ch0"><label for="ch0"><div>A</div></label>
           <input type="radio" class="char"  id="ch1"><label for="ch1"><div>B</div></label>
           <input type="radio" class="char"  id="ch2"><label for="ch2"><div>C</div></label>
           <input type="radio" class="char"  id="ch3"><label for="ch3"><div>D</div></label>
           <input type="radio" class="char"  id="ch4"><label for="ch4"><div>E</div></label>
           <input type="radio" class="char"  id="ch5"><label for="ch5"><div>F</div></label>
           <input type="radio" class="char"  id="ch6"><label for="ch6"><div>G</div></label>
           <input type="radio" class="char"  id="ch7"><label for="ch7"><div>H</div></label>
           <input type="radio" class="char"  id="ch8"><label for="ch8"><div>I</div></label>
         </div>
         <div id="input"></div>
         <div id="delete"><i class="fa fa-arrow-left"></i></div>
       </div>
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
     </div>
     <script src="js/game-two.js" charset="utf-8"></script>
