<?php session_start(); ?>
<?php include "include/header.php" ?>
<?php include("include/sidebar_left.php") ?>

    <section>
        <?php //Nếu server có gửi POST thì bắt đầu xử lí form
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id=$_SESSION['id'];
            $lname = $_POST['lname'];
            $mname = $_POST['mname'];
            $fname = $_POST['fname'];
            $workat = $_POST['workat'];
            $position = $_POST['position'];
            $status = $_POST['status'];
            $bday = $_POST['bday'];
            $bmonth = $_POST['bmonth'];
            $byear = $_POST['byear'];

            $address = $_POST['address'];
            $district = $_POST['district'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $avatar = $_POST['avatar'];

            $query  = "call UpdateEmployee($id,'$lname','$mname','$fname',$workat,'$position','$status',$bday,$bmonth,$byear,'$address','$district','$city','$phone','$avatar')";
            $result = $dbc->query($query);
            //check transaction có hoạt động thành công không
            if ($dbc->affected_rows == 0) {
                //không hiểu tại sao chỗ này dù đã commit thành công nhưng vẫn trả về 0
                echo "Cập nhật thành công";
            }
            else {
                echo "Cập nhật thất bại" . "<br>" . $dbc->error;
            }
            echo "<br>" . "Số dòng affect: " . $dbc->affected_rows;
        }//end if
        ?>
        <form action="EditEmployee.php" method="post">
            Họ:
            <br>
            <input type="text" name="lname" width="500" value="<?=$_SESSION['ho']; ?>" />
            <br>

            Tên lót:
            <br>
            <input type="text" name="mname" width="500" value="<?=$_SESSION['lot']; ?>" />
            <br>

            Tên:
            <br>
            <input type="text" name="fname" width="500" value="<?=$_SESSION['ten']; ?>" />
            <br>
            WorkAt:
            <br>
            <input type="text" name="workat" value="<?=$_SESSION['phong']; ?>"/>
            <br>

            Chức vụ:
            <br>
            <select name="position">
                <option><?=$_SESSION['vitri']; ?></option>
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
                <option><?=$_SESSION['tinhtrang']; ?></option>
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
            <input type="text" name="bday" value="<?=$_SESSION['ngay']; ?>"/>
            <br>

            Tháng sinh:
            <br>
            <input type="text" name="bmonth" value="<?=$_SESSION['thang']; ?>"/>
            <br>

            Năm sinh:
            <br>
            <input type="text" name="byear" value="<?=$_SESSION['nam']; ?>"/>
            <br>

            Địa chỉ:
            <br>
            <input type="text" name="address" value="<?=$_SESSION['dc']; ?>"/>
            <br>

            Huyện/Tỉnh/Thành phố:
            <br>
            <select name="city">
                <option><?=$_SESSION['tp']; ?></option>
                <<?php
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
            <input type="text" name="district" value="<?=$_SESSION['quan']; ?>"/>
            <br>

            Số điên thoại:
            <br>
            <input type="text" name="phone" value="<?=$_SESSION['dt']; ?>"/>
            <br>

            Hình đại diện:
            <br>
            <input type="text" name="avatar" value="<?=$_SESSION['anh']; ?>"/>
            <input type="button" name="upload" value="upload"/>

            <input type="submit" name="submit" value="cập nhật"/>
        </form>
    </section>
    <aside id="right"></aside>

<?php include('include/footer.php') ?>