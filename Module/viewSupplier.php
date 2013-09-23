<?php include "include/header.php" ?>
<?php include("include/sidebar_left.php") ?>

<section>
<?php
$query = "call ViewSupplier()";
$result = $dbc->query($query) or die($dbc->error);

if($result != false)
{
    if($result->num_rows>0)
    {
        ?>
        <table width="600" border="1" cellspacing="0" align="center" >
            <tr>
                <br/><p>DANH SÁCH NHÀ CUNG CẤP HIỆN TẠI</p><br />
                <th>SupplierID</th>
                <th>Type</th>
                <th>Name</th>
                <th>Address</th>
                <th>District</th>
                <th>City</th>
                <th>PhoneNumber</th>
                <th>Contact</th>
                <th></th>
            </tr>
            <?php
            while($row = $result->fetch_array(MYSQL_ASSOC))
            {
                $suID = $row["SupplierID"];
                $type = $row["Type"];
                $name = $row["Name"];
                $addr = $row["Address"];
                $district = $row["District"];
                $city = $row["City"];
                $phone = $row["PhoneNumber"];
                $contact = $row["Contact"];
                ?>
                <tr>
                    <td align="center"><?php echo($suID);?></td>
                    <td><?php echo($type); ?></td>
                    <td><?php echo($name); ?></td>
                    <td><?php echo($addr); ?></td>
                    <td><?php echo($district); ?></td>
                    <td><?php echo($city); ?></td>
                    <td><?php echo($phone); ?></td>
                    <td><?php echo($contact); ?></td>
                    <td>
                        <a href="addSup.php">Thêm</a>
                        <a href="delSup.php">Xóa</a>
                        <a href="updateSup.php">Sửa</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    }
}
?>
</section>
<aside id="right"></aside>

<?php include('include/footer.php') ?>