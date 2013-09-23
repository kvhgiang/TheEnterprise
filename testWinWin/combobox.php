<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Combobox Ajax & Database</title>
    <script language="javascript">
        function ajaxFunction(cityid){
            var xmlHttp;
            if(window.XMLHttpRequest){
                // IE7+, Firefox, Chrome, Opera, Safari
                xmlHttp = new XMLHttpRequest;
            }
            else if(window.ActiveXObject){
                // IE6, IE5
                xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
            }

            xmlHttp.onreadystatechange = function(){
                if(xmlHttp.readyState == 4){
                    document.getElementById('district').innerHTML = xmlHttp.responseText;
                }
            }
            xmlHttp.open('GET', 'action.php?CityID='+cityid, true);
            xmlHttp.send(null);
        }
    </script>
</head>

<?php
// Ket noi Database
include_once("G:/wamp/www/TheEnterprise/Module/include/database_connect.php");

//$sql = "SELECT * FROM dmsp";
//$query = mysql_query($sql);

$query = "call ViewCity";
$result = $dbc->query($query) or die($dbc->error);

$selectBox1  = '';
$selectBox1 .= '<select name="cityid" onchange="ajaxFunction(this.value);">';
$selectBox1 .= '    <option value="noselect" selected>Chọn tỉnh/thành phố</option>';
while($row = $result->fetch_array(MYSQL_ASSOC)){
    $selectBox1 .= '<option value="'.$row['CityID'].'">'.$row['Name'].'</option>';
}

$selectBox1 .= '</select>';
echo $selectBox1;
?>

<body>
<span id="district">
    <select name="district">
        <option>Chọn quận/huyện</option>
    </select>
</span>
</body>