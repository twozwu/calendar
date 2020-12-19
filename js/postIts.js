var postIts = [];  //記事資料庫
var currentPostItId = 0;  //目前的記事ID
var newCurrentPostIt = false;  //判斷目前的記事是否為新
var currentPostItIndex = 0;  //資料庫索引值



function dayClicked(elm) {
    // console.log(elm.dataset.uid);
    currentPostItId = elm.dataset.uid;
    currentDayHasNote(currentPostItId);
    openMakeNote();
}

function currentDayHasNote(uid) { //測試特定UID是否已經有記事
    for (var i = 0; i < postIts.length; i++) {
        if (postIts[i].id == uid) {
            newCurrentPostIt = false;
            currentPostItIndex = i;
            return;
        }
        console.log();
    }
    newCurrentPostIt = true;
}
function getRandom(min, max) { //傳回介於min與max間的亂數值
    return Math.floor(Math.random() * (max - min)) + min;
}

function submitPostIt() { //按了PostIt按鍵後，所要執行的方法
    const value = document.getElementById("edit-post-it").value;
    document.getElementById("edit-post-it").value = "";
    let num = getRandom(1, 6); //取得1~6的亂數，用來標示便利貼顏色的檔案代號
    let postIt = {
        id: currentPostItId,
        note_num: num,
        note: value
    }
    if (newCurrentPostIt) { //如果是新記事的話
        postIts.push(postIt); //將新記事postIT物件推入postIts陣列
    } else {
        postIts[currentPostItIndex].note = postIt.note; //更新現有記事物件的記事資料
    }
    // console.log(postIts)
    fillInMonth(); //送出之後再更新格子一次
    closeMakeNote();
}

function deleteNote() {
    document.getElementById("edit-post-it").value = "";
    // let indexToDel;
    if (!newCurrentPostIt) {
        postIts.splice(currentPostItIndex, 1);
    }
    // if (indexToDel != undefined) {
    //     postIts.splice(indexToDel, 1);
    // }
    fillInMonth();
    closeMakeNote();
}

function openMakeNote() {
    var modal = document.getElementById("modal");
    modal.open = true;
    var template = document.getElementById("make-note");
    template.removeAttribute("hidden");
    document.getElementById("edit-post-it").focus(); //游標跳至文字輸入方塊中
    if (!newCurrentPostIt) { //呼叫舊資料
        document.getElementById("edit-post-it").value = postIts[currentPostItIndex].note;
    }
}
function closeMakeNote() {
    var modal = document.getElementById("modal");
    modal.open = false;
    var template = document.getElementById("make-note");
    template.setAttribute("hidden", "hidden");
}