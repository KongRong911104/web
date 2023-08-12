
$(document).ready(function () {
    $("#search_button_id").click(function (data) {
        var store_name = document.getElementById("search_name_id").value;
        // console.log(store_name);
        $("#table_id").empty();
        $.ajax({
            type: 'POST',
            url: "search_store.php",
            data: { store_name: store_name },
            success: function (msg) {
                if (msg != "none") {
                    var matrix_s = [];
                    // console.log(msg);
                    msg = msg.split(" ");
                    msg.pop();
                    // console.log(msg);
                    var s_r_len = msg.length;
                    for (var i = 0; i < (s_r_len / 7); i++) {
                        var m = [msg[0 + (7 * i)], msg[1 + (7 * i)], msg[2 + (7 * i)], msg[3 + (7 * i)], msg[4 + (7 * i)], msg[5 + (7 * i)], msg[6 + (7 * i)]];
                        // console.log(m);
                        matrix_s.push(m);
                    }

                    for (var j = 0; j < matrix_s.length; j++) {
                        var r = document.createElement("tr");
                        r.id = "s" + matrix_s[j][0];
                        // console.log(r.id);
                        r.className = "tr_class";
                        r.addEventListener(
                            "click",
                            function () {
                                var record = document.getElementById("search_name_id");
                                if (record.hasAttribute("class")) {
                                    document.getElementById(record.className).className="tr_class";
                                    document.getElementById("edit_name_id").setAttribute("disabled", "disabled");
                                    document.getElementById("edit_o_h").setAttribute("disabled", "disabled");
                                    document.getElementById("edit_o_m").setAttribute("disabled", "disabled");
                                    document.getElementById("edit_c_h").setAttribute("disabled", "disabled");
                                    document.getElementById("edit_c_m").setAttribute("disabled", "disabled");
                                    $("input[name='edit_day[]']").each(function () {
                                        $(this).prop("checked", false);
                                        $(this).attr("disabled", "disabled");
                                    });
                                    document.getElementById("edit_sub").setAttribute("disabled", "disabled");
                                }
                                document.getElementById(this.id).className="dark_b";
                                record.className = this.id;
                                // console.log(record.className);
                                var S = this.id.split("s");
                                var SS="s"+this.id;
                                // console.log(S);//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                                document.getElementById("SID_id").setAttribute("value", S[1]);
                                document.getElementById("edit_name_id").setAttribute("value", document.getElementById(SS + "0").innerHTML);
                                var t_s = document.getElementById(SS + "1").innerHTML.split(" : ");
                                // console.log(t_s);
                                $("#edit_o_h").prop("value", t_s[0]);
                                $("#edit_o_m").prop("value", t_s[1]);
                                t_s = document.getElementById(SS + "2").innerHTML.split(" : ");
                                // console.log(t_s);
                                $("#edit_c_h").prop("value", t_s[0]);
                                $("#edit_c_m").prop("value", t_s[1]);
                                if (document.getElementById(SS + "3").innerHTML != "無") {
                                    t_s = document.getElementById(SS + "3").innerHTML.split(" ");
                                    t_s.pop();
                                    for (var n = 0; n < t_s.length; n++) {
                                        switch (t_s[n]) {
                                            case "一":
                                                $("#edit_mon").prop("checked", true);
                                                break;
                                            case "二":
                                                $("#edit_tue").prop("checked", true);
                                                break;
                                            case "三":
                                                $("#edit_wed").prop("checked", true);
                                                break;
                                            case "四":
                                                $("#edit_thu").prop("checked", true);
                                                break;
                                            case "五":
                                                $("#edit_fri").prop("checked", true);
                                                break;
                                            case "六":
                                                $("#edit_sat").prop("checked", true);
                                                break;
                                            case "日":
                                                $("#edit_sun").prop("checked", true);
                                                break;
                                        }
                                    }
                                }
                                else {
                                    $("input[name='edit_day[]']").each(function () {
                                        $(this).prop("checked", false);
                                    });
                                }
                                // console.log(S[1]);

                                document.getElementById("edit_btn").removeAttribute("disabled");
                                document.getElementById("delete_btn").removeAttribute("disabled");
                            }
                        );
                        for (var k = 0; k < 4; k++) {
                            var d = document.createElement("td");
                            d.id = "s"+r.id+k;
                            d.className = "td_class";
                            switch (k) {
                                case 0:
                                    d.innerHTML = matrix_s[j][1];
                                    break;
                                case 1:
                                    if (matrix_s[j][3] == "0") {
                                        d.innerHTML = matrix_s[j][2] + " : " + matrix_s[j][3] + "0";
                                    }
                                    else {
                                        d.innerHTML = matrix_s[j][2] + " : " + matrix_s[j][3];
                                    }
                                    break;
                                case 2:
                                    if (matrix_s[j][5] == "0") {
                                        d.innerHTML = matrix_s[j][4] + " : " + matrix_s[j][5] + "0";
                                    }
                                    else {
                                        d.innerHTML = matrix_s[j][4] + " : " + matrix_s[j][5];
                                        //console.log("this "+matrix_s[j][3]+" "+typeof(matrix_s[j][3]));//++++++++++++++++++++++++++++++++++++++++++++++++++
                                    }
                                    break;
                                case 3:
                                    if (matrix_s[j][6] != "0") {
                                        var days = matrix_s[j][6].split(",");
                                        // console.log(days);
                                        var day = "";
                                        for (var l = 0; l < days.length; l++) {
                                            switch (days[l]) {
                                                case "1":
                                                    day += "一";
                                                    break;
                                                case "2":
                                                    day += "二";
                                                    break;
                                                case "3":
                                                    day += "三";
                                                    break;
                                                case "4":
                                                    day += "四";
                                                    break;
                                                case "5":
                                                    day += "五";
                                                    break
                                                case "6":
                                                    day += "六";
                                                    break;
                                                case "7":
                                                    day += "日";
                                                    break;
                                            }
                                            day += " ";
                                        }
                                        // console.log("day:"+day);
                                        d.innerHTML = day;
                                    }
                                    else {
                                        d.innerHTML = "無";
                                    }
                                    break;
                            }
                            r.appendChild(d);
                        }
                        document.getElementById("table_id").appendChild(r);
                        document.getElementById(r.id).className="tr_class";
                    }
                    // var ctext = document.createTextNode(msg);
                    // c.appendChild(ctext);
                    // document.getElementById(id_).className = "lyrics";
                    // document.getElementById(id_).draggable = 'True';
                }
                else {
                    window.alert("無符合結果");
                }
            }
        });
    });
});

