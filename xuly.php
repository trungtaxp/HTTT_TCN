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

<p>Họ và tên: <?php if (isset($_POST["name"])) {
        echo $_POST["name"];
    } ?></p>
<p>Số điện thoại: <?php if (isset($_POST["sdt"])) {
        echo $_POST["sdt"];
    } ?></p>
<p>Giới tính: <?php if (isset($_POST["gioitinh"])) {
        echo $_POST["gioitinh"];
    } ?></p>
<p>Thành phố: <?php if (isset($_POST["city"])) {
        echo $_POST["city"];
    } ?></p>
<p>Bảo hiểm y tế: <?php if (isset($_POST["baohiem"])) {
        echo $_POST["baohiem"];
    } ?></p>


<table class="table table-bordered">
    <tr>
        <th>Tháng</th>
        <th>Thu Nhập(Triệu VND)</th>
        <th>Thuế thu nhập(Triệu VND)</th>
    </tr>
    <tbody>
    <?php
    for ($i = 1; $i <= 12; $i++) {
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td><p>";
        if (isset($_POST["thang$i"])) {
            echo $_POST["thang$i"];
        }
        echo "</p></td>";

        echo "<td><p>";
        if (isset($_POST["thang$i"])) {
            $a = floatval($_POST["thang$i"]);
            $b = floatval($_POST["songuoipt"]);
            $arraythuedanop[] = tienthuethang($a, $b);
            $arraythuethucte[] = $a;
            echo round(tienthuethang($a, $b), 2);
        }
        echo "</p></td>";

        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<div class="thunhap">
    <h3>Tổng thuế TNCN đã nộp:
        <?php
        $sumdanop = array_sum($arraythuedanop);
        echo $sumdanop;
        ?>
    </h3>
    <h3>Tổng thuế TNCN thực tế:
        <?php
        $sumthucte = array_sum($arraythuethucte);
        $c = $sumthucte / 12;
        $d = floatval($_POST["songuoipt"]);
        $sumthuctenop = tienthuethang($c, $d) * 12;
        echo $sumthuctenop;
        ?>
    </h3>

    <?php
    if ($sumdanop > $sumthuctenop) {
        echo "<h3>Nhận lại:" . ($sumdanop - $sumthuctenop) . "</h3>";
    } else {
        echo "<h3>Trả thêm:" . ($sumthuctenop - $sumdanop) . "</h3>";
    }
    ?>


</div>

</body>
</html>

<?php

function tienthuethang($tienthunhap, $songuoiphuthuoc)
{
    if ($_POST["baohiem"] === "Yes") {
        if ($_POST["trulaodong"] != NULL) {
            $c = floatval($_POST["trulaodong"]);
            if ($_POST["truphuthuoc"] != NULL) {
                $d = floatval($_POST["truphuthuoc"]);
            } else {
                $d = 4.4;
            }
        } else {
            $c = 11;
            $d = floatval($_POST["truphuthuoc"]);
        }
        $baohiem = $tienthunhap * 0.08;
        $nguoithuphuoc = $songuoiphuthuoc * $d;
        $thuethunhap = $tienthunhap - $c - $nguoithuphuoc - $baohiem;
        return tinhthue($thuethunhap);
    } else {
        if ($_POST["trulaodong"] != NULL) {
            $c = floatval($_POST["trulaodong"]);
            if ($_POST["truphuthuoc"] != NULL) {
                $d = floatval($_POST["truphuthuoc"]);
            } else {
                $d = 4.4;
            }
        } else {
            $c = 11;
            $d = floatval($_POST["truphuthuoc"]);
        }
        $nguoithuphuoc = $songuoiphuthuoc * $d;
        $thuethunhap = $tienthunhap - $c - $nguoithuphuoc;
        return tinhthue($thuethunhap);
    }
}

function tinhthue($thuethunhap)
{
    if ($thuethunhap < 0) {
        return $thuethunhap = 0.0;
    }

    if ($thuethunhap <= 5) {
        return $thuethunhap = $thuethunhap * 0.05;
    }

    if ($thuethunhap > 5 & $thuethunhap <= 10) {
        return $thuethunhap = $thuethunhap * 0.1 - 0.25;
    }

    if ($thuethunhap > 10 & $thuethunhap <= 18) {
        return $thuethunhap = $thuethunhap * 0.15 - 0.75;
    }

    if ($thuethunhap > 18 & $thuethunhap <= 32) {
        return $thuethunhap = $thuethunhap * 0.2 - 1.65;
    }

    if ($thuethunhap > 32 & $thuethunhap <= 52) {
        return $thuethunhap = $thuethunhap * 0.25 - 3.25;
    }

    if ($thuethunhap > 52 & $thuethunhap <= 80) {
        return $thuethunhap = $thuethunhap * 0.30 - 5.85;
    }

    if ($thuethunhap > 80) {
        return $thuethunhap = $thuethunhap * 0.35 - 9.85;
    }
}

// ket noi datebase
$link = mysqli_connect("localhost", "root", "root", "ThueTNCN");

// Kiểm tra kết nối
if ($link === false) {
    die("ERROR: Không thể kết nối. " . mysqli_connect_error());
}
//Làm sạch dữ liệu đầu vào để đảm bảo an toàn
$Name = mysqli_real_escape_string($link, $_POST['name']);
$Phone = mysqli_real_escape_string($link, $_POST['sdt']);
$Sex = mysqli_real_escape_string($link, $_POST['gioitinh']);
$City = mysqli_real_escape_string($link, $_POST['city']);
$BHXH = mysqli_real_escape_string($link, $_POST['baohiem']);
$SNPT = mysqli_real_escape_string($link, $_POST['songuoipt']);
$MTLD = mysqli_real_escape_string($link, $_POST['trulaodong']);
$MTPT = mysqli_real_escape_string($link, $_POST['truphuthuoc']);

$str1 = implode(", ", $arraythuethucte);
$TNCN = mysqli_real_escape_string($link, $str1);

$str2 = implode(", ", $arraythuedanop);
$TTN = mysqli_real_escape_string($link, $str2);

$TTDN = mysqli_real_escape_string($link, $sumdanop);
$TTTT = mysqli_real_escape_string($link, $sumthuctenop);


// Cố gắng thực thi câu lệnh insert
$sql = "INSERT INTO Thongtin (Name, Phone, Sex, City, BHXH, SNPT, MTLD, MTPT, TNCN, TTN, TTDN, TTTT) VALUES ('$Name', '$Phone', '$Sex', '$City', '$BHXH', '$SNPT', '$MTLD', '$MTPT', '$TNCN', '$TTN', '$TTDN', '$TTTT')";
if (mysqli_query($link, $sql)) {
} else {
    echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);

?>