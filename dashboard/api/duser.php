<?php
include('dbcon.php');
if(isset($_GET['id'])){
    $id= $_GET['id'];
    delete_data($conn, $id);
}
// delete data query
function delete_data($conn, $id){
   
    $query="DELETE from users WHERE id=$id";
    $exec= mysqli_query($conn,$query);
    if($exec){
      ?>
    <script type="text/javascript">
        alert("Delete was successful");
         window.location.href = "../setting.php";
        </script>
    <?php

    }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($conn);
    
        include '../error.php';

    }
}
?>