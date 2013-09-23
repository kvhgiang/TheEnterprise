<?php include('include/header.php')?>
<?php include('include/sidebar_left.php')?>

    <section>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $makh = $_POST['makh'];
            $username = $_POST['username'];
            $password = $_POST['repassword'];
            $ho = $_POST['ho'];
            $lot = $_POST['lot'];
            $ten = $_POST['ten'];

            $ngay = $_POST['ngay'];
            $thang = $_POST['thang'];
            $nam = $_POST['nam'];
            $joindate = $_POST['joindate'];
            $dc = $_POST['dc'];
            $tp = $_POST['tp'];
            $quan = $_POST['q'];
            $dt = $_POST['sdt'];
            $email = $_POST['email'];
            if($makh==null){
                $query = "call RegisterCustomer('$username','$password','$ho','$lot','$ten',$ngay,$thang,$nam,'$dc','$tp','$quan','$dt','$email','$joindate')";
            }
            else{
                $query = "call RegisterCustomer2($makh,'$username','$password','$ho','$lot','$ten',$ngay,$thang,$nam,'$dc','$tp','$quan','$dt','$email','$joindate')";
            }
            $dbc->query($query) or trigger_error($dbc->error);
            if ($dbc->affected_rows >= 0) {
                $message = "Đăng ký thành công" . "<br>";
            }
            else {
                $message = "Đăng ký thất bại" . "<br>" . $dbc->error;
            }

        }//end if
        echo $message;
        ?>
        <form action="RegisterCustomer.php" method="post">
            Mã khách hàng (nếu có):
            <input type="text" name= "makh" width="300" />
            <br/>

            Username:
            <input type="text" name= "username" width="300" />
            <br/>

            Password:
            <input type="password" name="repassword" width="300" />
            <br/>

            Họ:
            <input type="text" name="ho" width="300">
            <br>
            Tên lót:
            <input type="text" name="lot" width="300">
            <br>
            Tên:
            <input type="text" name="ten" width="300">
            <br>

            Ngày sinh:
            <input type="text" name="ngay" width="300">
            <br>
            Tháng sinh:
            <input type="text" name="thang" width="300">
            <br>
            Năm sinh:
            <input type="text" name="nam" width="300">
            <br>

            Ngày tham gia:
            <input type="date" name="joindate"/>
            <br>

            Địa chỉ:
            <input type="text" name="dc" width="300">
            <br>
            Thành phố:
            <select name="tp">
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
            <input type="text" name="q" width="300">
            <br>

            Số điện thoại:
            <input type="text" name="sdt" width="300">
            <br>
            Email:
            <input type="text" name="email" width="300">
            <br>

            <input type="submit" value="Đăng kí"/>
            <input type="reset" name="btnnhaplai" value="Nhập lại" />

        </form>

    </section>
    <aside id="right"></aside>

<?php include('include/footer.php')?>