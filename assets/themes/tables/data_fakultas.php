<?php
    //open connection to mysql db
  //  $connection = mysqli_connect("hostname","username","password","db_employee") or die("Error " . mysqli_error($connection));
    //include "../config/koneksi.php";

    //fetch table rows from mysql db
    mysql_connect("localhost","root","");
    mysql_select_db("kuesioner");
    $fak=$_GET['fak'];
    $sql = "select * from tbl_result_variabel where id_fakultas='$fak' and id_jurusan='0'";
    $result = mysql_query($sql) or die("Error in Selecting " . mysql_error());

    //create an array
    $emparray = array();
    while($row =mysql_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);

    //close the db connection
    //mysqli_close($connection);
?>