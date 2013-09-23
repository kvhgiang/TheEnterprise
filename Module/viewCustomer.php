<?php session_start(); ?>
<?php include('include/header.php') ?>
<?php include('include/sidebar_left.php') ?>

    <section>
        <form action="viewCustomer.php" method="post">
            ID khách hàng:
            <br>
            <input type="text" width="300" name="cusID" value="<?php
            if (isset($_POST['cusID'])) {
                echo $_POST['cusID'];
            }
            ?>"/>
            <input type="submit"/>

        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cusID = $_POST['cusID'];
            $query = "call GetCustByID($cusID)";
            $result = $dbc->query($query) or die($dbc->error);
            $row = $result->fetch_row();

            $_SESSION["id"]=$row[0];
            $_SESSION["gra"]=$row[16];
            $_SESSION["ho"]=$row[2];
            $_SESSION["lot"]=$row[3];
            $_SESSION["ten"]=$row[4];
            $_SESSION["ngay"]=$row[5];
            $_SESSION["thang"]=$row[6];
            $_SESSION["nam"]=$row[7];
            $_SESSION["joindate"]=$row[8];
            $_SESSION["dc"]=$row[9];
            $_SESSION["quan"]=$row[10];
            $_SESSION["tp"]=$row[11];
            $_SESSION["dt"]=$row[12];
            $_SESSION["email"]=$row[13];







            echo "Họ tên: " . $row[2] ." ". $row[3]." " . $row[4] . "<br>";
            echo "Sinh nhật: " . $row[5] ."/". $row[6] ."/". $row[7] .  "<br>";
            echo "Ngày tham gia: " . $row[8] . "<br>";
            echo "Địa chỉ: " . $row[9] ."-". $row[10] ."-". $row[11] . "<br>";
            echo "Điện thoại: " . $row[12] . "<br>";
            echo "Email: " . $row[13] . "<br>";
            echo "Loại khách hàng: " . $row[16] . "<br>";
            echo '<a href="EditCustomer.php"><input type="button" value="Sửa" /> </a>';
        }//end if REQUEST_METHOD==POST
        ?>

    </section>
    <aside id="right"></aside>

<?php include('include/footer.php') ?>