<?php
require 'database.php';

if(isset($_POST['submit_navigator'])){
    if(isset($_POST['parent_1'])){
        $parent_name_1 = $_POST['parent_1'];
        $get_parent_1 = "SELECT * FROM `menu` WHERE `Menu_name` = '$parent_name_1'";
        $fire_get_parent_1 = mysqli_query($conn,$get_parent_1);
        $value_parent_1 = mysqli_fetch_assoc($fire_get_parent_1);
        $id_parent_1 = $value_parent_1['id'];
        $update_parent_1 = "UPDATE `menu` SET `parent`='',`child`='NULL' WHERE `id` = '$id_parent_1'";
        $fire_update_parent_1 = mysqli_query($conn,$update_parent_1);
        if(isset($_POST['child_11']) && isset($_POST['child_12'])){
            $child_11 = $_POST['child_11'];
            $Update_query_child_11 ="UPDATE `menu` SET `parent`='$id_parent_1',`child`='0' WHERE `Menu_name` = '$child_11'";
            $fire_child_11 = mysqli_query($conn,$Update_query_child_11);
            $child_12 = $_POST['child_12'];
            $Update_query_child_12 ="UPDATE `menu` SET `parent`='$id_parent_1',`child`='0' WHERE `Menu_name` = '$child_12'";
            $fire_child_12 = mysqli_query($conn,$Update_query_child_12);
            if ($fire_child_11 && $fire_child_12){
                echo '<script>alert("Parent 1 updated successfully")</script>';
            }
        }elseif (isset($_POST['child_11'])) {
            $child_11 = $_POST['child_11'];
            $Update_query_child_11 ="UPDATE `menu` SET `parent`='$id_parent_1',`child`='0' WHERE `Menu_name` = '$child_11'";
            $fire_child_11 = mysqli_query($conn,$Update_query_child_11);
            if ($fire_child_11){
                echo '<script>alert("Parent 1 updated successfully")</script>';
            }
        }else{
            if ($fire_update_parent_1){
                echo '<script>alert("Parent 1 updated successfully")</script>';
            }
        }
    }
    if(isset($_POST['parent_2']) && $_POST['parent_2']!="" ){
        $parent_name_2 = $_POST['parent_2'];
        $get_parent_2 = "SELECT * FROM `menu` WHERE `Menu_name` = $parent_name_2";
        $fire_get_parent_2 = mysqli_query($conn,$get_parent_2);
        $value_parent_2 = mysqli_fetch_assoc($fire_get_parent_2);
        $id_parent_2 = $value_parent_1['id'];
        $update_parent_2 = "UPDATE `menu` SET `parent`='0',`child`='NULL' WHERE `id` = '$id_parent_2'";
        $fire_update_parent_2 = mysqli_query($conn,$update_parent_2);
        if(isset($_POST['child_21']) && isset($_POST['child_22'])){
            $child_21 = $_POST['child_21'];
            $Update_query_child_21 ="UPDATE `menu` SET `parent`='$id_parent_2',`child`='0' WHERE `Menu_name` = '$child_21'";
            $fire_child_21 = mysqli_query($conn,$Update_query_child_21);
            $child_22 = $_POST['child_22'];
            $Update_query_child_22 ="UPDATE `menu` SET `parent`='$id_parent_2',`child`='0' WHERE `Menu_name` = '$child_22'";
            $fire_child_22 = mysqli_query($conn,$Update_query_child_22);
            if ($fire_child_21 && $fire_child_22){
                echo '<script>alert("Parent 2 updated successfully")</script>';
            }
        }elseif (isset($_POST['child_21'])) {
            $child_21 = $_POST['child_21'];
            $Update_query_child_21 ="UPDATE `menu` SET `parent`='$id_parent_2',`child`='0' WHERE `Menu_name` = '$child_21'";
            $fire_child_21 = mysqli_query($conn,$Update_query_child_21);
            if ($fire_child_21){
                echo '<script>alert("Parent 2 updated successfully")</script>';
            }
        }else{
            if ($fire_update_parent_2){
                echo '<script>alert("Parent 2 updated successfully")</script>';
            }
        }
    }
}
header ('location:index.php')
?>