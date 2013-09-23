<?php include "include/header.php" ?>
<?php include("include/sidebar_left.php") ?>

    <section>
    <?php //Nếu server có gửi POST thì bắt đầu xử lí form
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $dishName      = $_POST['dishName'];
        $avatar     = $_POST['avatar'];
        $price   = $_POST['price'];
        $time     = $_POST['time'];
        $serving     = $_POST["serving"];

        $query  = "call AddDish('$dishName','$avatar','$price','$time','$serving')";
        $result = $dbc->query($query);
        //check transaction có hoạt động thành công không
        if ($dbc->affected_rows == 0) {
            //không hiểu tại sao chỗ này dù đã commit thành công nhưng vẫn trả về 0
            echo "Thêm món ăn thành công";
            unset($_POST['dishName']);
            unset($_POST['avatar']);
            unset($_POST['price']);
            unset($_POST['time']);
            unset($_POST['serving']);
        }
        else {
            echo "Thêm món ăn thất bại" . "<br>" . $dbc->error;
        }
        echo "<br>" . "Số dòng affect: " . $dbc->affected_rows;
    }//end if
    ?>
    <form action="addDish.php" method="post">
        Tên món ăn:
        <br>
        <input type="text" name="dishName" width="500" maxlength="50" value="<?php
        if (isset($_POST['dishName'])) {
            echo strip_tags($_POST['dishName']);
        }
        ?>"/>
        <br>

        Giá cả:
        <br>
        <input type="text" name="price" width="500" maxlength="10" value="<?php
        if (isset($_POST['price'])) {
            echo strip_tags($_POST['price']);
        }
        ?>"/>
        <br>

        Thời gian nấu:
        <br>
        <input type="text" name="time" value="<?php
        if (isset($_POST['time'])) {
            echo strip_tags($_POST['time']);
        }
        ?>"/>
        <br>

        Khẩu phần ăn:
        <br>
        <input type="text" name="serving" value="<?php
        if (isset($_POST['serving'])) {
            echo strip_tags($_POST['serving']);
        }
        ?>"/>
        <br>

        <input type="submit" name="submit"/>
    </form>
    </section>
    <aside id="right"></aside>

<?php include('include/footer.php') ?>