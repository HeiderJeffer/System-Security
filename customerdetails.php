<?php include 'includes/header.php';
//include 'includes/dbcontroller.php';
include 'includes/rb.php';

if (!isset($_SESSION['cart_item'])) 
{ 
//session_destroy();
header('Location:index.php');
exit(); 
}

if (isset($_SESSION["emailauth"])) 
{

header('Location:checkout.php');   // customer already logged in 
exit();
}
if (isset($_SESSION["customer_ok"]))  // customer coming from back page 
{
header('Location:checkout.php');
exit();
}

function test_input($data) 
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['submit']))
{
$error1=$error2=$error3=$error4=$error5=$error6=$error7=$error8=$error9=$error10=FALSE;// no error
$Email_ok=1;
// $db_handle = new DBController();
// $customerByEMAIL = $db_handle->runQuery("SELECT email FROM customers "); 
if(!R::testConnection())
{
        R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}


    $fname=test_input($_POST['fname']);
    $lname=test_input($_POST['lname']);
    $add2=test_input($_POST['address']);
    
    $country=test_input($_POST['country']);
    $city=test_input($_POST['city']);
    $code=test_input($_POST['code']);
    $email=test_input($_POST['email']);
    $phone=test_input($_POST['phone']);
    $pass1=$_POST['pass1'];
    $pass2=$_POST['pass1'];
//var_dump($_POST); exit;


if (empty($fname)) 
{
$error1 = "First name needed";
//$code = 2;
}

elseif(empty($lname))
{

$error2 = "last name needed";
//$code = 2;
}
elseif (empty($add2))
{

$error3 = "Address needed";
//$code = 2;
}

elseif (empty($country))
{

$error4 = "Country needed";
//$code = 2;
}

elseif (empty($city))
{

$error5 = "City needed";
//$code = 2;
}

elseif (empty($code))
{

$error6 = "Postal needed";
//$code = 2;
}

elseif (empty($phone))
{

$error7 = "Phone needed";
//$code = 2;
}

elseif (!is_numeric($phone))
{

$error7 = "Numbers only";
//$code = 2;
}

elseif (empty($email))
{

$error8 = "Cant be empty";
//$code = 2;
}


$pages = R::find('customers',' email = ? ', array( $email ));
    if($pages)
    {
    foreach ($pages as $entry)
    {

        //$check=$entry['email'];
        $error8 = "Choose another email !";  
        break;
      

    }
    }

elseif (empty($pass1))
{

$error9 = "Cant be empty";
//$code = 2;

}


elseif (empty($pass2))
{

$error10 = "Cant be empty";
//$code = 2;
}

elseif ($pass2!=$pass1)
{

$error9 = "Passwords don't match !";
//$code = 3;
}

//print_r($error9);print_r($error8);print_r($error7);print_r($error6);print_r($error5);exit;
else
{  
$pass=$_POST['pass1'];
$pass_hash=password_hash("$pass", PASSWORD_BCRYPT, array('cost'=> 14));   
$role="Customer";
$_SESSION['customer_new']=array("$fname","$lname","$add2","$city","$country","$code","$email","$phone","$role","$pass_hash");



$_SESSION['emailnew']=$email;

$_SESSION["customer_ok"]=1;
header('Location:checkout.php');
exit();
}
}

?>

<article id="address">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width: 450px">
       
        <strong><h1>Sign Up</h1></strong> 
        <br><br>
        
        <p>
            <label for="billFName">First name:</label>
            <input id="billFName" name="fname" type="text" value="<?php if(isset($fname)){echo $fname;} ?>"><span class="alert">* 
           <?php if(isset($error1)){ ?><?php echo $error1; ?><?php }?></span> 
        </p>
       
        <p>
            <label for="billLName">Last name:</label>
            <input id="billLName" name="lname" type="text" value="<?php if(isset($lname)){echo $lname;} ?>"><span class="alert">*
            <?php if(isset($error2)){ ?><tr><td id=""><?php echo $error2; ?><?php }?></span>
        </p>
        <p>
            <label for="billAddress1">Address:</label>
            <input id="billAddress1" name="address" type="text" value="<?php if(isset($add2)){echo $add2;} ?>"><span class="alert">*
            <?php if(isset($error3)){ ?><tr><td id=""><?php echo $error3; ?><?php }?></span>
        </p>
       
         <p>
            <label for="billCountry">Country:</label>
            <input id="billCountry" name="country" type="text" value="<?php if(isset($country)){echo $country;} ?>" ><span class="alert">*
            <?php if(isset($error4)){ ?><tr><td id=""><?php echo $error4; ?><?php }?></span>
        </p>
        <p>
            <label for="billCity">City:</label>
            <input id="billCity" name="city" type="text" value="<?php if(isset($city)){echo $city;} ?>"><span class="alert" >*
            <?php if(isset($error5)){ ?><tr><td id="error"><?php echo $error5; ?><?php }?></span>
        </p>
       
        <p>
            <label for="billZip">Post code:</label>
            <input id="billZip" name="code" type="text" value="<?php if(isset($code)){echo $code;} ?>" ><span class="alert" >*
            <?php if(isset($error6)){ ?><tr><td id="error"><?php echo $error6; ?><?php }?></span>
        </p>
        
         <p>
            <label for="phone">Phone:</label>
            <input id="phone" name="phone" type="tel" value="<?php if(isset($phone)){echo $phone;} ?>"><span class="alert">*</span>
            <?php if(isset($error7)){ ?><tr><td id="error"><?php echo $error7; ?><?php }?></span>
        </p>
        <p>
            <label for="email">Email:</label>
            <input id="email" name="email" type="email" value="<?php if(isset($email)){echo $email;} ?>" ><span class="alert">*
            <?php if(isset($error8)){ ?><tr><td id="error"><?php echo $error8; ?><?php }?></span>
        </p>
       
         <p>
            <label for="password">Password:</label>
            <input id="password" name="pass1" type="password" ><span class="alert">*
            <?php if(isset($error9)){ ?><tr><td id="error"><?php echo $error9; ?></td></tr><?php }?></span>
        </p>
        <p>
            <label for="password">Confirm Password</label>
            <input id="password" name="pass2" type="password" ><span class="alert">*
            <?php if(isset($error10)){ ?><tr><td id="error"><?php echo $error10; ?></td></tr><?php }?></span>
        </p>

       
    <label>&nbsp;</label><button type="submit" class="continue" name="submit">I Agree! login to AYO!</button>
 

        </p>
 
        </form>
</article>

<br><br>
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
