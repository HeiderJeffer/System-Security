<?php include 'includes/header.php'; ?>
<article id="basket">
<h1>
<!doctype html>
<html>
<head>
<title></title>
</head>
<body>
<p id="cartDefaultHeading"><span dir="ltr">Your Shopping Cart Contents</span></p>
</body>
</html>
</h1> 
<table width="100" border="1">
    <tr>
        <th scope="col" class="description">Product Details</th>
        <th scope="col" class="options">Summary</th>
        <th align="right" scope="col" class="price">Bill</th>
    </tr>
<!--  -->
    
<?php
if (!$_SESSION['basket'])  // cart is empty 
{
    header('Location:index.php');
    exit(); 
}
if (isset($_POST['check'])) // customer going for address details
{
    $_SESSION["cart_ok"]=1; /// failda nazr nahe aya 
    header('Location:customerdetails.php');
    exit(); 
} 
  if(isset($_SESSION["cart_item"]))
  {
    $item_total = 0;
    $bill_total=0;
foreach ($_SESSION["cart_item"] as $item)
    {//print_r($_SESSION["cart_item"]);exit;
      $item_total=$item_total+$item["qauntity"];
      $bill_total=$bill_total+$item["bill"];
        ?>

      <tr>
        <p></p>
        
        <td align="left" valign="top" class="description"><img  src="<?php echo $item["path"]; ?>"><p><a href="#" <?php echo $item["name"]; ?>><?php echo $item["name"]; ?></a><br /> </p>
        <a href="remove.php?id=<?php echo $item["item_id"];?>" class=""><button type="submit" value="Remove">Remove</button></a>
            
      
        </td>
        <td align="left" valign="top" class="options">
            <dl>
                <dt>Item Name</dt>
                <dd><?php echo $item["name"]; ?></dd>
                <dt>Quantity</dt>
                <dd><?php echo $item["qauntity"]; ?></dd>
                <dt>Colour:</dt>
                <dd><?php echo $item["color"]; ?></dd>
                <dt>Size:</dt>
                <dd><?php echo $item["size"]; ?></dd>
                <dt>Price/Item:</dt>
                <dd>EU <?php echo $item["price"]; ?></dd>
                
                
            </dl>
            <!-- <button>Change details</button> -->
        </td>
        <td align="right" valign="top" class="price">EU <?php echo $item["bill"]; ?></td>
    </tr>    
       <?php
        }
  }
  else
  {
    header('Location:index.php');
    exit();      
  }?>
 <a href="logout.php" class=""><button type="submit" value="Remove">Empty Cart</button></a>
    
</table>
<div class="right">
    <strong >Subtotal before Delivery Charges</strong> <em > EU <?php if(isset($bill_total)) echo $bill_total;?></em><br />
    <p style="float:left;"><strong> TOTAL ITEMS :</strong>  <?php if(isset($item_total)) echo $item_total;?></p>
     <p style="float:left;"><strong> TOTAL BILL :</strong> EU <?php if(isset($bill_total)) echo $bill_total;?></p>
</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<button class="continue" name="check">Checkout</button>
</form>
</article>

<footer>



  
</footer>
</body>
</html>