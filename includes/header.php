<?php 

if (session_status() == PHP_SESSION_NONE) 
{
    session_start();
}
if (isset($_SESSION['LAST_REQUEST_TIME'])) 
{
    if (time() - $_SESSION['LAST_REQUEST_TIME'] > 1800) 
    {
        // session timed out, last request is longer than 3 minutes ago
        $_SESSION = array();
        session_destroy();
    }
}
$_SESSION['LAST_REQUEST_TIME'] = time();

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>AYO</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/style2.css" />
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

</head>
<body>
<header>
    <div class="wrapper">

      

<!-- 
            <nav>
            <ul>
                        <li><a href="index.php">Home</a></li> 
                        <li><a href="category.php?id=18">Jackets </a></li>   
                        <li><a href="category.php?id=1">Shirts</a></li>
                        <li><a href="category.php?id=17">Trousers</a></li>
                        
          </ul>
        </nav> -->


    </div>
</header>

<aside id="top">
    <div class="wrapper">
        
        <div class="sider-parent" style="float: left; width: 400px; border: 0px solid red; padding: 0px;">

    
                <a class="sider" href="index.php">Home</a>
                <a class="sider" href="category.php?id=18">Jackets </a>
                <a class="sider" href="category.php?id=1">Shirts</a>
                <a class="sider" href="category.php?id=17">Trousers</a>                      
  
        
        </div>
       

        <?php  if (isset($_SESSION["emailauth"])) 
        { ?>
                                
        <div id="action-bar"><a href="change.php"><img src="images/pass.jpg" height="24" width="21"></a> <a href="invoice.php"><img src="images/invoice.jpg" height="24" width="21"></a>  <a href="viewbasket.php"><img src="images/shopping-cart1.png" height="24" width="21"><?php if(isset($_SESSION['item_number'])){echo $_SESSION['item_number'];} ?></a><a href="logout.php"><img src="images/signout.jpg" height="24" width="21"></a></div>
      
        <?php 
        }    
        else 
        { ?>
                                
      <div id="action-bar"><a href="login.php"><img src="images/login-key.png" height="24" width="21"></a> <a href="viewbasket.php"><img src="images/shopping-cart1.png" height="24" width="21"><label><?php if(isset($_SESSION['item_number'])){echo $_SESSION['item_number'];} ?></label></a></div>
        <?php }?>

    </div>
</aside>