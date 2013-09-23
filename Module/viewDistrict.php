<?php
if(isset($_GET['cityid'])){

    $cityid = $_GET['cityid'];
    $selectBox2  = '';

    if($cityid != 'noselect'){
        $query = "Call ViewDistrict";
        $result = $dbc->query($query) or die($dbc->error);

        //$query = mysql_query("SELECT * FROM district WHERE CityID = ".$cityid);

        $selectBox2 .= '<select name="district">';
        $selectBox2 .= '<option value="noselect" selected>Chọn quận/huyện</option>';
        while($row = $result->fetch_array(MYSQL_ASSOC)){
            $selectBox2 .= '<option value="'.$row['Name'].'">'.$row['Name'].'</option>';
        }
        $selectBox2 .= '</select>';
    }
    else{
        $selectBox2 .= '<select name="district">';
        $selectBox2 .= '    <option>Chọn quận/huyện</option>';
        $selectBox2 .= '</select>';
    }

    echo $selectBox2;
}
?>