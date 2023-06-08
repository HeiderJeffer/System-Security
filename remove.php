<?php
session_start();
if (isset($_GET['id']))
{
        if(!empty($_SESSION["cart_item"])) 
        {
        foreach($_SESSION["cart_item"] as $k => $v) 
        {
      
        if($_GET['id'] == $v["item_id"])
         unset($_SESSION["cart_item"][$k]);            
        if(empty($_SESSION["cart_item"]))
         unset($_SESSION["cart_item"]);
         }
         $_SESSION['item_number']--;
        }
   
header('Location:viewbasket.php');
  exit();   
}
?>