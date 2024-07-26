<?php
function getDataBeasiswa($conn){
    $query = "SELECT * FROM mahasiswa";
    $result = mysqli_query($conn,$query);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}
?>