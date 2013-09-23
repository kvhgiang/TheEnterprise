<?php include('include/header.php') ?>
<?php include('include/functions.php') ?>
<?php include('include/sidebar_left.php') ?>

	<section>
<!--		--><?php
//			if(isset($_GET['taskID'])){
//				$taskID = $_GET['taskID'];
//			}
//			else{
//				$taskID = '';
//			}
//		?>

		<form action="viewTask.php" method="GET">
			ID task:
			<br>
			<input type="text" width="300" name="taskID" value="<?php
            if (isset($_GET['taskID'])) {
					echo $_GET['taskID'];
				}
			?>"/>
			<input type="submit"/>
		</form>
		<?php
			//lấy info task từ kết quả trả về từ database
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				$taskID = $_GET['taskID'];
				//kiểm tra input ở đây, chỉ chấp nhận số dương.
				if($taskID == ''){
					$taskID = 'NULL';
					
				}
				$query  = "call GetTaskByTaskID($taskID)";
				$task = $dbc->query($query) or die($dbc->error);
				$taskDetail = $task->fetch_array();
				$dbc->next_result();
				//              taskDetail
				//				0: taskID
				//				1: UID
				//				2: Name
				//				3: HasChild
				//				4: UpperTask
				//				5: AccessLevel
				//				6: AssignBy
				//				7: StartDate
				//				8: Duration
				//				9: ActualStartDate
				//				10: ActualDuration
				//				11: Status

				//get child task detail
				if ($taskDetail[3] != "NULL") {
					$query = "call GetChildTask($taskID)";
					$childTask = $dbc->query($query) or die($dbc->error);
					$dbc->next_result();
				}
			}//end if REQUEST_METHOD==POST
		?>

		<br>
		<table border="1">
			<caption>Task</caption>
			<tr>
				<th>Tên</th>
				<th>Tiến độ</th>
				<th>Start date</th>
				<th>Thời gian</th>
				<th>Thực tế bắt đầu</th>
				<th>Thời gian thực tế</th>
			</tr>
			<tr>
				<?php
					if (isset($taskDetail)) {
						//tên task
						echo '<td>';
						echo $taskDetail['Name'];
						echo '</td>';

						//tiến độ
						echo '<td>';
						echo $taskDetail['Status'] . '%';
						echo '</td>';

						//start date
						echo '<td>';
						echo date('d-m-Y', strtotime($taskDetail['StartDate']));
						echo '</td>';

						//Thời gian dự kiến
						echo '<td>';
						echo $taskDetail['Duration'];
						echo '</td>';

						//Thực tế bắt đầu
						echo '<td>';
						if ($taskDetail['ActualStartDate'] == null) {
							echo "chưa bắt đầu";
						}
						else
							echo $taskDetail['ActualStartDate'];
						echo '</td>';

						//Thời gian thực tế
						echo '<td>';
						if ($taskDetail['ActualDuration'] == null) {
							echo "chưa cập nhật";
						}
						else
							echo $taskDetail['ActualDuration'] . " ngày";
						echo '</td>';
					}
				?>
			</tr>
		</table>
		<!-- end table task -->

		<table border="1">
			<caption>Chi tiết</caption>
			<tr>
				<th colspan="2">Task con</th>
				<th colspan="2">Người tham gia</th>
			</tr>
			<tr>
				<th>Tên</th>
				<th>Hoàn thành</th>
				<th>Tên nhân viên</th>
				<th>Hoàn thành</th>
			</tr>
			<?php
				if (isset($childTask)) {
					while ($childTaskDetail = $childTask->fetch_assoc()) {
						echo '<tr>';
						echo '<td>';
						//tạo link để khi nhấn vào tên task sẽ cho ra thông tin chi tiết
						$link = '';
						$link.= '<a href="viewTask.php?taskID=';
						$link.= $childTaskDetail['TaskID'];
						$link.= '">';
						$link.= $childTaskDetail['Name'];
						$link.= '</a>';
						echo $link;
						echo '</td>';
						echo '<td>';
						echo $childTaskDetail['Status'] . '%';
						echo '</td>';
						echo '</tr>';
					}
				}
			?>
		</table>
	</section>
	<aside id="right">
		<a href="addTask.php?uTaskID=<?php
			if (isset($taskID)) {
				echo $taskID;
			}
		?>&uTaskName=<?php
			if (isset($taskDetail[2])) {
				echo "$taskDetail[2]";
			}
		?>">Thêm task con</a>
	</aside>

<?php include('include/footer.php') ?>