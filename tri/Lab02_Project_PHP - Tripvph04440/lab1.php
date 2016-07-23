	

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
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

	$query = "INSERT INTO sinhvien VALUES (n'$masv',n'$hoten',n'$diachi','$tuoi','$gioitinh',n'$quocgia')";
	$xoa="AB0001";
	$querydel ="DELETE FROM `sinhvien` WHERE `sinhvien`.`MaSV` = '$xoa'";

	$result = $db->exec($query);
	echo "Đã thêm $result vào cơ sở dữ liệu";
	echo "<br> Mã Sinh Viên : ".$masv."</br>"."Họ Tên : ".$hoten."</br>"."Địa Chỉ : ".$diachi."</br>"."Giới tính : ".$gioitinh."</br>"."Quốc Gia : ".$quocgia."</br>"."Tuổi : ".$tuoi;
 ?>
 </body>
 <form action="edit-index.php">
 	<input type="submit" name="ok" value="Sửa">
 </form>
 </html>