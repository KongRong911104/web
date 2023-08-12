//滑鼠右鍵預設選單事件

document.oncontextmenu = function (ev) {
    var oevent = ev || event;
    var myMenu = document.getElementById('myMenu');
    //彈出自定義選單
    var point=event.target.id.split('_').pop();
    myMenu.setAttribute('data-index',point);
    // console.log(myMenu.getAttribute('data-index'));
    if (event.target.className.split(' ')[0] == 'grouplist_style') {
        myMenu.style.display = 'block';
        //設定自定義選單的座標，達到滑鼠右鍵的地方彈出自定義選單
        myMenu.style.left = oevent.clientX + 'px';
        myMenu.style.top = oevent.clientY + 'px';

        //禁用右鍵預設選單
        return false;
    }

}
//點選頁面任意區域，隱藏自定義選單
document.onclick = function () {
    var myMenu = document.getElementById('myMenu');
    myMenu.style.display = 'none';
}
//顯示div
function del_group() {
    var Id=document.getElementById('set_id').getAttribute('data-index');
    var myMenu = document.getElementById('myMenu');
    // alert(myMenu.getAttribute('data-index'));
    var form_button=document.getElementById('del_groupname');
    form_button.value=JSON.stringify([myMenu.getAttribute('data-index'),Id]);
    var form=document.getElementById('del_group');
    form.submit();
}