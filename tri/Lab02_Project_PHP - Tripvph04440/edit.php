
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<meta charset="utf-8">
 </head>
 <body>
 		<?php 
 	$dsn = 'mysql:host=localhost;dbname=sinhvien';
	$username='root';
	$password='';
	$db = new PDO($dsn,$username,$password);	


	$masv=$_POST['MaSV'];

	$hoten=$_POST['HoTen'];

	$diachi=$_POST['DiaChi'];

	$gioitinh=$_POST['GioiTinh'];

	$quocgia=$_POST['QuocGia'];

	$tuoi= $_POST['Tuoi'];

	$query = "	UPDATE `sinhvien` SET `TenSV` = n'$hoten', `Tuoi` = '$tuoi', `QuocGia` = n'$quocgia',`DiaChi`= n'$diachi' WHERE `sinhvien`.`MaSV` = n'$masv'";
	$result = $db->exec($query);
	echo "Đã sửa $result vào cơ sở dữ liệu";
	echo "<br> Mã Sinh Viên : ".$masv."</br>"."Họ Tên : ".$hoten."</br>"."Địa Chỉ : ".$diachi."</br>"."Giới tính : ".$gioitinh."</br>"."Quốc Gia : ".$quocgia."</br>"."Tuổi : ".$tuoi;
 ?>
 </body>
 </html>