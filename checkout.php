<?php 
include 'includes/dbcontroller.php';
include 'includes/rb.php';
session_start();
if (!isset($_SESSION['cart_item'])) 
{ 
//session_destroy();
header('Location:index.php');
exit(); 
}

include 'includes/header.php'; 
/////////////////////////////////////////////// cuatomer logged in
if(!R::testConnection())
{
  R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}
if (isset($_SESSION['emailauth']))   /// already logged in 
    {
        $email=$_SESSION['emailauth'];
        //$db_handle = new DBController();
        //$customerByEMAIL = $db_handle->runQuery("SELECT * FROM customers WHERE email='" . $email . "'");  
//print_r($email);
          // exit;
        $pages = R::find('customers',' email = ? ', array( $email ));

       // print_r( $pages ); exit;
        if($pages)
        {
        foreach ($pages as $entry)
        {


        $fname=$entry['first_name'];
        $lname=$entry['last_name'];
        $add1=$entry['address'];
        $city=$entry['city'];
        $country=$entry['country'];
        $code=$entry['postcode'];
        $email=$entry['email'];
        $phone=$entry['phone'];
        $role=$entry['role'];

        $_SESSION['customer_new']=array("$fname","$lname","$add1","$city","$country","$code","$email","$phone","$role");
                                  //array("$fname","$lname","$add2","$city","$country","$code","$email","$phone","$pass_hash");

        break;
       }
      }
  }

//////////////////////////////////////////////////////////////////////
if (isset($_POST['submit']))
{
   
//$db_handle = new DBController();

 if(!empty($_SESSION["cart_item"])) 
  {
    foreach ($_SESSION["cart_item"] as $item)
    {

    $name=$item["name"];
    $qty=$item["qauntity"];
    $a=$qty;
    $color=$item["color"];
    $size=$item["size"];
    $bill=$item["bill"];
    $price=$item["price"];
    $id=$item["item_id"];

    $id=$item["item_id"];///////////////////////////////////////////

    // if (isset($_SESSION['emailauth']))   /// already logged in 
    // {
    //     $email=$_SESSION['emailauth'];
    // }

     // else 
    $email= $_SESSION["customer_new"][6];  /// use new email 


     
     // $ORDER=$db_handle->runAdd("INSERT INTO orders (`name`, `customer_address`, `quantity`, `color`, `size`, `price`, `bill`) VALUES ('$name','$email','$qty','$color','$size','$price','$bill')"); 

////////////////////////////////

if(!R::testConnection())
{
  R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}
$t=time();

$orders = R::dispense( 'orders' );
$orders->name = $name;
$orders->customer_address = $email;
$orders->quantity = $qty;
$orders->color = $color;
$orders->size = $size;
$orders->price = $price;
$orders->bill = $bill;
$orders->date = date("Y-m-d",$t);
$id=R::store($orders);
//R::close();

///////////////////////////////////////


// TO UPDATE ITEM NUMBER IN DB 
/////////////////////////////
if(!R::testConnection())
{
  R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}
$pages = R::find('items',' name = ? ', array( $name ));


foreach ($pages as $entry)
{
  $qauntity=$entry['qauntity'];
   $id=$entry['id'];
  break;
}
$a=$qauntity-$a;
//  var_dump($a);                               
// var_dump($id); exit;
$ob=R::load('items',$id);
//echo $ob;
$ob->qauntity=$a;
$id=R::store($ob);



////////////////////////////////////////////////////////////////////////////FROM HERE 


//$ob=R::load('items',$id);

//$GET_ITEM_QTY = $db_handle->runQuery("SELECT qauntity FROM items WHERE name='" . $name . "'"); 
//$a=$GET_ITEM_QTY[0]["qauntity"]-$a;

//$DELETE_ITEMS = $db_handle->runAdd("UPDATE `items` SET `qauntity` = $a WHERE name='" . $name . "'"); 


    }
  if(!empty($_SESSION["customer_new"]) && !isset($_SESSION['emailauth'])) 
  {

    $fname=$_SESSION["customer_new"][0];
    $lname=$_SESSION["customer_new"][1];
    $add1=$_SESSION["customer_new"][2];
    $city=$_SESSION["customer_new"][3];
    $country=$_SESSION["customer_new"][4];
    $code=$_SESSION["customer_new"][5];
    $email1=$_SESSION["customer_new"][6];
    $phone=$_SESSION["customer_new"][7];
    $role=$_SESSION["customer_new"][8];
    $pass_hash=$_SESSION["customer_new"][9];
   // $role="Customer";


// $CUSTOMER = $db_handle->runAdd("INSERT INTO customers (`first_name`, `last_name`, `address`, `city`, `country`, `postcode`, `email`, `password_hash`, `phone`, `Role`) VALUES ('$fname','$lname','$add1','$city','$country','$code','$email1','$pass_hash','$phone','$role')");
//var_dump($CUSTOMER); exit;
$_SESSION["emailauth"]=$email1; // make him logged into the system 



//R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');

$customers = R::dispense( 'customers' );
$t=time();
$customers->first_name = $fname;
$customers->last_name = $lname;
$customers->address = $add1;
$customers->city = $city;
$customers->country = $country;
$customers->postcode = $code;
$customers->email = $email1;
$customers->password_hash = $pass_hash;
$customers->phone = $phone;
$customers->role = $role;
$customers->date = date("Y-m-d",$t);

$id=R::store($customers);
//var_dump($customers ); exit;
R::close();

/////ONCE SUBMITTED CART SHOULD BE EMPTY 


//unset($_SESSION["cart_item"]);


  }
  $_SESSION['confirm']=1;
unset($_SESSION['item_number']);
unset($_SESSION['basket']);  ///// cant go to viewbasket 
unset($_SESSION["customer_ok"]);

 } 


header('Location:checkout.php'); // because now i have tpo show the print invoice button 
exit();

}

