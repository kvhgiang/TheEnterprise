<?php session_start(); ?>
<?php include('include/header.php')?>
<?php include('include/sidebar_left.php')?>

    <section>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho = $_POST['ho'];
            $lot = $_POST['lot'];
            $ten = $_POST['ten'];
            $grade=$_POST['grade'];
            $ngay = $_POST['ngay'];
            $thang = $_POST['thang'];
            $nam = $_POST['nam'];
            $joindate = $_POST['joindate'];
            $dc = $_POST['dc'];
            $tp = $_POST['tp'];
            $quan = $_POST['q'];
            $dt = $_POST['sdt'];
            $email = $_POST['email'];
            $query = "call updateCustomer('$grade',$id,'$ho','$lot','$ten',$ngay,$thang,$nam,'$dc','$tp','$quan','$dt','$email','$joindate')";
            $dbc->query($query) or trigger_error($dbc->error);
            if ($dbc->affected_rows >= 0) {
                $message = "Cập nhật thành công" . "<br>";
            }
            else {
                $message = "Cập nhật thất bại" . "<br>" . $dbc->error;
            }
        }//end if
        echo $message;
        ?>

        <form action="EditCustomer.php" method="post">

            Họ:
            <input type="text" name="ho" width="300" value="<?=$_SESSION['ho']; ?>">
            <br>
            Tên lót:
            <input type="text" name="lot" width="300" value="<?=$_SESSION['lot']; ?>">
            <br>
            Tên:
            <input type="text" name="ten" width="300" value="<?=$_SESSION['ten']; ?>">
            <br>

            Loại khách hàng:
            <select name="grade">
                <option><?=$_SESSION['gra']; ?></option>
                <option>vãng lai</option>
                <option>thường xuyên</option>
                <option>thân thiết</option>
                <option>VIP</option>
            </select>
            <br>

            Ngày sinh:
            <input type="text" name="ngay" width="300" value="<?=$_SESSION['ngay']; ?>">
            <br>
            Tháng sinh:
            <input type="text" name="thang" width="300" value="<?=$_SESSION['thang']; ?>">
            <br>
            Năm sinh:
            <input type="text" name="nam" width="300" value="<?=$_SESSION['nam']; ?>">
            <br>

            Ngày tham gia:
            <input type="date" name="joindate"value="<?=$_SESSION['joindate']; ?>">
            <br>

            Địa chỉ:
            <input type="text" name="dc" width="300" value="<?=$_SESSION['dc']; ?>">
            <br>
            Thành phố:
            <select name="tp">
                <option><?=$_SESSION['tp']; ?></option>
                <?php
                $query1 = "CALL ViewCity()";
                $result = $dbc->query($query1) or die($dbc->error);
                while($row = $result->fetch_array()){
                    echo "<option value='{$row[0]}'>" . $row[0] . "</option>";
                }
                $dbc->close();
                ?>
            </select>
            <br>
            Quận:
            <input type="text" name="q" width="300" value="<?=$_SESSION['quan']; ?>">
            <br>

            Số điện thoại:
            <input type="text" name="sdt" width="300" value="<?=$_SESSION['dt']; ?>">
            <br>
            Email:
            <input type="text" name="email" width="300" value="<?=$_SESSION['email']; ?>">
            <br>


            <input type="submit" value="Cập nhật"/>
            <input type="reset" name="btnnhaplai" value="Nhập lại" />

        </form>

    </section>
    <aside id="right"></aside>

<?php include('include/footer.php')?>