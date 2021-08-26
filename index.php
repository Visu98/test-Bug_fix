<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css"> 
    <title>Demo</title>
  </head>
  <body>
      <?php
        require 'database.php';
        session_start();
        $username = NULL;
        $password = NULL;
        //Aurthontication
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
        }
        $sql = "SELECT * FROM admin WHERE username = '$username' AND passwd = '$password'";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) ==0){
            header ('location:login.php');
        }
        //For add the menu
        if (isset($_POST['add_menu'])){
            $menu_name = $_POST["menu"];
            $url = $_POST["URL"];
            $add_Query = "INSERT INTO `menu` (`Menu_name`, `parent`, `child`,`url`) VALUES ('$menu_name','NULL','NULL','$url')";
            $Fire_Add_Query = mysqli_query($conn,$add_Query);
            if ($Fire_Add_Query){
                echo "<script>alert('add succesfully')</script>";
            }else{
                echo "<script>alert('fail')</script>";
            }
        }

        // Navigator code for upload in table to show
        
        if (isset($_POST['submit_navigator'])){
            if(isset($_POST['parent_1'])){
                $p1 = $_POST['parent_1'];
                echo "<script>alert('.$p1.')</script>";
            }
            if(isset($_POST['child_11'])){
                $c11 = $_POST['child_11'];
            }
            if(isset($_POST['child_12'])){
                $c12= $_POST['child_12'];
            }
            if(isset($_POST['parent_2'])){
                $p1= $_POST['parent_2'];
            }
            if(isset($_POST['child_21'])){
                $c21= $_POST['child_21'];
            }
            if(isset($_POST['child_22'])){
                $c22= $_POST['child_22'];
            }
            // if
        }

        ?>
    <!-- Menu bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="">Brand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse bg-dark" id="navbarCollapse">
        
        
        <?php
        // Menu from database 

        $manu_select = "SELECT * FROM `menu` WHERE `child` = 'NULL'";
        $Fire_Query_menu = mysqli_query($conn,$manu_select);
        // $Rows_menu = mysqli_num_rows($Fire_Query_menu);
        echo '<ul class="navbar-nav mr-auto">';
        if ($Fire_Query_menu ){
            foreach ($Fire_Query_menu as $menu){
                echo '<li class="nav-item active">
                    <a class="nav-link" id="drag_'.$menu['id'].'" href="'.$menu['url'].'" draggable="true"ondragstart="dragStart(event)">'.$menu['Menu_name'].'</a>
                    <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                Dropdown button
                            </button> 
                    ';
                $main_menu_id = $menu['id'];
                $Sub_menu_query = "SELECT * FROM `menu` WHERE `parent`= $main_menu_id";
                $Fire_sub_menu = mysqli_query($conn, $Sub_menu_query);
                echo '<div class="dropdown-menu">';
                $row_sub = mysqli_fetch_assoc($Fire_sub_menu);
                if (mysqli_num_rows($Fire_sub_menu)>0){
                    foreach($Fire_sub_menu as $sub_menu){
                        echo '<a class="dropdown-item" id="drag_'.$sub_menu['id'].'" href="'.$sub_menu['url'].'" draggable="true"ondragstart="dragStart(event)">'.$sub_menu['Menu_name'].'</a>';
                    }
                }else{
                    echo'
                    <a class="dropdown-item" href="#">No sub menu</a>
                ';
                }
            }
        }
            echo "</div></div>
            </li>
            </ul>";
        ?>
        
        </div>
        <a href="logout.php">LogOut</a>
    </nav>

    <!-- Here Menu Add Code Below -->   
    <div class="container-fluid container mt-5 pt-5 background-container">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item">Menu</li>
            </ol>
    </div>
    <div class="container-fluid container mt-3 background-container">
    <div class="row mx-auto">
        <div class="Menu Title shower form-group m-1 border col-4">
            <h3>Menu</h3>
            <form action="" method="post">
            <div class="form-group">
                <label for="menuname" class="text-info">Menu Title:</label><br>
                <input type="text" name="menu" class="form-control">
            </div>  
            <div class="form-group">
                <label for="url" class="text-info">Custom Url(including https://):</label><br>
                <input type="text" name="URL" class="form-control">
            </div>
            <div class="form-group">
                
                <input type="submit" name="add_menu" class="btn btn-info btn-md" value="add">
            </div>
            </form>
        </div>

        <!-- Navigator code below -->

        <div class="Menu Title shower form-group m-1 border col-6">
            <h3>Navigator</h3>
            <form action="navigator_menu.php" method="post">
                <div class="form-group">
                    <div id="parent_1" class="border mr-5 m-1 p-3 col-3" name='parent_1' ondrop="dragDrop(event,'parent__1')"ondragover="allowDrop(event)"></div>
                    <div id="child_11" class="border ml-3 m-1 mr-5 p-3 col-3" name='child_11' ondrop="dragDrop(event,'child__11')"ondragover="allowDrop(event)"></div>
                    <div id="child_12" class="border ml-3 m-1 mr-5 p-3 col-3" name='child_12' ondrop="dragDrop(event,'child__12')"ondragover="allowDrop(event)"></div>
                    
                    <div id="parent_2" class="border mr-5 m-1 p-3 col-3" name='parent_2' ondrop="dragDrop(event,'parent__2')"ondragover="allowDrop(event)"></div>
                    
                    <div id="child_21" class="border ml-3 m-1 mr-5 p-3 col-3" name='child_21' ondrop="dragDrop(event,'child__21')"ondragover="allowDrop(event)"></div>
                    <div id="child_22" class="border ml-3 m-1 mr-5 p-3 col-3" name='child_22' ondrop="dragDrop(event,'child__22')"ondragover="allowDrop(event)"></div>
                        <input type="hidden" id="parent__1" value="" name="parent_1">
                        <input type="hidden" id="child__11" value="" name="child_11">
                        <input type="hidden" id="child__12" value="" name="child_12">
                        <input type="hidden" id="parent__2" value="" name="parent_2">
                        <input type="hidden" id="child__21" value="" name="child_21">
                        <input type="hidden" id="child__22" value="" name="child_22">
                        <input type="submit" name="submit_navigator" class="btn btn-info btn-md" value="Save" onclick="add_values()">
                </div>
                    
            </form>
        </div>
            </div>
            </div>
            </div>
    <!-- EXTRA SCRIPT -->
    <script>
            function allowDrop(ev) {
                ev.preventDefault();
            }
             
            function dragStart(ev) {
                ev.dataTransfer.setData("text", ev.target.id);
            }
             
            function dragDrop(ev,x) {
                ev.preventDefault();
                var data = ev.dataTransfer.getData("text");
                ev.target.appendChild(document.getElementById(data));
                var input = document.getElementById(data).innerHTML;
                var s = document.getElementById(x);
                s.value = input;
            }
            function add_values(){
                // var data = document.getElementById('parent__1').value;
                // alert(data);
            }
            // function readFile(e) {
            //     var files;
            //     if (e.target.files) {
            //         files=e.target.files
            //     } else {
            //         files=e.dataTransfer.files
            //     }
            //     if (files.length==0) {
            //         alert('What you dropped is not a file.');
            //         return;
            //     }
            //     var file=files[0];
            //     document.getElementById('fileDragName').value = file.name
            //     document.getElementById('fileDragSize').value = file.size
            //     document.getElementById('fileDragType').value = file.type
            //     reader = new FileReader();
            //     reader.onload = function(e) {
            //         document.getElementById('fileDragData').value = e.target.result;
            //     }
            //     reader.readAsDataURL(file);
            //     }
            // function getTheFile(e) {
            // e.target.style.borderColor='#ccc';
            // readFile(e);
            // }
        </script>
    </body>
</html>