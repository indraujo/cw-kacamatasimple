<?php
    //open connection to mysql db
  //  $connection = mysqli_connect("hostname","username","password","db_employee") or die("Error " . mysqli_error($connection));
    //include "../config/koneksi.php";

    //fetch table rows from mysql db
mysql_connect("localhost","root","");
mysql_select_db("jae");
   $emparray = array();
$sqlData = "select * from tbl_artikel ";
$resultData = mysql_query($sqlData) or die("error in seleting" . mysql_error());
$i=1;
while($rowData = mysql_fetch_array($resultData))
{
    $id_a[$i] = $rowData['id_artikel'];
    $sqlKata[$i] = "select kata from tbl_kata_sumber WHERE id_artikel='$id_a[$i]' order by id_kata";
    $resultKata[$i] = mysql_query($sqlKata[$i]) or die("error in seleting" . mysql_error());
    while($rowKata[$i] = mysql_fetch_assoc($resultKata[$i]))
    {
        $tempkata[] = $rowKata[$i]['kata'];
        $temparray[$i]["kata"]          = implode(', ',$tempkata);
        //$tempkata[] = NULL;         
    }
    $temparray[$i]["id_artikel"]    = $rowData["id_artikel"];
    $temparray[$i]["isi_artikel"]     = $rowData["isi_artikel"];
        
    array_push($emparray, $temparray[$i]);
    $i++;
}
echo json_encode($emparray);
//    echo json_encode($emparray);

    //close the db connection
    //mysqli_close($connection);
?>