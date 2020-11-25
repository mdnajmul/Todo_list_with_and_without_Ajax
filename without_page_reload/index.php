<?php
    $con=mysqli_connect('localhost','root','','userdata');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Todo List</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
                    <div id="textbox"><input type="textbox" name="title" id="title" style="width: 100%;padding: 15px;"></div>
                    <div id="button"><input type="button" onclick="insert_data()" value="Submit" style="width: 100%;padding: 15px;"></div>
                </form>
                <div class="err_msg"></div>
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

                                    <tr id="row_<?php echo $row['id']?>">
                                        <td width="93%"><?php echo $row['title']?></td>
                                        <td><a href="javascript:void(0)" onclick="delete_data('<?php echo $row['id']?>')">Delete</a></td>
                                    </tr>

                            <?php } ?>
                        </table>
                <?php }else{
                        echo 'No data found!';
                    }?>        
            </div>
        </div>
        
        
        <script>
            function insert_data(){
                var text=$('#title').val();
                $('.err_msg').html('');
                
                if(text==''){
                    $('.err_msg').html('Please enter value!');
                }else{
                    $.ajax({
                        url:'insert.php',
                        type:'post',
                        data:'text='+text,
                        success:function(result){
                            var html='<tr id=row_'+result+'><td width="93%">'+text+'</td><td><a href="javascript:void(0)" onclick=delete_data("'+result+'")>Delete</a></td></tr>'
                            $('#row_data').prepend(html);
                        }
                    });
                }
            }
            
            
            function delete_data(id){
                $.ajax({
                        url:'delete.php',
                        type:'post',
                        data:'id='+id,
                        success:function(result){
                            $('#row_'+id).slideUp();
                        }
                    });
            }
        </script>
        
    </body>
</html>