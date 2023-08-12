function get_roleid(a) {
    // console.log(a)
    var people_top = document.getElementById("mini_roletop_word");
    people_top.innerHTML = event.target.innerText.split("\n")[0];
    if (document.getElementById('content').style.display != "block") {
        document.getElementById('content').style.display = "block";
        document.getElementById('black_overlay').style.display = "block";
        var GR = a.split("_")
        $.ajax({
            url: 'GRData.php', // 修改为你的 PHP 文件路径
            type: 'POST',
            data: {
                groupID: GR[0],
                roleID: GR[1]
            },
            success: function (response) {
                var group_div = document.getElementById('role');
                group_div.innerHTML = response;
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}

function rgbToHex(color) {
    if (color) {
        rgb = color.substring(4, color.length - 1).split(',');
        const r = parseInt(rgb[0].trim(), 10).toString(16).padStart(2, '0');
        const g = parseInt(rgb[1].trim(), 10).toString(16).padStart(2, '0');
        const b = parseInt(rgb[2].trim(), 10).toString(16).padStart(2, '0');
        return "#" + r + g + b;
    }
    return null;
}

function set_color(a) {
    let color = document.getElementById("color_" + a);
    let r = document.getElementById('g_' + a);
    let timeoutId;
    color.addEventListener('input', function (e) {
        r.style.backgroundColor = (this.value);
        // 如果之前有設定過 timeout，就先清除它
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // 設定新的 timeout，延遲 500 毫秒 (0.5 秒)
        timeoutId = setTimeout(function () {
            $.ajax({
                url: 'groupColor.php', // 修改为你的 PHP 文件路径
                type: 'POST',
                data: {
                    groupID: a,
                    groupColor: rgbToHex(r.style.backgroundColor)
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }, 500);
    });
}
function mini_sent_data() {
    var selectedGRP = [];
    var check1 = 0;
    var grValue = "";
    $('input[name="GRP"][type="checkbox"]:checked').each(function () {
        selectedGRP.push($(this).val());
        if (check1 == 0) {
            grValue = $(this).attr('gr');
            check1 = 1;
        }
    });
    var selectedGRU = [];
    $('input[name="GRU"][type="checkbox"]:checked').each(function () {
        selectedGRU.push($(this).val());
    });
    var postData = {
        GR: grValue,
        selectedGRP: selectedGRP,
        selectedGRU: selectedGRU,
    };

    // 發送POST請求
    $.ajax({
        type: 'POST',
        url: 'GRUpdate.php',
        data:
            postData,
        success: function (response) {
            // 請求成功處理
            // console.log(response);
        },
        error: function (error) {
            // 請求失敗處理
            console.error(error);
        }
    });
}