?>
<article id="basket">

<h1>Check and submit your order</h1> 
<div style="float:left;">
    <table border="1" style="float:left; width:670px; font-size:14px;">
        <tr>
            <th scope="col" style="padding:10px;width:400px;">Item(s)</th>
            <th  style="padding:10px;width:250px; text-align:center;">Details</th>
            
        </tr>
    <!--  -->
        
            <?php 
    if(!empty($_SESSION["cart_item"])) 
    {
         $item_total = 0;
         $bill_total=0;
        foreach ($_SESSION["cart_item"] as $item)
        {    

            $item_total=$item_total+$item["qauntity"];
             $bill_total=$bill_total+$item["bill"];
            ?>

        <tr>
            <td valign="top" style="padding:10px;">
                
                <p style="width:100%;text-align:center;"><a href="#" >
                    <p style="width:100%;text-align:center;"><?php echo $item["name"]; ?></a> </p>
                    <p style="width:100%;text-align:center;"><img width="175px;"  src="<?php echo $item["path"]; ?>"/></p>
                </p>
                
            </td>
            <td valign="top" style="text-align:center;; vertical-align:middle; line-height:20px;">
                <div>
                    <p><b>Quantity:</b> <span><?php echo $item["qauntity"]; ?></span></p>
                    
                    <p><b>Price/Item : EU </b> <span><?php echo $item["price"]; ?></span></p>
                    <p><b>Bill : EU</b> <span><?php echo $item["bill"]; ?></span></p>
                </div>
            </td>
            
        </tr>
                
        <?php
            }
        }
            ?>
        
    </table>

    <table border="1" style="float:left;width:250px;padding-left:10px;font-size:14px;">
        <tr>
            <th scope="col" class="options">Customer Details</th>
        </tr>
    <!--  -->
        <tr>
            <td align="left" valign="top" class="options" style="text-align:top;">
                <dl>
                    <dt>First Name</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][0]))echo $_SESSION["customer_new"][0]; ?></dd>
                    <dt>Last Name</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][1]))echo $_SESSION["customer_new"][1]; ?></dd>
                    <dt>Address</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][2]))echo $_SESSION["customer_new"][2]; ?></dd>
                    <dt>City</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][3]))echo $_SESSION["customer_new"][3]; ?></dd>
                    <dt>Country</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][4]))echo $_SESSION["customer_new"][4]; ?></dd> 
                    <dt>Zip Code</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][5]))echo $_SESSION["customer_new"][5]; ?></dd>
                    <dt>Email</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][6]))echo $_SESSION["customer_new"][6]; ?></dd>
                    <dt>Phone</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][7]))echo $_SESSION["customer_new"][7]; ?></dd>
                    <dt>Status</dt>
                    <dd><?php if(isset($_SESSION["customer_new"][8]))echo $_SESSION["customer_new"][8]; ?></dd>
                </dl>
            </td>
        </tr>
    </table>
    <div>
    <h2 style="float:left;"><strong> TOTAL ITEMS : </strong><?php if(isset($item_total)) echo $item_total;?></h2>
    <br/>  <h2 style="float:left;"><strong>&nbsp;&nbsp; &nbsp;TOTAL BILL : </strong>EU <?php  if(isset($bill_total)) echo $bill_total;?></h2>
    </div> 

    <div style="fload:left; text-align:center;">
    <?php if(isset($_SESSION['item_number'])) 
    { ?>
       
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <p style="float:left;"><button type="submit" class="continue" name="submit">Confirm Your Order</button></p>

                    <p>
                </form> 
      <?php } ?>
    </div>
<?php if(!isset($_SESSION['item_number'])) 
{ ?>
     
        
        <div>
        
        <strong><p>"Congratulations! We have received your Invoice. You will receive your order within 2 - 3 working days."</p> </strong> 

                <button onclick="window.print();" style="color: #fff;">PRINT YOUR INVOICE</button>
<br><br>
    <?php } ?>
</div>
  
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

