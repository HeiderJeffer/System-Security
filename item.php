<?php include 'includes/header.php'; 
//include 'includes/dbcontroller.php';
include 'includes/rb.php';
//$db_handle = new DBController();
 
if(!empty($_GET['id'])) 
{
    $id=$_GET['id'];
    $_SESSION["item_ID"]=$id;
}

if (isset($_POST['submit'])) 
{
    $id=$_SESSION["item_ID"];
if(!R::testConnection())
{
        R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}
    

   if(!empty($_POST["qauntity"])) 
     {
//$productByID = $db_handle->runQuery("SELECT * FROM items WHERE item_id='" . $id . "'"); 
// $pages = R::find('items',' id = ? ', array( $id ));
$ob=R::load('items',$id);

 $prices=$ob->price;
 $name=$ob->name;
 $ids=$ob->id;
 $path=$ob->pic_path;


$total=$prices*$_POST["qauntity"];


$itemArray = array($name=>array('name'=>$name, 'item_id'=>$ids, 'qauntity'=>$_POST["qauntity"], 'price'=>$prices,'color'=>$_POST["item_color"],'size'=>$_POST["item_size"],'bill'=>$total,'path'=>$path));

            if(!empty($_SESSION["cart_item"])) 
            {
                if(in_array($name,array_keys($_SESSION["cart_item"]))) 
                {
                    // var_dump(in_array($productByID[0]["item_id"],array_keys($_SESSION["cart_item"])));exit;
                    foreach($_SESSION["cart_item"] as $k => $v) 
                    {
                            if($name == $k) 
                            {
                                if(empty($_SESSION["cart_item"][$k]["qauntity"])) 
                                {
                                    $_SESSION["cart_item"][$k]["qauntity"] = 0;
                                }

                                $_SESSION["cart_item"][$k]["qauntity"] += $_POST["qauntity"];
                                $_SESSION["cart_item"][$k]["bill"]+=$total;
                            }
                    }
                } 
                else 
                {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    $_SESSION['item_number']++;
                }
            } 
            else 
            {
                $_SESSION["cart_item"] = $itemArray;  /// new cart 
                $_SESSION['item_number']++;
               
            }

             $_SESSION['basket']=1;
             header('Location:index.php');
    exit();  
           
}
}
?>
<article id="mainview">
   
    <?php 
if(!R::testConnection())
{
        R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}

 $ob1=R::load('items', $_SESSION["item_ID"]);

 $category_id=$ob1->category_id;
 $item_name=$ob1->name;

$ob2=R::load('categories', $category_id);


 $category_name=$ob2->category_name;
  $parent_id=$ob2->parent_id;

$ob3=R::load('main_categories', $parent_id);

 $main_category=$ob3->main_category;

    ?>
<!-- 
     <div id="breadcrumb"><a href="index.php">Home</a> > <a href="index.php"><?php if(isset($main_category))echo $main_category; ?></a> > <a href="#"><?php if(isset($category_name))echo $category_name; ?></a> > <?php if(isset($item_name))echo $item_name; ?></div> -->
  <?php 
        if(!empty($ob1))
        {?>

            <br><br>
    <div id="description"> 

        <div class="product-item">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
             <h1><?php if(isset($ob1->name))echo $ob1->name;  ?></h1>

        <strong id="price" value="<?php echo $ob1->price; ?>">Price: EU <?php echo $ob1->price; ?>
        </strong>
        
        <p><?php echo $ob1->description; ?></p>
        <p id="totalf"></p>
        <strong>Color</strong>
        <p>
            <select name="item_color" class="SelectColor" id="color" >
                
                <option value="Blue" selected="selected">Blue</option>
                <option value="Red">Red</option>
                <option value="Black">Black</option>
                <option value="Indigo">Indigo</option>
                <option value="Mix">Mix</option>
            </select>
        </p>
        <strong>Size</strong>
        <p>
            <select name="item_size" class="SelectSize" id="size" onchange="">
                
                 <option value="small" selected="selected">Small (S)</option>
                <option value="medium">Medium (M)</option>
                <option value="large">Large (L)</option>
                <option value="Xtra large">Extra Large (XL)</option>
            </select>
           <!--  <button type="button">Size guide</button> -->
        </p>
        <?php   
    if ($ob1->qauntity<=0)  
       { ?>
    <font color="red"><strong ><p>Qauntity (N/A)</p></strong></font>
  
      <?php 
        } 

        else { ?>

        <strong><p>Qauntity (In Stock)</p></strong>

        <?php } ?>
<select id="mySelect" onchange="myFunction()" name="qauntity"> 

<?php  
//var_dump($ob1->category_name); exit;
if ($ob1->qauntity<=0) 
{ ?>
    <option  value="" >Out of Stock</option>
<?php 
}
if (isset($ob1->qauntity)) 
{

for ($i=1; $i <= $ob1->qauntity ; $i++) 
{ 
?>
<option  value="<?php if(isset($ob1->qauntity)){echo $i;} ?>" ><?php echo $i; ?></option>
<?php 
}
}
?>
</select>
<strong id="price">Total Price: EU <label id="total" name='' ><?php echo $ob1->price; ?></label></strong>
<p>Price incl. VAT, delivery costs excl. (29 € incl. VAT). 
Shipping within 4 - 6 working days</p>

<strong><input type="checkbox" name="vehicle" id="a" value="Bike">  I agree to the Terms and Conditions. </strong> 
<br><br>
<input type="hidden" value="<?php echo $ob1->id; ?>" name="item_id"/>
        <p><button  disabled="disabled" id="mytestbutton" class="continue" name="submit" >Add to Cart</button></p>  
            </form>
        </div>
    <?php          
        }
    ?>
            <section id="tabs-1">
            </section>
            <section id="tabs-2">
            </section>
            <section id="tabs-3">

            </section>
        </div>
    </div>
    <div id="images">
    	<a><img src="<?php echo $ob1->pic_path; ?>"></a>

<!--   <p>Rollover to zoom. Click to enlarge.</p> -->
        <!-- <span class="sale">Sale</span>
        <div id="productthumbs">
            <a href="#"><img src="<?php echo $ob1->pic_path; ?>" /></a><a href="#"><img src="<?php echo $ob1->pic_path; ?>"/></a><a href="#"><img src="<?php echo $ob1->pic_path; ?>"/></a>
        </div>
    </div>
</article>
 -->

<script>
function myFunction() 
{
    var x = document.getElementById("mySelect").value;
    var t = <?php echo $ob1->price; ?>;
    document.getElementById("total").innerHTML= t*x;
    y.style.color="red";   
}
</script>
<script src="js/func.js"></script>

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