<?php include "include/header.php" ?>
<?php include("include/sidebar_left.php") ?>

	<section>
		<?php //Nếu server có gửi POST thì bắt đầu xử lí form
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$username   = $_POST['username'];
				$lname      = $_POST['lname'];
				$mname      = $_POST['mname'];
				$fname      = $_POST['fname'];
				$position   = $_POST['position'];
				$status     = $_POST['status'];
				$bday       = $_POST['bday'];
				$bmonth     = $_POST['bmonth'];
				$byear      = $_POST['byear'];
				$hiredate   = $_POST['hiredate'];
				$address    = $_POST['address'];
				$district   = $_POST['district'];
				$city       = $_POST['city'];
				$phone      = $_POST['phone'];
				$avatar     = $_POST['avatar'];

				$query  = "call AddEmployee('$username','$lname','$mname','$fname','$position','$status',$bday,$bmonth,$byear,'$hiredate','$address','$district','$city','$phone','$avatar')";
				$result = $dbc->query($query);
				//check transaction có hoạt động thành công không
				if ($dbc->affected_rows == 0) {
					//không hiểu tại sao chỗ này dù đã commit thành công nhưng vẫn trả về 0
					echo "Thêm nhân viên thành công";
				   	unset($_POST['username']);
				   	unset($_POST['lname']);
				   	unset($_POST['mname']);
				   	unset($_POST['fname']);
                    unset($_POST['place']);
				   	unset($_POST['position']);
				   	unset($_POST['status']);
				   	unset($_POST['bday']);
				   	unset($_POST['bmonth']);
				   	unset($_POST['byear']);
				   	unset($_POST['hiredate']);
				   	unset($_POST['address']);
				   	unset($_POST['district']);
				   	unset($_POST['city']);
				   	unset($_POST['phone']);
				   	unset($_POST['avatar']);
				}
				else {
					echo "Thêm nhân viên thất bại" . "<br>" . $dbc->error;
				}
				echo "<br>" . "Số dòng affect: " . $dbc->affected_rows;
			}//end if
		?>
		<form action="addEmp.php" method="post">
			Họ:
			<br>
			<input type="text" name="lname" width="500" maxlength="10" value="<?php
				if (isset($_POST['lname'])) {
					echo strip_tags($_POST['lname']);
				}
			?>"/>
			<br>

			Tên lót:
			<br>
			<input type="text" name="mname" width="500" maxlength="10" value="<?php
				if (isset($_POST['mname'])) {
					echo strip_tags($_POST['mname']);
				}
			?>"/>
			<br>

			Tên:
			<br>
			<input type="text" name="fname" width="500" maxlength="10" value="<?php
				if (isset($_POST['fname'])) {
					echo strip_tags($_POST['fname']);
				}
			?>"/>
			<br>

            Username:
            <br>
            <input type="text" name="username" value="<?php
            if (isset($_POST['username'])) {
                echo strip_tags($_POST['username']);
            }
            ?>"/>
            <br>

			Chức vụ:
			<br>
			<select name="position">
				<?php
					$query = "CALL ViewEmpPosition()";
					$result = $dbc->query($query);
					while ($row = $result->fetch_array()) {
						echo "<option value='{$row[1]}' ";
						if(isset($_POST['position']) && $_POST['position']==$row[1]){
							echo "selected = 'selected'";
						}
						echo ">" . $row[1] . "</option>";
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
						echo "<option value='{$row[0]}'>" . $row[0] . "</option>";
					}
					$result->free();
					$dbc->next_result();
				?>
			</select>
			<br>

			Ngày sinh:
			<br>
			<input type="text" name="bday" value="<?php
				if (isset($_POST['bday'])) {
					echo strip_tags($_POST['bday']);
				}
			?>"/>
			<br>

			Tháng sinh:
			<br>
			<input type="text" name="bmonth" value="<?php
				if (isset($_POST['bmonth'])) {
					echo strip_tags($_POST['bmonth']);
				}
			?>"/>
			<br>

			Năm sinh:
			<br>
			<input type="text" name="byear" value="<?php
				if (isset($_POST['byear'])) {
					echo strip_tags($_POST['byear']);
				}
			?>"/>
			<br>

			Ngày nhận việc:
			<br>
			<input type="date" name="hiredate"/>
			<br>

			Địa chỉ:
			<br>
			<input type="text" name="address" value="<?php
				if (isset($_POST['address'])) {
					echo strip_tags($_POST['address']);
				}
			?>"/>
			<br>

			Tỉnh/Thành phố:
			<br>
			<select name="city">
				<?php
					$query = "CALL ViewCity()";
					$result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
					while ($row = mysqli_fetch_array($result)) {
						echo "<option value='{$row[0]}'>" . $row[0] . "</option>";
					}
					$dbc->close();
				?>
			</select>
			<br>

			Quận:
			<br>
			<input type="text" name="district" value="<?php
				if (isset($_POST['district'])) {
					echo strip_tags($_POST['district']);
				}
			?>"/>
			<br>

			Số điên thoại:
			<br>
			<input type="text" name="phone" value="<?php
				if (isset($_POST['phone'])) {
					echo strip_tags($_POST['phone']);
				}
			?>"/>
			<br>

			Hình đại diện:
			<br>
			<input type="text" name="avatar" value="<?php
				if (isset($_POST['avatar'])) {
					echo strip_tags($_POST['avatar']);
				}
			?>"/>
			<input type="button" name="upload" value="upload"/>

			<input type="submit" name="submit"/>
		</form>
	</section>
	<aside id="right"></aside>

<?php include('include/footer.php') ?>