function b_search() {
    // $("#edit_mon").prop("checked",true);
    null;
}

function edit_btn_c() {
    document.getElementById("edit_name_id").removeAttribute("disabled");
    document.getElementById("edit_o_h").removeAttribute("disabled");
    document.getElementById("edit_o_m").removeAttribute("disabled");
    document.getElementById("edit_c_h").removeAttribute("disabled");
    document.getElementById("edit_c_m").removeAttribute("disabled");
    $("input[name='edit_day[]']").each(function () {
        $(this).removeAttr("disabled");
    });
    document.getElementById("edit_sub").removeAttribute("disabled");
    document.getElementById("SID_id").removeAttribute("disabled");
    document.getElementById("add_btn").setAttribute("disabled", "disabled");
    document.getElementById("delete_btn").setAttribute("disabled", "disabled");
    document.getElementById("edit_btn").setAttribute("disabled", "disabled");
}

function edit_sub_c() {
    document.getElementById("edit_id").submit();
}

function add_btn_c() {
    document.getElementById("add_name_id").removeAttribute("disabled");
    document.getElementById("add_o_h").removeAttribute("disabled");
    document.getElementById("add_o_m").removeAttribute("disabled");
    document.getElementById("add_c_h").removeAttribute("disabled");
    document.getElementById("add_c_m").removeAttribute("disabled");
    $("input[name='add_days[]']").each(function () {
        $(this).removeAttr("disabled");
    });
    document.getElementById("add_sub").removeAttribute("disabled");
    document.getElementById("delete_btn").setAttribute("disabled", "disabled");
    document.getElementById("edit_btn").setAttribute("disabled", "disabled");
    document.getElementById("add_btn").setAttribute("disabled", "disabled");
}

function add_sub_c() {
    document.getElementById("add_id").submit();
}

function delete_btn_c() {
    var del_id = document.getElementById("search_name_id").className;
    del_id = del_id.split("s");
    document.getElementById("del_name_id").setAttribute("value", del_id[1]);
    console.log(del_id[1]);
    document.getElementById("del_id").submit();
}

function back_c(){
    window.location.href='index.html';
}