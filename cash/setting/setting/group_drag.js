// 拖曳
// console.log(content);FIRST_X_DISPLAY_NUMBER
function drag() {

    $(".permissionlist_style").draggable({
        appendTo: "body",
        scroll: false,
        helper: function (event) {
            return $("<div class='ui-clone'>" + $(this).text().split(" ")[0] + "</div>");
        },
        connectToSortable: '.grouplist_style',

        revert: "invalid",

    });
    $(".grouplist_style").droppable({
        scroll: false,
        drop: function (e, ui) {
            var targetElement = $(e.target);

            setTimeout(function () {
                // console.log($(ui.draggable).text().split(" ")[0])
                var textLength = $(ui.draggable).text().split(" ")[0].length;
                var span = $(ui.draggable).html().replace("tooltiptext2", "tooltiptext");
                var newElement = $("<li></li>").html(span);
                newElement.css("font-size", 50 / textLength + "px");




                var dataIndexValue = $(ui.draggable).attr("data-index");

                if (dataIndexValue && dataIndexValue.indexOf("_") == -1) {
                    var sn = targetElement.attr("id").split("_")[1] + "_" + $(ui.draggable).attr("data-index");
                } else {
                    var sn = $(ui.draggable).attr("data-index");
                }
                newElement.addClass('group_li_style'); // Add the group_li_style class
                newElement.attr('data-index', sn);
                newElement.css('cursor', 'pointer');
                newElement.find("span.material-symbols-outlined").attr("onclick", "del_GR("+sn+");");
                newElement.on("dblclick", function () {
                    get_roleid(String(sn));
                });
                var flag = 1
                targetElement.find('li').each(function () {
                    var liContent = $(this);
                    // console.log(liContent);
                    var dataIndexValue = liContent.attr('data-index'); // 获取 data-index 属性的值
                    if (dataIndexValue == sn)
                        flag = 0
                });

                //   console.log(newElement.data('index'))
                if (flag)
                    targetElement.append(newElement);
            }, 50);
        },
    });
}
