var currentColor = { name: "blue", color: "#1B19CD", off_color: "#7c7EFB" };
var colorData = [
    {
        name: 'blue',
        color_code: '#1B19CD',
        off_color_code: '#7C7EFB'
    }, {
        name: 'red',
        color_code: '#D01212',
        off_color_code: '#EEA19B'
    }, {
        name: 'purple',
        color_code: '#721D89',
        off_color_code: '#EBADFB'
    }, {
        name: 'green',
        color_code: '#158348',
        off_color_code: '#57C664'
    }, {
        name: 'orange',
        color_code: '#EE742D',
        off_color_code: '#F7A77A'
    }, {
        name: 'deep-orange',
        color_code: '#F13C26',
        off_color_code: '#F77D59'
    }, {
        name: 'baby-blue',
        color_code: '#31B2FC',
        off_color_code: '#3D8DD9'
    }, {
        name: 'cerise',
        color_code: '#EA3D69',
        off_color_code: '#FCBECC'
    }, {
        name: 'lime',
        color_code: '#2ACC32',
        off_color_code: '#4FFA4F'
    }, {
        name: 'teal',
        color_code: '#2FCCB9',
        off_color_code: '#7FE7E3'
    }, {
        name: 'pink',
        color_code: '#F50D7A',
        off_color_code: '#FFB9EA'
    }, {
        name: 'black',
        color_code: '#212524',
        off_color_code: '#687E7B'
    }
]
function addCheckMark(colorName) {
    currentColor.name = colorName; //將勾選的色彩名稱color_name指定給全域變數currentColorName，以便在changeColor方法裏使用，來設定整個主題的色彩。
    // console.log(currentColor.name);
    //清除/移除類別有"checkmark"的元素，也就是清除掉勾選的顯示
    var colorPreviews = document.getElementsByClassName("color-preview");

    for (i = 0; i < colorPreviews.length; i++) {
        colorPreviews[i].innerHTML = '';
    }
    //插入勾勾的class標籤
    for (i = 0; i < colorPreviews.length; i++) {
        if (colorPreviews[i].id == colorName) {

            colorPreviews[i].innerHTML = "<i class='fas fa-check checkmark'></i>";
        }
    }
}
function openFavColor() {
    var modal = document.getElementById("modal");
    modal.open = true;
    var template = document.getElementById("fav-color");
    template.removeAttribute("hidden");
}
function closeFavColor() {
    var modal = document.getElementById("modal");
    modal.open = false;
    var template = document.getElementById("fav-color");
    template.setAttribute("hidden", "hidden");
}
function changeColor() {

    for (i = 0; i <= colorData.length; i++) {
        var cd = colorData[i];

        if (currentColor.name === cd.name) {
            // console.log(currentColor.name);
            currentColor.color = cd.color_code;
            currentColor.off_color = cd.off_color_code;
            // console.log(currentColor.name + '，' + currentColor.color + '，' + currentColor.off_color);
            break;
        }

    }
    var elements;

    //先清除掉所有的style設置(td)
    elements = document.getElementsByTagName("td");
    for (let i = 0; i < elements.length; i++) {
        elements[i].style = null;
    }
    //改變目前的色彩設置
    elements = document.getElementsByClassName("color");
    for (let i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = currentColor.color;
    }
    elements = document.getElementsByClassName("border-color");
    for (let i = 0; i < elements.length; i++) {
        elements[i].style.borderColor = currentColor.color;
    }
    elements = document.getElementsByClassName("off-color");
    for (let i = 0; i < elements.length; i++) {
        elements[i].style.color = currentColor.off_color;
    }

    closeFavColor();
    // console.log("改變顏色完成");
}


var date = document.getElementsByTagName("td"); //取得所有td的元素值(共41格)