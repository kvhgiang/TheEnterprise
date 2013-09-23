<?php include('include/header.php') ?>
<?php include('include/sidebar_left.php') ?>

	<section>
		<?php
			//sau khi nhấn "thêm task con"
			if (isset($_GET['uTaskID'])) {
				$uTaskID = $_GET['uTaskID'];
				//cần kiểm tra ID hợp lệ
			}else
				$uTaskID = 'NULL';

			if (isset($_GET['uTaskName'])) {
				$uTaskName = $_GET['uTaskName'];
			}
			else
				$uTaskName = "Không có";

			//biến lưu thông báo submit thành công hay thất bại
			$message = '';

			//khi nhấn submit
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$name        = $_POST['name'];
				$uTaskID = $_POST['uTaskID'];
				if($uTaskID == ""){
					$uTaskID = 'NULL';
				}
				$accessLevel = $_POST['accessLevel'];
				$assignBy    = 37; //tạm thời, sẽ lấy từ session userID
				$startDate   = $_POST['startDate'];
				$duration    = $_POST['duration'];
				$query       = "call AddTask('$name',$uTaskID,$accessLevel,$assignBy,'$startDate',$duration)";
				$dbc->query($query) or trigger_error($dbc->error);
				if ($dbc->affected_rows >= 0) {
					$message = "Thêm task thành công" . "<br>";
				}
				else {
					$message = "Thêm task thất bại" . "<br>" . $dbc->error;
				}
			}//end if request method
		?>

		<form action="addTask.php?uTaskID=<?php
			echo $uTaskID;
		?>&uTaskName=<?php
			echo $uTaskName;
		?>" method="post">
			<!-- Tên task cha nếu có -->
			<label>
				Task cha:
				<br>
				<input type="text" name="uTaskName" width="500" disabled="disabled" value="<?php
					//nếu có giá trị trong post thì lấy ra
					if (isset($_POST['uTaskName'])) {
						echo strip_tags($_POST['uTaskName']);
					}
					//nếu không có lấy giá trị từ $_GET
					else if ($uTaskName != "") {
						echo $uTaskName;
					}
					else {
						echo "Không có";
					}
				?>"/>
			</label>

			<br>
			<!-- input field ẩn giữ giá trị id task cha -->
			<label>
				ID task cha:
				<br>
				<input type="text" name="uTaskID" width="500" hidden="hidden" value="<?php
					//nếu có giá trị trong post thì lấy ra
						echo $uTaskID;
				?>"/>
			</label>

			<br>

			Tên task:
			<br>
			<input type="text" name="name" width="500" value="<?php
				if (isset($_POST['name'])) {
					echo strip_tags($_POST['name']);
				}
			?>"/>
			<br>

			Quyền truy cập:
			<br>
			<select name="accessLevel" id="accessLevel">
				<?php
					$query = "CALL ViewEmpPosition()";
					$result = $dbc->query($query);
					while ($row = $result->fetch_array()) {
						echo "<option value='{$row[0]}'>" . $row[1] . "</option>";
					}
					$result->free();
				?>
			</select>
			<br>

			<!-- Người tạo task: ẩn, lấy từ session -->

			Thời gian bắt đầu dự kiến:
			<br>
			<input type="date" name="startDate" value="<?php
				if (isset($_POST['startDate'])) {
					echo strip_tags($_POST['startDate']);
				}
			?>"/>
			<br>

			Số ngày thực hiện dự kiến:
			<br>
			<input type="text" name="duration" value="<?php
				if (isset($_POST['duration'])) {
					echo strip_tags($_POST['duration']);
				}
			?>"/>
			<br>

			<input type="submit"/>
		</form>
		<?php
			echo $message;
		?>
	</section>
	<aside id="right"></aside>

<?php include('include/footer.php') ?>