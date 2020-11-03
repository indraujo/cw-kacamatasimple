<?php
    //open connection to mysql db
  //  $connection = mysqli_connect("hostname","username","password","db_employee") or die("Error " . mysqli_error($connection));
    //include "../config/koneksi.php";

    //fetch table rows from mysql db
mysql_connect("localhost","root","");
mysql_select_db("jae");
   $emparray = array();
$sqlData = "select * from tbl_artikel_testing ";
$resultData = mysql_query($sqlData) or die("error in seleting" . mysql_error());
while($rowData = mysql_fetch_assoc($resultData))
{
    $id_a = $rowData['id_artikel_testing'];
    $sqlKata = "select * from tbl_kata_testing WHERE id_artikel_testing='$id_a' ";
    $resultKata = mysql_query($sqlKata) or die("error in seleting" . mysql_error());
    while($rowKata = mysql_fetch_assoc($resultKata))
    {
        $temparray["id_artikel_testing"]    = $rowData["id_artikel_testing"];
        $temparray["isi_artikel_testing"]     = $rowData["isi_artikel_testing"];
        $tempkata[] = $rowKata['kata_testing'];
         //$tempkata = NULL; 
        $temparray["kata_testing"]          = implode(', ',$tempkata);
    }
    array_push($emparray, $temparray);
}
echo json_encode($emparray);
//    echo json_encode($emparray);

    //close the db connection
    //mysqli_close($connection);
?>