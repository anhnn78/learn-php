
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<meta charset="utf-8">
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 	
 	<form action="edit.php" method="post">
 		<h3>Mã SV</h3><input type="text" name="MaSV" placeholder="Chọn Mã SV " required>
 		<h3>Họ tên</h3><input type="text" name="HoTen" placeholder="Sửa  Họ Tên" required>
 		<h3>Địa Chỉ</h3><input type="text" name="DiaChi" placeholder="Sửa  Địa Chỉ" required>
 		<h3>Giới Tính</h3>
 		<input type="radio" name="GioiTinh" value="1" checked><span>Nam</span><br>
  		<input type="radio" name="GioiTinh" value="0"><span>Nữ</span><br>
  		<input type="radio" name="GioiTinh" value="3"> <span>Giới tính khác</span> </br>
 		<h3>Quốc gia</h3><input type="text" name="QuocGia" placeholder="Sửa  Quốc gia" required>
 		<h3>Tuổi</h3><input type="number" min="1" max="100" name="Tuoi" required>
 		<input type="submit" name="OK" value="Sửa" >
 	</form>
 </body>
 </html>
 