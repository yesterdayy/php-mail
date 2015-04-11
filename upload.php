 <?php
if (!empty($_FILES)) {

 $tempFile = $_FILES['file']['tmp_name'];
 $filenameFileLocal = iconv("UTF-8","WINDOWS-1251",$_FILES['file']['name']); 
 // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
 $targetPath = $_SERVER['DOCUMENT_ROOT'].'/backup/';
 // Adding timestamp with image's name so that files with same name can be uploaded easily.
 $mainFile = $targetPath . $filenameFileLocal;
 move_uploaded_file($tempFile,$mainFile);

}
?>