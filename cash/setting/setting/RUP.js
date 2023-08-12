function get_up(a) {
    if (a == 0) {
        $.ajax({
            url: 'roleData.php',
            type: 'POST',
            success: function (response) {
                document.getElementById("permission_list").innerHTML = response;
                var elements = document.querySelectorAll(".permissionlist_style");

                // 将所有元素的指针样式更改为"grab"
                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.cursor = "grab";
                }
                document.getElementById("mini_usertop_word1").style.backgroundColor = "#c4fdb4"
                document.getElementById("mini_usertop_word2").style.backgroundColor = ""
                document.getElementById("mini_usertop_word3").style.backgroundColor = ""
                drag();
                document.getElementById("createRUP").onclick = function () {
                    createRUP(0);
                };
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
    else if (a == 1) {
        // 使用者內容
        $.ajax({
            url: 'userData.php',
            type: 'POST',
            success: function (response) {
                document.getElementById("permission_list").innerHTML = response;
                var elements = document.querySelectorAll(".permissionlist_style");

                // 将所有元素的指针样式更改为"grab"
                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.cursor = "auto";
                }
                document.getElementById("mini_usertop_word1").style.backgroundColor = ""
                document.getElementById("mini_usertop_word2").style.backgroundColor = "#c4fdb4"
                document.getElementById("mini_usertop_word3").style.backgroundColor = ""
                // 假設您的 draggable 元素有一個特定的類別，比如 'my-draggable'
                var myDraggableElement = $("#permission_list");

                // 檢查元素是否已經初始化了 draggable
                if (myDraggableElement.hasClass("ui-draggable")) {
                    // 如果已經初始化，則執行 destroy 方法
                    myDraggableElement.draggable("destroy");
                }

                document.getElementById("createRUP").onclick = function () {
                    createRUP(1);

                };
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
    else if (a == 2) {
        // 權限內容
        $.ajax({
            url: 'permissionData.php',
            type: 'POST',
            success: function (response) {
                document.getElementById("permission_list").innerHTML = response;
                var elements = document.querySelectorAll(".permissionlist_style");

                // 将所有元素的指针样式更改为"grab"
                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.cursor = "auto";
                }
                document.getElementById("mini_usertop_word1").style.backgroundColor = ""
                document.getElementById("mini_usertop_word2").style.backgroundColor = ""
                document.getElementById("mini_usertop_word3").style.backgroundColor = "#c4fdb4"
                var myDraggableElement = $("#permission_list");

                // 檢查元素是否已經初始化了 draggable
                if (myDraggableElement.hasClass("ui-draggable")) {
                    // 如果已經初始化，則執行 destroy 方法
                    myDraggableElement.draggable("destroy");
                }
                document.getElementById("createRUP").onclick = function () {
                    createRUP(2);
                };
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}