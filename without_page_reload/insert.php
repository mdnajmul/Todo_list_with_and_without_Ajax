<?php

    $con=mysqli_connect('localhost','root','','userdata');

    $text=$_POST['text'];

     $sql="INSERT INTO todo_list(title) VALUES('$text')";
     mysqli_query($con,$sql);
     
     $id=mysqli_insert_id($con);
     echo $id;

?>