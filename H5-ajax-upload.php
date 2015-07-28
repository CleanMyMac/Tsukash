<?php
if (isset($_POST['upload'])) { 
	var_dump($_FILES);
	move_uploaded_file($_FILES['upfile']['tmp_name'], 'up_tmp/'.time().'.dat');
	//header('location: test.php');
	exit;
}
?>
<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<title>HTML5 Ajax Uploader</title>
<script src="jquery-2.1.1.min.js"></script>
</head>

<body>
<p><input type="file" id="upfile"></p>
<p><input type="button" id="upJS" value="用原生JS上传"></p>
<p><input type="button" id="upJQuery" value="用jQuery上传"></p>
<script>
/*原生JS版*/
document.getElementById("upJS").onclick = function() {
	/* FormData 是表单数据类 */
	var fd = new FormData();
	var ajax = new XMLHttpRequest();
	fd.append("upload", 1);
	/* 把文件添加到表单里 */
	fd.append("upfile", document.getElementById("upfile").files[0]);
	ajax.open("post", "test.php", true);

	ajax.onload = function () {
		console.log(ajax.responseText);
	};

	ajax.send(fd);
	
}

/* jQuery 版 */
$('#upJQuery').on('click', function() {
	var fd = new FormData();
	fd.append("upload", 1);
	fd.append("upfile", $("#upfile").get(0).files[0]);
	$.ajax({
		url: "test.php",
		type: "POST",
		processData: false,
		contentType: false,
		data: fd,
		success: function(d) {
			console.log(d);
		}
	});
});
</script>
</body>
</html>