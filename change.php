<?php include 'includes/header.php';
include 'includes/dbcontroller.php';
if (!isset($_SESSION["emailauth"])) 
{
header('Location:index.php');   // customer already logged in 
exit();
}
 function test_input($data) 
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
include 'includes/rb.php';
if(!R::testConnection())
{
  R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
} 
if (isset($_POST['submit']))
{   $password_check=test_input($_POST['pass']);
    $pass1=test_input($_POST['pass1']);
    $pass2=test_input($_POST['pass2']);
        if ($pass1 == $pass2)
        {

         $pages = R::find('customers',' email = ? ', array( $_SESSION["emailauth"] ));       
         //$password_check=$pass1;
          foreach ($pages as $entry)
           {  
            $password_hash=$entry['password_hash'];
            $id=$entry['id'];
            break;
           }

             if ((password_verify("$password_check",$entry['password_hash'])))
            {                
                    $ob=R::load('customers',$id);
                    $pass_hash=password_hash("$pass1", PASSWORD_BCRYPT, array('cost'=> 14));   
                    $ob->password_hash=$pass_hash;
                    $id=R::store($ob);

                   header('Location:index.php');
                   exit();
            }
                 }
                  }
?>

<article id="address">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    	<h1>Welcome  <?php if(isset($_SESSION["myname"])) echo $_SESSION["myname"]; ?></h1>
        <br>
       	<p>
            <label for="item_id">Enter Old Password</label>
            <input id="billFName" name="pass" type="Password" required="true">
        </p>
        
       
         <p>
            <label for="item_id">Enter New Password</label>
            <input id="billFName" name="pass1" type="Password" required="true">
        </p>
         <p>
            <label for="item_id">ReEnter New Password</label>
            <input id="billFName" name="pass2" type="Password" required="true">
        </p>
       <br><br><br>
        <p>
          <label>&nbsp;</label><button type="submit" class="continue" name="submit">Change Password</button>
        </p>
    </form>
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
