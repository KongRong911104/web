// var content; // 視窗變數，用來判斷用哪些函式
$(document).ready(function () {
    $('.group_li_style').dblclick(function () { // 點擊兩下.grouplist_style開啟/關閉懸浮視窗
        // console.log(event.target.className.split(" ")[0] );
        if (event.target.className.split(" ")[0] == 'group_li_style') {
            var button_type = document.getElementById('mini_data_sent');
            button_type.onclick = role_permission_sent_data;
            $('#content').toggle();
            $('.black_overlay').toggle();
            var role_size = document.getElementById("role_list");
            role_size.setAttribute('style', "width: 100%;height: 100%;");
            $(function () {
                $(".mini_peoplelist_style").draggable({ //人員的拖移
                    revert: "invalid", //動畫預設為：當放下時的位置不符設定將回到原點
                    scroll: false, //拖曳時範圍不會滾動
                    appendTo: "#role_list", //拖曳目標的父元素
                    helper: function (event) { //拖曳時的css
                        return $("<div class='mini_ui-clone'>" + $(this).text().substring(0, $(this).text().length / 2) + "</div>");
                    },
                    connectToSortable: '#role_list', //接受拖曳元素的對象
                });
                $("#role_list").droppable({
                    scroll: false,
                    drop: function (e, ui) {
                        $(this).addClass($(ui.draggable).attr('class', 'mini_peoplelist_style2'));
                        // $(this).addClass($(ui.draggable.children(".tooltiptext2")).toggleClass('tooltiptext2 tooltiptext'));
                        $(ui.draggable).css("font-size", 200 + "%");
                        $(ui.draggable).css("width", 50 + "%");
                        $(this).addClass($(ui.draggable).attr('name', 'role_peoples[]'));
                    },
                });
                $(".mini_roletop").droppable({
                    scroll: false,
                    drop: function (e, ui) {
                        console.log(ui.draggable.context);
                        if (ui.draggable.context.className.split(" ")[0] == 'mini_peoplelist_style2' || ui.draggable.context.className.split(" ")[0] == 'mini_peoplelist_style') {
                            if (ui.draggable.context.className.split(" ")[0] == 'mini_peoplelist_style') {
                                var peoplelist = document.getElementById('people_list');
                                // console.log(peoplelist.childNodes.item((ui.draggable.context.getAttribute('data-index'))-1));
                                for (var i = 0; i < peoplelist.childNodes.length; i++) {
                                    // console.log(peoplelist.childNodes.item(i));
                                    if (ui.draggable.context.getAttribute('data-index') == peoplelist.childNodes.item(i).getAttribute('data-index')) {
                                        peoplelist.childNodes.item(i).remove();
                                    }
                                }
                            }
                            $("#role_list").sortable("option", "revert", false);
                            console.log(ui.draggable.context.className.split(" ")[0]);
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