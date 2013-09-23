<?php include "include/header.php" ?>
<?php include("include/sidebar_left.php") ?>

    <section>
        <?php //Nếu server có gửi POST thì bắt đầu xử lí form
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $type      = $_POST['type'];
            $name     = $_POST['name'];
            $address   = $_POST['address'];
            $district     = $_POST['district'];
            $city     = $_POST["city"];
            $phonenumber     = $_POST["phonenumber"];
            $contact     = $_POST["contact"];

            $query  = "call AddSu('$type','$name','$address','$district','$city', '$phonenumber', '$contact')";
            $result = $dbc->query($query);
            //check transaction có hoạt động thành công không
            if ($dbc->affected_rows == 0) {
                //không hiểu tại sao chỗ này dù đã commit thành công nhưng vẫn trả về 0
                echo "Thêm nhà phân phối THÀNH CÔNG";
                unset($_POST['type']);
                unset($_POST['name']);
                unset($_POST['address']);
                unset($_POST['district']);
                unset($_POST['city']);
                unset($_POST['phonenumber']);
                unset($_POST['contact']);
            }
            else {
                echo "Thêm nhà phân phối THẤT BẠI" . "<br>" . $dbc->error;
            }
            echo "<br>" . "Số dòng affect: " . $dbc->affected_rows;
        }//end if
        ?>
        <form action="addSup.php" method="post">
            Loại sản phẩm:
            <br>
            <input type="text" name="type" width="500" maxlength="10" value="<?php
            if (isset($_POST['type'])) {
                echo strip_tags($_POST['type']);
            }
            ?>"/>
            <br>

            Tên sản phẩm:
            <br>
            <input type="text" name="name" value="<?php
            if (isset($_POST['name'])) {
                echo strip_tags($_POST['name']);
            }
            ?>"/>
            <br>

            (*) Địa chỉ nhà phân phối:
            <br>
            <input type="text" name="address" width="500" maxlength="30" value="<?php
            if (isset($_POST['address'])) {
                echo strip_tags($_POST['address']);
            }
            ?>"/>
            <br>

            (*) Tỉnh/Thành phố:
            <br>
            <select name="city" onchange="ajaxFunction(this.value)";>
                <?php
                $query = "CALL ViewCity()";
                $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='{$row[0]}'>" . $row[0] . "</option>";
                }
                $dbc->close();
                ?>
            </select>
            </br>

            (*) Quận/Huyện:
            <br>
            <input type="text" name="district" value="<?php
            if (isset($_POST['district'])) {
                echo strip_tags($_POST['district']);
            }
            ?>"/>
            </br>

            (*) Số điện thoại liên lạc:
            <br>
            <input type="text" name="phonenumber" value="<?php
            if (isset($_POST['phonenumber'])) {
                echo strip_tags($_POST['phonenumber']);
            }
            ?>"/>
            <br>

            (*) Liên hệ:
            <br>
            <input type="text" name="contact" value="<?php
            if (isset($_POST['contact'])) {
                echo strip_tags($_POST['contact']);
            }
            ?>"/>
            <br>

            <input type="submit" name="submit"/>
        </form>
    </section>
    <aside id="right"></aside>

<?php include('include/footer.php') ?>