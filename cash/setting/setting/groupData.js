function groupData() {
    $.ajax({
        url: 'groupData.php', // 修改为你的 PHP 文件路径
        type: 'POST',
        success: function (response) {
            var group_div = document.getElementById('group_list');
            group_div.innerHTML = response;
            get_up(0);
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}