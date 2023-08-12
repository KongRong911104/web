check = "";
document.getElementById('xlsx').onchange = function () {
    check = this.value.replace(/.*[\/\\]/, '').split(".")[1];
    if (check != "xlsx") {
        document.getElementById('xlsx').value = "";
        alert("請選擇.xlsx檔");
    } else {
        var files = document.getElementById('xlsx').files;

        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
            formData.append('my_file[]', files[i]);
        }

        $.ajax({
            url: 'preview_excel.php', // 修改为你的 PHP 文件路径
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById('word_page').innerHTML = response;
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
};
let page2 = 1;
function pre_exdata() {
    if (page2 == 1) {
        $.ajax({
            url: 'preview_exdata.php', // 修改为你的 PHP 文件路径
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                page2 = 0;
                document.getElementById('pre_exdata').innerHTML = "編輯反思表(關閉)";
                document.getElementById('preview_exdata').innerHTML = response;
                document.getElementById('preview_exdata').getElementsByTagName('table')[0].style = "display:block;width:fit-content;";
                var numUsersInput = document.getElementById('numexdatas');
                numUsersInput.addEventListener('input', function () {
                    var numUsers = parseInt(numUsersInput.value);
                    Table(numUsers);
                });

            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });

    }
    else {
        page2 = 1;
        document.getElementById('pre_exdata').innerHTML = "編輯反思表(開啟)";
        document.getElementById('preview_exdata').innerHTML = "";
        // document.getElementById('preview_exdata').getElementsByTagName('table')[0].style = "display:none;";

    }

}
function a() {
    if (document.getElementById('xlsx').value != "" && document.getElementById('years').value != "" && document.getElementById('semester').value != "") {
        document.getElementById('border').style = "display:block";
        document.getElementById('load').style = "display:block";
    }

}
let myDate = new Date();
let thisYear = myDate.getFullYear();
const app = Vue.createApp({
    data() {
        return {
            numbers: []
        }
    },
    created() {
        for (let i = 0; i >= -5; i--) {
            this.numbers.push(thisYear - 1911 + i)
        }
    }
})
app.mount('#years_data')
let page = 1;

function open_word() {
    if (page == 1) {
        document.getElementById("preview").style = "display:block;";
        document.getElementById("wrap").style = "border-top-right-radius: 0%;border-bottom-right-radius: 0%;";
    } else {
        document.getElementById("preview").style = "display:none";
        document.getElementById("wrap").style = "border-top-right-radius: 40px;border-bottom-right-radius: 40px;";
    }

    page = -page;
}

function preview(a) {
    if (document.getElementById("preview_" + a).getElementsByTagName('table')[0].style.display == "none") {
        document.getElementById("preview_" + a).getElementsByTagName('table')[0].style.display = "block";
    }
    else if (document.getElementById("preview_" + a).getElementsByTagName('table')[0].style.display == "block") {
        document.getElementById("preview_" + a).getElementsByTagName('table')[0].style.display = "none"
    }
    else {
        document.getElementById("preview_" + a).getElementsByTagName('table')[0].style.display = "block";
    }
}

function File() {
    var r = event.target;
    var formData = new FormData();
    formData.append('file_name', r.id);
    $.ajax({
        url: 'df.php', // 修改为你的 PHP 文件路径
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            window.location.href = response;
        },
        error: function (xhr, status, error) {
            console.error('文件上传失败:', error);
            // 处理上传失败的错误
        }
    });
}
function delfile(a) {
    var formData = new FormData();
    formData.append('delfile_name', a);
    $.ajax({
        url: 'def.php', // 修改为你的 PHP 文件路径
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function () {
            document.getElementById(a + "_id").remove();
        },
        error: function (xhr, status, error) {
            console.error('文件上传失败:', error);
            // 处理上传失败的错误
        }
    });
}
function del2(a) {
    $.ajax({
        url: 'def2.php', // 修改为你的 PHP 文件路径
        type: 'POST',
        data: {
            class_name: a,
        },
        // contentType: false,
        // processData: false,
        success: function () {
            document.getElementById(a).remove();
        },
        error: function (xhr, status, error) {
            console.error('文件上传失败:', error);
            // 处理上传失败的错误
        }
    });
}
function update_exdata() {
    // var formData = $('#Exdata').serialize();
    // console.log(formData);
    var files = document.getElementsByName("exdata[]");
    // console.log(f);
    var formData = [];
    for (var i = 0; i < files.length; i++) {
        formData.push(files[i].value);
    }
    // console.log(formData);
    $.ajax({
        url: 'update_exdata.php', // 修改为你的 PHP 文件路径
        type: 'POST',
        data: {
            exdata: formData,
        },
        // contentType: false,
        // processData: false,
        success: function () {
            $.ajax({
                url: 'preview_exdata.php', // 修改为你的 PHP 文件路径
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (response) {
                    page2 = 0;
                    document.getElementById('pre_exdata').innerHTML = "編輯反思表(關閉)";
                    document.getElementById('preview_exdata').innerHTML = response;
                    document.getElementById('preview_exdata').getElementsByTagName('table')[0].style = "display:block;width:fit-content;";
                    var numUsersInput = document.getElementById('numexdatas');
                    numUsersInput.addEventListener('input', function () {
                        var numUsers = parseInt(numUsersInput.value);
                        Table(numUsers);
                    });

                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}



function Table(n) {
    var table = document.getElementById('add_extable');
    table.innerText = "";
    table.className="dataframe";
    table.style.display="block";
    table.setAttribute("border",'1');
    var bu = document.getElementById('add_button');
    if (n==0 ||isNaN(n))
        bu.style.display="none";
    else
        bu.style.display="inline";
    for (var i = 0; i < n; i++) {
        var row = document.createElement('tr');
        if (i == 0) {
            var list=["課程名稱",	"每周小時數",	"數學",	"基礎",	"專理",	"專實",	"核1","核2","核3","核4","核5","核6","核7","核8"];
            for (var j = 0; j < 14; j++) {
                var cell = document.createElement('td');
                cell.textContent = list[j];
                row.appendChild(cell);
            }
            table.appendChild(row);
        } 
        var row = document.createElement('tr'); 
        for (var j = 0; j < 14; j++) {
            var cell = document.createElement('td');
            if (j == 0) {
                
                cell.innerHTML = "<input type='text' style='border:none;width:fit-content;height:50px;font-size:25px;' name='add_exdata[]' value='' required='required'>";
            }
            else if (j < 6 && j>0) {

                cell.innerHTML = "<input  type='number'  required='required' name='add_exdata[]' style='border:none;width:60px;height:50px;font-size:25px;' value=0>";
            }
            else{
                cell.innerHTML = '<select style="border:none;width:60px;height:50px;font-size:25px;"  name="add_exdata[]"><option value="■" style="border:none">■</option><option value="NULL" style="border:none"></option></select>';
            }

            row.appendChild(cell);
        }
        table.appendChild(row);
    }
};

function create_exdata() {

    var files = document.getElementsByName("add_exdata[]");
    var formData = [];
    for (var i = 0; i < files.length; i++) {
        if (files[i].value.trim() === "") {
            alert("欄位不可為空");
            return;
          }
        formData.push(files[i].value);
    }
    console.log(formData);
    $.ajax({
        url: 'create_exdata.php', // 修改为你的 PHP 文件路径
        type: 'POST',
        data: {
            add_exdata: formData,
        },
        success: function (response) {
            // console.log(response);
            $.ajax({
                url: 'preview_exdata.php', // 修改为你的 PHP 文件路径
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (response) {
                    page2 = 0;
                    document.getElementById('pre_exdata').innerHTML = "編輯反思表(關閉)";
                    document.getElementById('preview_exdata').innerHTML = response;
                    document.getElementById('preview_exdata').getElementsByTagName('table')[0].style = "display:block;width:fit-content;";
                    var numUsersInput = document.getElementById('numexdatas');
                    numUsersInput.addEventListener('input', function () {
                        var numUsers = parseInt(numUsersInput.value);
                        Table(numUsers);
                    });
                    
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}
// function sign_out(){
//     $.ajax({
//         url: '../top_bar.php', // 修改为你的 PHP 文件路径
//         type: 'POST',
//         success: function (response) {
//             history.go(0)
//         },
//         error: function (xhr, status, error) {
//             console.error(error);
//         }
//     });
// }