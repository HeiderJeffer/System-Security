<!-- TODO list --> 
<!-- Create an account or sign in to continue -->
<!-- <p><a href="">Forgot your password?</a></p> -->
<?php 
if (session_status() == PHP_SESSION_NONE) 
{
    session_start();
}
if (isset($_SESSION['LAST_REQUEST_TIME'])) {
    if (time() - $_SESSION['LAST_REQUEST_TIME'] > 180) {
        // session timed out, last request is longer than 3 minutes ago
        $_SESSION = array();
        session_destroy();
    }
}
$_SESSION['LAST_REQUEST_TIME'] = time();

if (isset($_SESSION["emailauth"])) 
{
    header('Location:index.php');
    exit();
}

include 'includes/rb.php';
if(!R::testConnection())
{
  R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
} 
 R::debug(false);
 function test_input($data) 
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}


if (isset($_POST['submit'])) 
{
    if (!empty(test_input($_POST['email'])) && !empty($_POST['password'])) 
    {
         $password_check=$_POST['password'];

        $pages = R::findAll('customers');
        foreach ($pages as $entry)
        {
        if ((password_verify("$password_check",$entry['password_hash'])) && ($_POST['email']==$entry['email']))
            {
            $_SESSION["myname"]=$entry['first_name'];
            $_SESSION["myemail"]=$entry['email'];
                if ($entry['role']=="Admin") 
                {
                   $_SESSION["role"]="Admin"; 
                }
            $_SESSION["user"]="great123"; 
            $_SESSION["emailauth"]=$_POST['email'];
            ob_end_clean();
            header('Location:index.php');
            exit();
            }

           
            }

    
    }  
    
}
 

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>Welcome to AYO SHOP</title>
<link rel="stylesheet" href="css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css'>

<!-- The below script Makes IE understand the new html5 tags are there and applies our CSS to it -->
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body>
<header>
    <div class="wrapper">
    </div>

</header>
<aside id="top">
    <div class="wrapper">
        
                <div class="sider-parent" style="float: left; width: 400px; border: 0px solid red; padding: 0px;">
        
            <!-- Hompage Jak page Shirts page ..etc -->
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
<article id="login">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    	<h1><STRONG>LOG IN </STRONG></h1>
        <p><label for="email">Email</label>
        <input type="email" name="email" required="required" /></p>
        <p><label for="pasword">Password</label>
        <input type="password" name="password" required="required"/></p>

        <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">LOG IN</button>
       <!-- TODO  --> 
        <!-- <p><a href="">Forgot your password?</a></p> -->
    </form>
<!-- TODO  --> 
<!-- Create an account or sign in to continue -->
   
    <section>
    	<H1><strong> Ayo Store </strong></H1>
       <P>Reminds me of old school tailoring, great jackets, Beat my expectations by a mile.</P>         <p> - Heider & Ayo</p>
    </section>

</article>
<footer>

   
<!doctype html>
<html>
<head>
    <title>HTML Editor - Full Version</title>
</head>
<body>
<p style="text-align: center;"><kbd><span style="font-size:12px;">Free University of Bozen-Bolzano<br />
Faculty of Computer Science&nbsp;<br />
AYO SHOP for SYSTEM SECURITY<br />
Developed by<br />
Heider Jeffer and&nbsp;Ayokunmi Opaniyi&nbsp;<span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; background-color: rgb(255, 255, 255);">&copy; 2018</span></span></kbd></p>

<p>&nbsp;</p>
</body>
</html>
<br><br>

    
</footer>
</body>
</html>