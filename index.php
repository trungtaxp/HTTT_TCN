<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tính Thuế</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div style="height: 100px">
        </div>
    </div>

    <form action="xuly.php" method="post">
        <div class="form-group-1">
            <h3>Thông tin cá nhân</h3>
            <p>Họ và tên: <input type="text" name="name" value="" placeholder="Ho va ten"></p>
            <p>Số điện thoại: <input type="text" name="sdt" value="" placeholder="0123456789"></p>
            <p>Giới tính: Nam <input type="radio" name="gioitinh" value="Nam"> Nữ <input type="radio" name="gioitinh"
                                                                                       value="Nữ"></p>


            <p>Thành phố: <input type="text" name="city" value="" placeholder="Hà Nội"></p>

            <p>Bảo hiểm xã hội: Yes <input type="radio" name="baohiem" value="Yes"> No <input type="radio"
                                                                                               name="baohiem" value="No">
            </p>

            <p>Số người phụ thuộc: <input type="text" name="songuoipt" value="" placeholder="0"></p>
            <p>Mức miễn trừ với người lao động: <input type="text" name="trulaodong" value="" placeholder="11"> Triệu vnd</p>
            <p>Mức miễn trừ với người phụ thuộc: <input type="text" name="truphuthuoc" value="" placeholder="4.4">Triệu vnd</p>

        </div>

        <div class="form-group-2">
            <h3>Thu nhập cá nhân(triệu vnd)</h3>
            <p>Tháng 1: <input type="text" name="thang1" value=""></p>
            <p>Tháng 2: <input type="text" name="thang2" value=""></p>
            <p>Tháng 3: <input type="text" name="thang3" value=""></p>
            <p>Tháng 4: <input type="text" name="thang4" value=""></p>
            <p>Tháng 5: <input type="text" name="thang5" value=""></p>
            <p>Tháng 6: <input type="text" name="thang6" value=""></p>
            <p>Tháng 7: <input type="text" name="thang7" value=""></p>
            <p>Tháng 8: <input type="text" name="thang8" value=""></p>
            <p>Tháng 9: <input type="text" name="thang9" value=""></p>
            <p>Tháng 10: <input type="text" name="thang10" value=""></p>
            <p>Tháng 11: <input type="text" name="thang11" value=""></p>
            <p>Tháng 12: <input type="text" name="thang12" value=""></p>
        </div>

        <button type="submit">Xác nhận</button>
    </form>

</div>

</body>
</html>