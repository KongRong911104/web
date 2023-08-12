// var content; // 視窗變數，用來判斷用哪些函式
$(document).ready(function () {
    $('.managersize').dblclick(function () { // 點擊兩下.grouplist_style開啟/關閉懸浮視窗
        // console.log(event.target.className.split(" ")[0] );
        if (event.target.className == 'managersize') {
            var button_type=document.getElementById('mini_data_sent');
            button_type.onclick=mini_sent_data;
            $('#content').toggle();
            $('.black_overlay').toggle();
            var top=document.getElementById('mini_roletop_word');
            top.innerHTML="管理員名單";
            var role_size=document.getElementById("role_list");
            role_size.setAttribute('style',"width: 100%;height: 100%;");
            $(function () {
                $(".mini_peoplelist_style").draggable({ //人員的拖移
                    revert: "invalid", //動畫預設為：當放下時的位置不符設定將回到原點
                    scroll: false, //拖曳時範圍不會滾動
                    appendTo: "#role", //拖曳目標的父元素
                    helper: function (event) { //拖曳時的css
                        return $("<div class='mini_ui-clone'>" + $(this).text().substring(0, $(this).text().length / 2) + "</div>");
                    },
                    connectToSortable: '#role_list', //接受拖曳元素的對象
                    create: function () { //創建元素id，防止重複
                        var eq = $(this).attr("id").split(" ").pop();
                        $(this).attr('data-index', eq);
                    },

                });
                $("#role_list").droppable({
                    scroll: false,
                    drop: function (e, ui) {
                        $(this).addClass($(ui.draggable).attr('class', 'mini_role_li_style'));
                        $(this).addClass($(ui.draggable.children(".tooltiptext2")).toggleClass('tooltiptext2 tooltiptext'));
                        $(ui.draggable).css("font-size", 60 / $(ui.draggable).text().length + "px");
                        // $(this).addClass($(ui.draggable).attr('name','role_peoples[]'));
                    },
                });
                $(".mini_roletop").droppable({
                    scroll: false,
                    drop: function (e, ui) {
                        // console.log(ui.draggable.context.className);
                        if (ui.draggable.context.className == 'mini_role_li_style') {
                            $("#role_list").sortable("option", "revert", false);
                            $(ui.draggable).remove();
                            setTimeout(
                                function () {
                                    $("#role_list").sortable("option", "revert", true);
                                }, 200);
                        }
                    },
                });
                $("#role_list").sortable({
                    scroll: false,
                    Handles: "#role_list",
                    appendTo: "#content",
                    helper: function (event, ui) {
                        var t = ui.text();
                        return $("<div class='mini_ui-clone'>" + t.substring(0, t.length / 2) + "</div>");
                    },
                    receive: function (event, ui) {
                        var uiIndex = ui.item.attr('data-index');
                        var uiId = ui.item.id;
                        var item = $("#role_list").find('[data-index=' + uiIndex + '] ');
                        if (item.length > 1) {
                            item.last().remove();
                        }
                    },
                    revert: true,
                });

            });
            content = document.getElementById('content').style.display;
            // console.log(content);
        }
    });
    document.addEventListener('dblclick', function () {
        $('#content').hide();
        $('.black_overlay').hide();
        // content = document.getElementById('content').style.display;
    }, true);
});