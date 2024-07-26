<?php
include_once "../utils/config.php";

function getDataNim($conn){
    $query = "SELECT * FROM nilai";
    $result = mysqli_query($conn,$query);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}
?>