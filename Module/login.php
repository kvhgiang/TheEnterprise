<?php session_start(); //Khởi động session ?>
<?php include('include/header.php')?>
<?php include('include/sidebar_left.php')?>

	<section>

		<form action="login.php" method="post">
			Username:
			<input type="text" name= "username" width="300" value="<?php
            if (isset($_POST['username'])) { //kiểm tra username có giá trị
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

            $query = "call LoginEmployee('$username','$password')";
            $result = $dbc->query($query) or die($dbc->error);
            $row = $result->fetch_array();
            if($row!=null){ // kiểm tra dữ liệu có hay không
            // tạo các session
            $_SESSION["id"]=$row[0];
            $_SESSION["uid"]=$row[1];
            $_SESSION["name"]=$row[2];
            $_SESSION["work"]=$row[3];
            $_SESSION["position"]=$row[4];
            $_SESSION["workAt"]=$row[5];
            // Xuất các session
            echo "ID của bạn là: ". $_SESSION['id']."<br/>";
            echo "UID của bạn là: ". $_SESSION['uid']."<br/>";
            echo "Name của bạn là: ". $_SESSION['name']."<br/>";
            echo "WorkAt của bạn là: ". $_SESSION['work']."<br/>";
            echo "Position của bạn là: ". $_SESSION['position']."<br/>";
            echo "Status của bạn là: ". $_SESSION['workAt']."<br/>";
            }
            else
                echo "<script> alert('Bạn nhập sai username hoặc password');</script>";
        }//end if REQUEST_METHOD==POST
        ?>
	</section>
	<aside id="right"></aside>

<?php include('include/footer.php')?>