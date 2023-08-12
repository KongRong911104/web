function top_drag() {
        $(".permissionlist_style").draggable({
            appendTo: "body",
            scroll: false,
            helper: function (event) {
                return $("<div class='ui-clone'>" + $(this).text().substring(0, $(this).text().length / 2) + "</div>");
            },
            create: function (ui) {
                var eq = $(this).attr("id").split(" ").pop();
                $(this).attr('data-index', eq);
            },
            revert: "invalid",
        });
        $(".grouptop").droppable({
            scroll: false,
            drop: function (e, ui) {
                // console.log(ui.draggable.context.className.split(' ')[0]);
                if (ui.draggable.context.className == 'group_li_style' || ui.draggable.context.className.split(' ')[0] == 'permissionlist_style') {
                    if (ui.draggable.context.className.split(' ')[0] == 'permissionlist_style') {
                        var permissionlist = document.getElementById('permission_list');
                        // console.log(permissionlist.childNodes.item((ui.draggable.context.getAttribute('data-index'))-1));
                        for (var i = 0; i < permissionlist.childNodes.length; i++) {
                            // console.log(permissionlist.childNodes.item(i));
                            if (ui.draggable.context.getAttribute('data-index') == permissionlist.childNodes.item(i).getAttribute('data-index')) {
                                permissionlist.childNodes.item(i).remove();
                            }
                        }
                    }
                    $(ui.draggable).remove();
                }

            },
            revert: true,
        });
}