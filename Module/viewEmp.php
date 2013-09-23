<?php session_start(); ?>
<?php include('include/header.php') ?>
<?php include('include/sidebar_left.php') ?>

	<section>
		<form action="viewEmp.php" method="post">

			ID nhân viên:
			<br>
			<input type="text" width="300" name="empID" value="<?php
				if (isset($_POST['empID'])) {
					echo $_POST['empID'];
				}
			?>"/>
            <br>
            Tên nhân viên:
            <br>
            <input type="text" width="300px" name="empLName" value="<?php
            if (isset($_POST['empLName'])) {
                echo $_POST['empLName'];
            }
            ?>"/>
            <input type="text" width="300" name="empMName" value="<?php
            if (isset($_POST['empMName'])) {
                echo $_POST['empMName'];
            }
            ?>"/>
            <input type="text" width="300" name="empFName" value="<?php
            if (isset($_POST['empFName'])) {
                echo $_POST['empFName'];
            }
            ?>"/>
            <br>


			<input type="submit"/>
		</form>
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$empID = $_POST['empID'];
                $empLName=$_POST['empLName'];
                $empMName=$_POST['empMName'];
                $empFName=$_POST['empFName'];

                if($empID!=""){
				    $query = "call GetEmpByID($empID)";
                }
                else {
                    $query = "call GetEmpByName('$empLName','$empMName','$empFName')";}

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