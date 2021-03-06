<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600" rel="stylesheet">
    <link rel="icon" href="./images/icon1.png" type="image/png" sizes="72x72" />
    <title>myCalendar</title>
    <link rel="stylesheet" href="./CSS/main.css">
    <link rel="stylesheet" href="./CSS/current-day-info.css">
    <link rel="stylesheet" href="./CSS/calendar.css">
    <link rel="stylesheet" href="./CSS/modal.css">
    <link rel="stylesheet" href="./CSS/portrait.css">
    <script src="https://kit.fontawesome.com/e45ac9a14a.js" crossorigin="anonymous"></script>

</head>
<style>

</style>

<body>
    <?php
    //$connection = mysqli_connect("localhost", "w200625", '!@#$asdf', "w200625_cal");
    $connection = mysqli_connect("sql203.byethost5.com", "b5_26260316", "37213824", "b5_26260316_calendar");
    if (!$connection) {
        die("There was an error connecting to the database.");
    }
    function db_updateTheme($newTheme)
    {
        global $connection;
        $query = "UPDATE theme SET cur_theme = '$newTheme' WHERE id = 1";
        $result = mysqli_query($connection, $query);
        //查詢失敗的話…
        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        }
    }
    function setTheme()
    {
        global $connection;
        $query = "SELECT * FROM theme";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Something went wrong.. derp");
        }

        while ($row = mysqli_fetch_assoc($result)) {
            return $row['cur_theme'];
        }
    }
    function db_insertNote($uid, $color, $text)
    { //新增記事資料函式
        global $connection;
        $text = mysqli_real_escape_string($connection, $text);
        $query = "INSERT INTO notes(note_id, note_color, note_text) VALUES('$uid', '$color', '$text')";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Something went wrong on line 24");
        }
    }
    function db_updateNote($uid, $text)
    { //更新記事資料函式
        global $connection;
        $text = mysqli_real_escape_string($connection, $text);
        $query = "UPDATE notes SET note_text = '$text' WHERE note_id = '$uid' LIMIT 1";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Something went wrong on line 44");
        }
    }
    function db_deleteNote($uid)
    { //刪除記事資料函式
        global $connection;
        $query = "DELETE FROM notes WHERE note_id = '$uid'";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Something went wrong on line 43");
        }
    }
    //透過關聯陣列$_POST['color']取得傳送過來的color資料
    if (isset($_POST['color'])) {
        db_updateTheme($_POST['color']);
    }
    if (isset($_POST['new_note_uid'])) { //新增記事資料
        db_insertNote($_POST['new_note_uid'], $_POST['new_note_color'], $_POST['new_note_text']);
    }
    if (isset($_POST['update_note_uid'])) { //更新記事資料
        db_updateNote($_POST['update_note_uid'], $_POST['update_note_text']);
    }
    if (isset($_POST['delete_note_uid'])) { //刪除記事資料
        db_deleteNote($_POST['delete_note_uid']);
    }
    ?>

    <?php
    function getNoteData()
    {
        global $connection;
        $query = "SELECT * FROM notes";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Something went wrong on line 66");
        }

        // $id = 0;
        // $color = 1;
        // $text = "";

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['note_id'];
            $color = $row['note_color'];
            $text = $row['note_text'];

            //以上為php碼 
    ?>
            <script type="text/javascript">
                postIt = {
                    id: <?php echo json_encode($id); ?>,
                    note_num: <?php echo json_encode($color); ?>,
                    note: <?php echo json_encode($text); ?>
                }

                postIts.push(postIt);
            </script>

    <?php //再接著php碼，這種寫法在混合式的php、html、JavaScript很常見的寫法，要習慣。
        }
    }
    ?>

    <!-- 左邊日期 -->
    <div id="current-day-info" class="color">
        <h1 id="app-name-landscape" class="off-color default-cursor center">My Calendar</h1>

        <div>
            <h2 id="cur-year" class="current-day-heading default-cursor center">2020</h2>
        </div>

        <div class="">
            <h1 id="cur-day" class="current-day-heading default-cursor center">Wednesday</h1>
            <h1 id="cur-month" class="current-day-heading default-cursor center">July</h1>
            <h1 id="cur-date" class="current-day-heading default-cursor center">15<sup style="font-size: 3vw;">th</sup>
            </h1>
        </div>

        <button id="theme-landscape" class="font button" onclick="openFavColor();">Change theme</button>

    </div>

    <!-- 右邊日曆 -->
    <h3 id="back-year" class="background-text off-color">2020</h3>
    <h4 class="background-text off-color">Calendar</h4>
    <div id="calendar">
        <h1 id="app-name-portrait" class="center off-color">MyCalendar</h1>
        <table>
            <thead class="color">
                <tr>
                    <th colspan="7" class="border-color">
                        <!-- 一格橫跨7格欄位 -->
                        <h4 id="cal-year">2020</h4>
                        <div>
                            <i class="fas fa-caret-left icon" onclick="previousMonth()"></i>
                            <h3 id="cal-month">January</h3>
                            <i class="fas fa-caret-right icon" onclick="nextMonth()"></i>
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
                    <td id="current-day" onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                </tr>
                <tr>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td onclick="dayClicked(this);">1</td>
                    <td class="tooltip" onclick="dayClicked(this);">1<img src="images/note1.png" alt=""><span>這是提示！！！</span></td>
                    <!--           span：單行的DIV -->
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

    <!-- color對話框 -->
    <dialog id="modal">
        <!-- 顏色選擇框 -->
        <div id="fav-color" hidden>
            <div class="popup">
                <h4 class="center">What's your favorite color?</h4>
                <div id="color-options">
                    <div class="color-option">
                        <div class="color-preview" id="blue" style="background-color: #1B19CD;" onclick="addCheckMark('blue');"><i class="fas fa-check checkmark"></i></div>
                        <h5>Blue</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="red" style="background-color: #D01212;" onclick="addCheckMark('red');"></div>
                        <h5>Red</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="purple" style="background-color: #721D89;" onclick="addCheckMark('purple');"></div>
                        <h5>Purple</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="green" style="background-color: #158348;" onclick="addCheckMark('green');"></div>
                        <h5>Green</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="orange" style="background-color: #EE742D;" onclick="addCheckMark('orange');"></div>
                        <h5>Orange</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="deep-orange" style="background-color: #F13C26;" onclick="addCheckMark('deep-orange');"></div>
                        <h5>Deep Orange</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="baby-blue" style="background-color: #31B2FC;" onclick="addCheckMark('baby-blue');"></div>
                        <h5>Baby Blue</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="cerise" style="background-color: #EA3D69;" onclick="addCheckMark('cerise');"></div>
                        <h5>Cerise</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="lime" style="background-color: #36C945;" onclick="addCheckMark('lime');"></div>
                        <h5>Lime</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="teal" style="background-color: #2FCCB9;" onclick="addCheckMark('teal');"></div>
                        <h5>Teal</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="pink" style="background-color: #F50D7A;" onclick="addCheckMark('pink');"></div>
                        <h5>Pink</h5>
                    </div>

                    <div class="color-option">
                        <div class="color-preview" id="black" style="background-color: #212524;" onclick="addCheckMark('black');"></div>
                        <h5>Black</h5>
                    </div>
                </div>
                <button id="update-theme-button" class="button font" onclick="changeColor();">Update</button>
            </div>
        </div>
        <!-- 筆記框 -->
        <div id="make-note" hidden>
            <div class="popup">
                <h4>Add a note to the calendar</h4>
                <textarea id="edit-post-it" class="font" name="post-it" autofocus></textarea>
                <div><button class="button font post-it-button" id="add-post-it" onclick="submitPostIt();">Post
                        It</button>
                    <button class="button font post-it-button" id="delete-button" onclick="deleteNote();">Delete
                        It</button>
                </div>
            </div>
    </dialog>
    </dialog>
    <script type="text/javascript" src="js/update.js"></script>
    <script type="text/javascript" src="js/theme.js"></script>
    <script type="text/javascript" src="js/postIts.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>

    <!-- 呼叫getNoteData程式 -->
    <?php getNoteData(); ?>

    <script>
        currentColor.name = <?php echo (json_encode(setTheme())); ?>; //js_encode將回傳的資料包裝成JSON字串，指定給currentColor.name，其值會被theme的changeColor()裡面利用

        update();

        var today = new Date();
        var todayMonth = today.getMonth();
        var todayYear = today.getFullYear();


        fillInMonth();
    </script>
</body>

</html>