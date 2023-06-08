<?php include 'includes/header.php';
include 'includes/dbcontroller.php';
include 'includes/rb.php';

if (!isset($_SESSION["role"]) && $_SESSION["role"] !="Admin") 
{ 
header('Location:index.php');
exit(); 
}
$db_handle1 = new DBController();
//$CATEGORYS = $db_handle1->runQuery("SELECT category_name,category_id FROM `categories` ");  
$target_dir = "images/";


if(!R::testConnection())
{
  R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
} 

$pages = R::findAll('categories');

foreach ($pages as $entry)
{

}
 function test_input($data) 
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

if (isset($_POST['submit']))
{
$db_handle = new DBController();

    $category=test_input($_POST['category']);
    $name=test_input($_POST['name']);
    $qty=test_input($_POST['qty']);
    $color=test_input($_POST['color']);
    $price=test_input($_POST['price']);
    $desc=test_input($_POST['desc']);

   if (($category!="") && (!empty($name)) && (!empty($qty)) && (!empty($color)) && (!empty($price))  && (!empty($desc)) )
   {

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 
$tempFileName = $_FILES["fileToUpload"]["tmp_name"];
 
$result = move_uploaded_file($tempFileName,$target_file);

// Check if image file is a actual image or fake image

    $check = getimagesize($target_file);
    if($check !== false) 
    {

$db_handle->runAdd("INSERT INTO items (`category_id`, `name`, `qauntity`, `color`, `price`, `pic_path`,`description`) VALUES ('$category','$name','$qty','$color','$price','$target_file','$desc')");
    
if(!R::testConnection())
{
 R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}


$items = R::dispense( 'items' );
$items->category_id = $category;
$items->name = $name;
$items->qauntity = $qty;
$items->color = $color;
$items->price = $price;
$items->pic_path = $target_file;
$items->description = $desc;
$id=R::store($items);
    header('Location:index.php');
   exit();

    } 
   }
 }
?>

<article id="address">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  enctype="multipart/form-data">
    	<h1>Add New Item</h1>

        <p>
       <label>Select Category:</label>
            <select id="category" name="category" required="true">
            <option value="">SELECT CATEGORY</option>

        <?php  foreach($pages as $entry)
         {  ?>
              <option value="<?php echo $entry['id']; ?>"><?php echo $entry['category_name']; ?></option>
       <?php } ?>  
           </select>
        </p>

        <p>
            <label >Item Name:</label>
            <input id="name" name="name" type="text" required="true"><span class="alert">*</span>
        </p>
        <p>
            <label >Quantity</label>
             <input id="name" name="qty" type="number" required="true"><span class="alert">*</span>
        </p>
        <p>
            <label >Color</label>
             <select id="color" name="color" required="true">
             <option value="">SELECT COLOR</option>
                <option value="red">Red</option>
                <option value="blue">Blue</option>
                <option value="black">Black</option>
                <option value="indigo">Indigo</option>
                <option value="mix">Mix</option>
                
                </select>
        </p>
         <p>
            <label >Price:</label>
            <input id="name" name="price" type="text" required="true"><span class="alert">*</span>
        </p>
         <p>
            <label >Description:</label>
            <textarea class="form-control" data-required="true" placeholder="Item Details" rows="5" cols="40" name="desc"  ></textarea>
        </p>
        <p>
            <label >Select Image:</label>       
 
             <input type="file" name="fileToUpload" id="fileToUpload" required="true">
            

        </p>
        
        <p>
          <label>&nbsp;</label><button type="submit" class="continue" name="submit">Add Item</button>
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
<br><br>
</footer>

</body>
</html>
