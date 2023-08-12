function sent_data() {
    // 获取所有class为"group_li_style"的li元素
    const groupLiElements = document.querySelectorAll("li.group_li_style");
	var isConfirmed = window.confirm("你確定要新增嗎？");
    // 使用forEach循环遍历每个元素并输出data-index值
    groupLiElements.forEach(function(li) {
      const dataIndexValue = li.dataset.index;

	  if (isConfirmed) {
	  $.ajax({
		  url: 'createGR.php',
		  type: 'POST',
		  data: {
			  GR: dataIndexValue
		  },
		  success: function (response) {
			  groupData();
		  },
		  error: function (xhr, status, error) {
			  console.error(error);
		  }
	  });}
    });
}
function del_GR(a){
	var isConfirmed = window.confirm("你確定要刪除嗎？");
    if (isConfirmed) {
    $.ajax({
        url: 'delGR.php',
        type: 'POST',
        data: {
            GR: a
        },
        success: function (response) {
            groupData();
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });}
}