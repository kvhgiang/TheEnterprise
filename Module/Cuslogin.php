<?php session_start(); // khởi động session ?>
<?php include('include/header.php')?>
<?php include('include/sidebar_left.php')?>

    <section>

        <form action="Cuslogin.php" method="post">

            Username:
            <input type="text" name= "username" width="300" value="<?php
            if (isset($_POST['username'])) { //kiểm tra username có dữ liệu
                echo $_POST['username'];
            }
            ?>"/>
            <br>

            Password:
            <input type="password" name="password" width="300" />
            <br>

            <input type="submit" value="Đăng nhập"/>
            <input type="button" value="Đăng kí"/>
            <input type="button" value="Quên mật khẩu"/>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = "call LoginCustomer('$username','$password')";
            $result = $dbc->query($query) or die($dbc->error);
            $row = $result->fetch_array();
            if($row!=null){ //kiểm tra có dữ liệu hay không
            // tạo các session
            $_SESSION["id"]=$row[0];
            $_SESSION["uid"]=$row[1];
            $_SESSION["grade"]=$row[2];
            $_SESSION["taxCode"]=$row[3];

            // xuất các session
            echo "ID của bạn là: ". $_SESSION['id']."<br/>";
            echo "UID của bạn là: ". $_SESSION['uid']."<br/>";
            echo "Grade của bạn là: ". $_SESSION['grade']."<br/>";
            echo "TaxCode của bạn là: ". $_SESSION['taxCode']."<br/>";
            }
            else
                echo "<script> alert('Bạn nhập sai username hoặc password');</script>";

        }//end if REQUEST_METHOD==POST
        ?>
    </section>
    <aside id="right"></aside>

<?php include('include/footer.php')?>