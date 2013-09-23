<?php session_start(); ?>
<?php include('include/header.php') ?>
<?php include('include/sidebar_left.php') ?>

    <section>
        <form action="SeachDepartment.php" method="post">

            Chi nhánh phòng ban:
            <br>
            <select name="chinhanh">
                <?php
                $query = "CALL viewDepartment()";
                $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='".$row[0]."'>" . $row[1] . "</option>";
                }
                $result->free();
                $dbc->next_result();
                ?>

            </select>
            <input type="submit"/>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $chinhanh=$_POST['chinhanh'];

            $query = "call GetEmpByWorkAt($chinhanh)";


            $result = $dbc->query($query) or die($dbc->error);
            while($row = $result->fetch_array()){
                $_SESSION["id"]=$row[0];
                $_SESSION["ho"]=$row[4];
                $_SESSION["lot"]=$row[5];
                $_SESSION["ten"]=$row[6];
                $_SESSION["ngay"]=$row[12];
                $_SESSION["thang"]=$row[13];
                $_SESSION["nam"]=$row[14];
                $_SESSION["phong"]=$row[7];
                $_SESSION["vitri"]=$row[8];
                $_SESSION["tinhtrang"]=$row[9];
                $_SESSION["dc"]=$row[16];
                $_SESSION["quan"]=$row[17];
                $_SESSION["tp"]=$row[18];
                $_SESSION["dt"]=$row[19];
                $_SESSION["anh"]=$row[20];

                echo "Họ tên: " . $row[4]." ".$row[5]." ".$row[6] . "<br>";
                echo "Ngày sinh: " . $row[12]."/".$row[13]."/".$row[14] . "<br>";
                echo "Phòng: " . $row[7] . "<br>";
                echo "Vị trí: " . $row[8] . "<br>";
                echo "Tình trạng: " . $row[9] . "<br>";
                echo "Ngày vào: " . date('d/m/Y',strtotime($row[15])) . "<br>";
                echo "Địa chỉ: " . $row[16]." - ".$row[17]." - ".$row[18] . "<br>";
                echo "Số điện thoại: " . $row[19] . "<br>";
                echo "Ảnh đại diện: " . $row[20] . "<br>";
                echo "<a href='EditEmployee.php?id=".$row['0']."'><input type='button' value='Chỉnh sửa'></a>";
                echo "-----------------------------------------------------------------<br>";
            }
        }//end if REQUEST_METHOD==POST
        ?>

    </section>
    <aside id="right"></aside>

<?php include('include/footer.php') ?>