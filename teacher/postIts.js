var postIts = []; //記事陣列，用來放置月曆中的記事物件資料
var currentPostItID = 0;  //目前記事資料編號
var newCurrentPostIt = false; //布林變數，預設為false，表示不是新的記事資料(已有資料在postIts中)
var currentPostItIndex = 0; //用來檢索記事資料陣列(集合)的索引變數

function deleteNote(){
  document.getElementById("edit-post-it").value = "";
  if (!newCurrentPostIt) { //如果該日期有記事資料的話
    //加入刪除記事資料的ajax呼叫
    ajax(
      {
        delete_note_uid: postIts[currentPostItIndex].id
      }
    );     
    postIts.splice(currentPostItIndex,1); //刪除該日期的記事資料
  }
  console.log(postIts);
  fillInMonth();
  closeMakeNote();
}

function dayClicked(elm){ //elm: element，指向觸發dayClicked方法的物件
  // console.log(elm.dataset.uid); 
  //elm.dataset.uid是我們要用到的記事資料id
  currentPostItID = elm.dataset.uid;
  currentDayHasNote(currentPostItID);//判斷目前點蠕擊的日期是否有記事資料
  openMakeNote();
}

function currentDayHasNote(uid){ //測試特定UID是否已經有記事
    for(var i = 0; i < postIts.length; i++){
        if(postIts[i].id == uid){
            newCurrentPostIt = false;
            currentPostItIndex = i; //若找到符合的記事資料，讓currentPostItIndex記錄記事資料在陣列中的索引值
            return;
        }
    }
    newCurrentPostIt = true; //上面的迴圈找不到任何符合的記事資料，表示目前這個日子是沒有記事資料的…
}

function getRandom(min, max) { //  min <= x < max, x是整數亂數
  return Math.floor(Math.random() * (max - min) ) + min;
}  

function submitPostIt(){ //按了PostIt按鍵後，所要執行的方法
    const value = document.getElementById("edit-post-it").value;
    document.getElementById("edit-post-it").value = "";
    let num = getRandom(1, 6); //取得1~5的整數亂數，用來標示便利貼顏色的檔案代號
    let postIt = {
        id: currentPostItID,
        note_num: num,
        note: value
    }

    if(newCurrentPostIt){ //如果是新記事的話
        postIts.push(postIt); //將新記事postIT物件推入postIts陣列
        //加入新增記事資料的ajax呼叫
        ajax(
           {
            new_note_uid: postIt.id, 
            new_note_color: postIt.note_num, 
            new_note_text: postIt.note
           }
        );         
    } else {
        postIts[currentPostItIndex].note = postIt.note; //更新現有記事物件的記事資料
        //加入更新記事資料的ajax呼叫
        ajax(
            {
              update_note_uid: postIts[currentPostItIndex].id, 
              update_note_text: postIt.note
            }
        );        
    }

    console.log(postIts);
    fillInMonth(); //立即更新月曆表格，處理便利圖貼與提示字串
    closeMakeNote();
}

function openMakeNote(){
  var modal = document.getElementById("modal");
  modal.open = true; //將對話方塊打開
  var template = document.getElementById("make-note");
  template.removeAttribute("hidden");
  document.getElementById("edit-post-it").focus(); //游標跳至文字輸入方塊中

  if (!newCurrentPostIt) {
    document.getElementById("edit-post-it").value = postIts[currentPostItIndex].note;
  }
  
}

function closeMakeNote(){
  var modal = document.getElementById("modal");
  modal.open = false; //將對話方塊關閉
  var template = document.getElementById("make-note");
  template.setAttribute("hidden", "hidden");
}
