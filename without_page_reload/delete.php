<?php

    $con=mysqli_connect('localhost','root','','userdata');

    $id=$_POST['id'];
    
    $sql="DELETE FROM todo_list WHERE id='$id'";
    mysqli_query($con,$sql);

?>