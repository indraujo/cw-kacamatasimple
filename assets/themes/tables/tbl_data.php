<?php
    //open connection to mysql db
  //  $connection = mysqli_connect("hostname","username","password","db_employee") or die("Error " . mysqli_error($connection));
    //include "../config/koneksi.php";

    //fetch table rows from mysql db
mysql_connect("localhost","root","");
mysql_select_db("jae");
    $sql = "select * from tbl_artikel";
    $result = mysql_query($sql) or die("Error in Selecting " . mysql_error());

    //create an array
    $emparray = array();
    echo "[";
    while($row = mysql_fetch_array($result))
    {
        echo "{";
        echo '"id_artikel":"'.$row['id_artikel'].'",';
        echo '"judul_artikel":"'.$row['judul_artikel'].'",';
        echo '"isi_artikel":"'.str_replace('"', "", $row['isi_artikel']).'",';
        echo '"id_label_artikel":"'.$row['id_label_artikel'].'",';
        echo '"jenis_data_artikel":"'.$row['jenis_data_artikel'].'",';
        if ($row["id_artikel"] < 6) {
            
        echo "},";
        }
        elseif ($row["id_artikel"] = 6){

        echo "}";
        }
        //$emparray[] = $row;
    }
    echo "]";
    //echo json_encode($emparray);

    //close the db connection
    //mysqli_close($connection);
?>