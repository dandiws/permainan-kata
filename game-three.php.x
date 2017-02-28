<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>GAME 3</title>
    <script src="js/jquery.js" charset="utf-8"></script>
    <style media="screen">
      table,td{

      }
      table tr td input[type="button"]{
        background-color: #e27046;
        border: 0;
        color: #fff;
        height: 30px;
        width: 30px;
        font-weight: bold;
      }
      table tr td input[type="button"]:focus{
        background-color: #ed6767;
      }
    </style>
  </head>
  <body>
    <button type="button" name="button" id="strtbtn">BUAT HURUF2</button>
    <table>
    </table>
  </body>
  <script type="text/javascript">
  $(document).ready(function() {
    var startBtn=$('#strtbtn');
    var table=$('table');
    var alpha=["ABCDEFGHIJKLMNOPQRSTUVWXYZ","AIUOE"];
    var kata2=["DANDI","AJI","BOLA","BEBEK","POLISI","JHFK","JHD","CANDA","KFLHFLK","JFG",'PWQO',"LDHFKH"];
    startBtn.click(function() {
      for (var i = 1; i <= 10; i++) {
        table.append('<tr id="row'+i+'"></tr>');
        rand=Math.floor(Math.random()*kata2.length);
        for (var j = 1; j <= 10; j++) {
          /*ltr=alpha[Math.floor(Math.random()*1)][Math.floor(Math.random()*26)];*/
          if (j!=kata2[rand].length) {
            ltr=kata2[rand][j%kata2[rand].length];
          }
          else {
            rand=Math.floor(Math.random()*kata2.length);
            ltr=kata2[rand][j%kata2[rand].length];
          }
          table.find('#row'+i).append('<td><input type="button" value="'+ltr+'"></td>');
        }
      }
    });
  });
  </script>
</html>
