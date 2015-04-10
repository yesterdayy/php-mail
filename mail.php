<?php
   $to="test@gmail.com"; // Кому отправить email
   $subject="У нас пополнение"; // Тема сообщения
   $from = "New member <yes@test.com>"; // От кого

   
   $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
   $headers = "From: $from\r\n" .
   "MIME-Version: 1.0\r\n" .
      "Content-Type: multipart/mixed;\r\n" .
      " boundary=\"{$mime_boundary}\"";
	  

   $pictures=explode(" ", $_POST['files']); // Берём ссылки на картинки из формы и разбиваем на массив
   $kolvo=count($pictures);
   

   // Сообщение письма
   $message="Добрый вечер";
   $message . "\n\n";
   $message = "This is a multi-part message in MIME format.\n\n" .
      "--{$mime_boundary}\n" .
      "Content-Type: text/html; charset=\"iso-8859-1\"\n" . // Если хотите в письме не HTML, а просто текст, тогда используйте Content-Type: text/plain
      "Content-Transfer-Encoding: 7bit\n\n" .
   $message . "\n\n";	

   
   // Начинаем вкладывать в письмо файлы
   foreach($pictures as $element){
      $tmp_name = substr($element, 1);
      $name = $element;
		// в данном случае вкладываем только картинки формата .jpg, .jpeg и .png
      if (substr($element, -4)==".jpg") $type = "image/jpeg";
	  else $type = "image/png";
      $size = filesize($tmp_name);;
 	
      $file = fopen($tmp_name,'rb');
      $data = fread($file,filesize($tmp_name));
      fclose($file);
      $data = chunk_split(base64_encode($data));
 
 
      $message .= "--{$mime_boundary}\n" .
         "Content-Type: {$type};\n" .
         " name=\"{$name}\"\n" .
         "Content-Disposition: attachment;\n" .
         " filename=\"{$fileatt_name}\"\n" .
         "Content-Transfer-Encoding: base64\n\n" .
      $data . "\n\n";
   }
   
   
   $message.="--{$mime_boundary}--\n";
   // Отправляем email
   if (@mail($to, $subject, $message, $headers))
      echo "Сообщение отправлено";
   else
      echo "Сообщение не может быть отправлено";

?>