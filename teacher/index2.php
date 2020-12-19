<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">  
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/current_day.css">
  <link rel="stylesheet" href="./css/calendar.css">
  <link rel="stylesheet" href="./css/modal.css">
  <link rel="stylesheet" href="./css/portrait.css">
  <link rel="icon" href="./images/icon1.png" type="image/png" sizes="72×72"/>
  <script src="https://kit.fontawesome.com/e45ac9a14a.js" crossorigin="anonymous"></script>  
  <title>My Calendar - 12</title>
</head>
<style>

</style>
<body>
  <?php
    $connection = mysqli_connect("localhost", "w200603_cal", "6aOOBb+2R)&-", "w200603_cal"); //連線資料庫
    if(!$connection){ //如果連線失敗
        die("There was an error connecting to the database."); //網頁宣告到此die，並在網頁輸出…
    }
    function db_updateTheme($newTheme){
        global $connection;
        $query = "UPDATE theme SET cur_theme = '$newTheme' WHERE id = 1"; //更新theme資料表格中，id欄位值為1的資料列中的cur_theme欄位值為$newTheme
        $result = mysqli_query($connection, $query); //送出SQL查詢
        if(!$result){ //查詢失敗的話…
            die("Query failed: " . mysqli_error($connection));
        }
    }
    function setTheme(){
      global $connection;
      $query = "SELECT * FROM theme";
      $result = mysqli_query($connection, $query);
      if(!$result){
          die("Something went wrong...`");
      }
  
      while($row = mysqli_fetch_assoc($result)){
          return $row['cur_theme'];
      }
    }    
    if(isset($_POST['color'])){ //透過關聯陣列$_POST['color']取得傳送過來的color資料
      db_updateTheme($_POST['color']); //呼叫db_updateTheme方法
    }
  ?>  
  <h3 id="back-year" class="background-text off-color">1900</h3>
  <h4 class="background-text off-color">Calendar</h4>
  <!-- 月曆左欄：今天資訊 -->
  <div id="current-day-info" class="color">
    <h1 id="app-name-landscape" class="off-color default-cursor center">My Calendar</h1>
    <div>
      <h2 id="cur-year" class="current-day-heading default-cursor center">1900</h2>
    </div>
    <div class="">
      <h1 id="cur-day" class="current-day-heading default-cursor center">Monday</h1>
      <h1 id="cur-month" class="current-day-heading default-cursor center">1</h1>
      <h1 id="cur-date" class="current-day-heading default-cursor center">15<sup>th</sup> </h1>
    </div>
    <button id="theme-landscape" class="font button" onclick="openFavColor();">Change theme</button>    
  </div> 
  
  <!-- 月曆右欄：月曆表格  -->
  <div id="calendar">
    <h1 id="app-name-portrait" class="center off-color">My Calendar</h1>
    <table>
      <thead class="color">
        <tr>
          <th colspan="7" class="border-color">
            <h4 id="cal-year">1900</h4>
            <div >
              <i class="fas fa-caret-left icon" onclick="previousMonth();"></i>
              <h3 id="cal-month">1</h3>
              <i class="fas fa-caret-right icon" onclick="nextMonth();"></i>
            </div>
          </th>
        </tr>  
        <tr>
          <th class="weekday border-color">Sun</th>
          <th class="weekday border-color">Mon</th>
          <th class="weekday border-color">Tue</th>
          <th class="weekday border-color">Wed</th>
          <th class="weekday border-color">Thu</th>
          <th class="weekday border-color">Fri</th>
          <th class="weekday border-color">Sat</th>
        </tr>  
  
      </thead>
      <tbody id="table-body" class="border-color">
        <tr>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
        </tr>
        <tr>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td id="current-day" onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
        </tr>
        <tr>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td class="tooltip" onclick="dayClicked(this);">1 <img src="./images/note1.png"> <span>這是提示！！！</span> </td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
        </tr>
        <tr>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
        </tr>
        <tr>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
        </tr>
        <tr>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
          <td onclick="dayClicked(this);">1</td>
        </tr>
      </tbody>
    </table>
    <button id="theme-portrait" class="font button color" onclick="openFavColor();">Change theme</button>
  </div>

  <dialog id="modal">
    <!-- 色彩選擇對話方塊 -->
    <div id="fav-color" hidden>
      <div class="popup">
        <h4 class="center">What's your favorite color?</h4>
        <div id="color-options">
          <div class="color-option">
            <div class="color-preview" id="blue" style="background-color: #1B19CD;" onclick="addCheckmark('blue');">
              <i class="fas fa-check checkmark"></i>
            </div>
            <h5>Blue</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="red" style="background-color: #D01212;" onclick="addCheckmark('red');"></div>
            <h5>Red</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="purple" style="background-color: #721D89;" onclick="addCheckmark('purple');"></div>
            <h5>Purple</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="green" style="background-color: #158348;" onclick="addCheckmark('green');"></div>
            <h5>Green</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="orange" style="background-color: #EE742D;" onclick="addCheckmark('orange');"></div>
            <h5>Orange</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="deep-orange" style="background-color: #F13C26;" onclick="addCheckmark('deep-orange');"></div>
            <h5>Deep Orange</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="baby-blue" style="background-color: #31B2FC;"  onclick="addCheckmark('baby-blue');"></div>
            <h5>Baby Blue</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="cerise" style="background-color: #EA3D69;" onclick="addCheckmark('cerise');"></div>
            <h5>Cerise</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="lime" style="background-color: #36C945;" onclick="addCheckmark('lime');"></div>
            <h5>Lime</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="teal" style="background-color: #2FCCB9;" onclick="addCheckmark('teal');"></div>
            <h5>Teal</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="pink" style="background-color: #F50D7A;" onclick="addCheckmark('pink');"></div>
            <h5>Pink</h5>
          </div>
 
          <div class="color-option">
            <div class="color-preview" id="black" style="background-color: #212524;" onclick="addCheckmark('black');"></div>
            <h5>Black</h5>
          </div>
        </div>
        <button id="update-theme-button" class="button font" onclick="changeColor();">Update</button>
      </div>
    </div>

    <!-- 記事對話方塊 -->
    <div id="make-note" hidden>
      <div class="popup">
        <h4>Add a note to the calendar</h4>
        <textarea id="edit-post-it" class="font" name="post-it" autofocus></textarea>
        <div>
          <button class="button font post-it-button" id="add-post-it" onclick="submitPostIt();">Post It</button>
          <button class="button font post-it-button" id="delete-button" onclick="deleteNote();">Delete It</button>
        </div>
      </div>
    </div>
 </dialog>

<script type="text/javascript" src="js/updateDate.js"></script>
<script type="text/javascript" src="js/theme.js"></script>
<script type="text/javascript" src="js/postIts.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>

<script>
  currentColor.name = <?php echo(json_encode(setTheme())); ?> ; //js_encode將回傳的資料包裝成JSON編碼字串，然後指定給currentColor.name
  updateDate();
  var today = new Date(); //取得今日的日期物件，命名為today
  var thisMonth = today.getMonth(); //取得今月 thisMonth
  var thisYear = today.getFullYear(); //取得今年，thisYear
  fillInMonth();
 </script>

</body>
</html>