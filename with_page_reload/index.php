<?php
    $con=mysqli_connect('localhost','root','','userdata');

    $error='';
    if(isset($_POST['submit'])){
        $text=$_POST['textbox'];
        
        if($text==''){
            $error="Please enter value!";
        }else{
            $sql="INSERT INTO todo_list(title) VALUES('$text')";
            mysqli_query($con,$sql);
        }
    }

    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
        
        $sql="DELETE FROM todo_list WHERE id='$id'";
        mysqli_query($con,$sql);
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Todo List</title>
        <style>
            body {
                width: 80%; 
                margin: auto; 
                font-family: arial;
            }
            #container {
                margin-top: 100px;
            }
            #container h1 {
                text-align: center;
            }
            #option #textbox {
                width: 82%;
                float: left;           
            }
            #option #button {
                width: 16%;
                float: right;
            }
            #row_data {
                width: 91%;
            }
            #row_data td {
                border: 1px solid #ddd;
                padding: 8px;
            }
            #row_data tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            .clear {
                clear: both;
            }
            .err_msg {
                color: red;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1>PHP todo List</h1>
            <div id="option">
                <form method="post">
                    <div id="textbox"><input type="textbox" name="textbox" id="textbox" style="width: 100%;padding: 15px;"></div>
                    <div id="button"><input type="submit" name="submit" id="Submit" style="width: 100%;padding: 15px;"></div>
                </form>
                <div class="err_msg"><?php echo $error;?></div>
            </div>
            <div class="clear">&nbsp;</div>
            <div id="display">
                <?php
                    $sql="SELECT * FROM todo_list ORDER BY id DESC";
                    $res=mysqli_query($con,$sql);
                    $count=mysqli_num_rows($res);
                    if($count>0){
                ?>
                        <table id="row_data">
                            <?php
                                while($row=mysqli_fetch_assoc($res)){
                            ?>

                                    <tr>
                                        <td width="93%"><?php echo $row['title']?></td>
                                        <td><a href="index.php?delete=<?php echo $row['id']?>">Delete</a></td>
                                    </tr>

                            <?php } ?>
                        </table>
                <?php }else{
                        echo 'No data found!';
                    }?>        
            </div>
        </div>
    </body>
</html>