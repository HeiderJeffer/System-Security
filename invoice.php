<?php 
//include 'includes/dbcontroller.php'; 
include 'includes/rb.php';
session_start();
if (!isset($_SESSION["emailauth"])) 
{ 

header('Location:index.php');
exit();
 
}
include 'includes/header.php'; 

?>
<article id="basket">
<?php
//$db_handle = new DBController();

$customer=$_SESSION["emailauth"];
if(!R::testConnection())
{
  R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}
$pages = R::find('customers',' email = ? ', array( $customer ));

foreach ($pages as $entry)
{
 $first_name=$entry['first_name'];
 $last_name=$entry['last_name'];
 $address=$entry['address'];
 $city=$entry['city'];
 $country=$entry['country'];
 $postcode=$entry['postcode'];
 $email=$entry['email'];
 $phone=$entry['phone'];


 break;
}


//$customerByEMAIL = $db_handle->runQuery("SELECT * FROM customers WHERE email='" . $customer . "'");  
?>
<h1><?php echo $first_name; ?></h1> 

<table width="100" border="1">
    <tr>
        <th scope="col" class="options">Your Account Details</th>
        
        
    </tr>
<!--  -->


<?php

 

if(isset($_SESSION["emailauth"]))
{
?>

   <tr>
        <td align="" valign="" class=""><br />
        <dl>
              <dt>First Name</dt>
              <dd><?php echo $first_name; ?></dd>
              <dt>Last Name</dt>
              <dd><?php echo $last_name; ?></dd>
              <dt>Address</dt>
              <dd><?php echo $address; ?></dd>
              <dt>City</dt>
              <dd><?php echo $city; ?></dd>
              <dt>Country</dt>
              <dd><?php echo $country; ?></dd> 
              <dt>Zip Code</dt>
             <dd><?php echo $postcode; ?></dd>
              <dt>Email</dt>
              <dd><?php echo $email; ?></dd>
              <dt>Phone</dt>
              <dd><?php echo $phone; ?></dd>
            

        </dl>

        </td>
    </tr>


     <p></p>



<?php 
}
$count =1; 
 


//$orderByEMAIL = $db_handle->runQuery("SELECT * FROM orders WHERE customer_address='" . $customer . "'"); 
$pages = R::find('orders',' customer_address = ? ', array( $customer )); 
if ($pages ) 
{
  # code...
foreach ($pages as $entry)
{
   ?>

      <tr>
        <p></p>
        
        <td align="" valign="" class=""><br />
        <dl>
              <dt></dt>
              <dd></dd>
             

        </dl>

        </td>
 <th scope="col" class="options">VIEW YOUR ORDER(S) </th>
        <td align="left" valign="top" class="options">
            <dl>
                <p valign="top" class="description"></p>
                <strong><dt>Order # <?php echo $count;   ?></dt></strong>
                <dd></dd>
                <dt>Name</dt>
                <dd><?php echo $entry['name']; ?></dd>
                <dt>Quantity</dt> 
                <dd><?php echo $entry['quantity']; ?></dd>
                <dt>Date:</dt>
                <dd><?php echo $entry['date'];; ?></dd>
                <dt>Bill:</dt>
                <dd>EU <?php echo $entry['bill']; ?></dd>
                
                
            </dl>
         
        </td>

    </tr>

<?php $count++;
  }
    }
        ?>
</table>

    
<div>

<!-- <p><button type="submit" class="continue" name="" id="account" onclick="ImageHosting_Click()">Delete Account</button></p>  -->

</div>

</form>
<br><br>

<!-- <img src="images/creditcards.gif" class="safe" /> -->

</article>

<script type="text/javascript">

   function ImageHosting_Click() {
               $("#account").click(function () 

               {
                   alert("Are you sure ?");
               });
       }

</script>
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