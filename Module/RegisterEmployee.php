<?php include "include/header.php" ?>
<?php include("include/sidebar_left.php") ?>

    <section>
    <?php //Nếu server có gửi POST thì bắt đầu xử lí form
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $fname = $_POST['fname'];
        $workat = $_POST['workat'];
        $position = $_POST['position'];
        $status = $_POST['status'];
        $bday = $_POST['bday'];
        $bmonth = $_POST['bmonth'];
        $byear = $_POST['byear'];
        $hiredate = $_POST['hiredate'];
        $address = $_POST['address'];
        $district = $_POST['district'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $avatar = $_POST['avatar'];

        $query  = "call RegisterEmployee('$username','$pass','$lname','$mname','$fname',$workat,'$position','$status',$bday,$bmonth,$byear,'$hiredate','$address','$district','$city','$phone','$avatar')";
        $result = $dbc->query($query);
        //check transaction có hoạt động thành công không
        if ($dbc->affected_rows == 0) {
            //không hiểu tại sao chỗ này dù đã commit thành công nhưng vẫn trả về 0
            echo "Thêm nhân viên thành công";
        }
        else {
            echo "Thêm nhân viên thất bại" . "<br>" . $dbc->error;
        }
        echo "<br>" . "Số dòng affect: " . $dbc->affected_rows;
    }//end if
    ?>
    <form action="RegisterEmployee.php" method="post">
        Username:
        <br>
        <input type="text" name="username" width="500" />
        <br>
        Password:
        <br>
        <input type="password" name="pass" width="500" />
        <br>

        Họ:
        <br>
        <input type="text" name="lname" width="500" maxlength="10" />
        <br>

        Tên lót:
        <br>
        <input type="text" name="mname" width="500" maxlength="10" />
        <br>

        Tên:
        <br>
        <input type="text" name="fname" width="500" maxlength="10" />
        <br>
        WorkAt:
        <br>
        <input type="text" name="workat" width="500" />
        <br>

        Chức vụ:
        <br>
        <select name="position">
            <?php
            $query = "CALL ViewEmpPosition()";
            $result = $dbc->query($query);
            while ($row = $result->fetch_array()) {
                echo "<option>".$row[1]."</option>";

            }
            $result->free();
            $dbc->next_result();
            ?>
        </select>
        <br>

        Tình trạng:
        <br>
        <select name="status">
            <?php
            $query = "call ViewEmpStatus()";
            $result = $dbc->query($query);
            while ($row = $result->fetch_array()) {
                echo "<option>" . $row[0] . "</option>";
            }
            $result->free();
            $dbc->next_result();
            ?>
        </select>
        <br>

        Ngày sinh:
        <br>
        <input type="text" name="bday" width="500"/>
        <br>

        Tháng sinh:
        <br>
        <input type="text" name="bmonth" width="500"/>
        <br>

        Năm sinh:
        <br>
        <input type="text" name="byear" width="500"/>
        <br>

        Ngày nhận việc:
        <br>
        <input type="date" name="hiredate" width="500"/>
        <br>

        Địa chỉ:
        <br>
        <input type="text" name="address" width="500"/>
        <br>

        Huyện/Tỉnh/Thành phố:
        <br>
        <select name="city">
            <?php
            $query = "CALL ViewCity()";
            $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
            while ($row = mysqli_fetch_array($result)) {
                echo "<option>" . $row[0] . "</option>";
            }
            $dbc->close();
            ?>
        </select>
        <br>

        Quận:
        <br>
        <input type="text" name="district" width="500"/>
        <br>

        Số điên thoại:
        <br>
        <input type="text" name="phone" width="500"/>
        <br>

        Hình đại diện:
        <br>
        <input type="text" name="avatar" width="500"/>
        <input type="button" name="upload" value="upload"/>

        <input type="submit" name="submit"/>
    </form>
    </section>
    <aside id="right"></aside>

<?php include('include/footer.php') ?>