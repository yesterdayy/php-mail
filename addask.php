<!-- Будем заливать только картинки. И использовать AJAX. Допустим мы берём библиотеку dropzone. Тогда... -->
<script src="dropzone.js"></script> <!-- В моём случае он урезан. Убрал то, что мне не было нужно. Так что если хотите увидеть полный функционал, качайте с офф. сайта -->
<script>
Dropzone.options.myAwesomeDropzone = {
	paramName: "file",
	maxFilesize: 7, // MB
	maxFiles: 2,
	acceptedFiles: ".jpg, .jpeg, .gif, .png, .bmp",	
	init: function() {
		this.on("success", function(file) {
			document.getElementById("pictures").value+="/directory/"+file.name+" "; // Полная директория картинки (file.name -> имя картинки.jpg)
			$("#checksss").prop( "disabled", false );
		});
	}
};
</script>


<form method="post" action="javascript:void(null);" onsubmit="call()" id="formmail">
	<input type = "hidden" value = "" name = "files" id="pictures">
	<p>Загрузите фото</p>
	<input type = "submit" id = "submitbutton" class="but" value="Отправить заявку">
</form>

<form action="/upload.php" class="dropzone" id="myAwesomeDropzone" style = "position: absolute;top: 1180px;"></form>


<script>
function call() {
	var msg   = $('#formmail').serialize();
	$.ajax({
		type: 'POST',
		url: 'mail.php',
		data: msg,
		success: function(data) {
		alert('Письмо отправленo');
		},
		error:  function(xhr, str){
		alert('Возникла ошибка: ' + xhr.responseCode);
	}
	});
}
</script>