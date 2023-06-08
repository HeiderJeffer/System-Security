<?php include 'includes/header.php'; 
//include 'includes/dbcontroller.php';
include 'includes/rb.php';
//$db_handle = new DBController();



////////////////////////////////////////////////////////////////////////REDBEAN 
if(!R::testConnection())
{
        R::setup('mysql:host=localhost;dbname=ecommerce', 'root', '');
}
if(!empty($_GET['id'])) 
{

    $id=$_GET['id'];
    $pages = R::find('categories',' id = ? ', array( $id ));
    //var_dump($pages); exit;
    if($pages)
    {
    foreach ($pages as $entry)
    {
        if($entry['id'])
        {
        $_SESSION["item_ID"]=$id;   
        break;
        }

    }
    }
    else
    {
            header('Location:index.php');
            exit();
    }
       //exit();

    // }   
}


$ob=R::load('categories',$id);


$ob1=R::load('main_categories',$ob->parent_id);


$pages2 = R::find('items',' category_id = ? ', array( $id ));
?>

<article id="grid">   
	<!-- <div id="breadcrumb"><a href="index.php">Home</a> > <a href=""><?php if(isset($ob1->main_category))echo $ob1->main_category ; ?></a> > <h1><?php if(isset($ob->category_name))echo$ob->category_name ; ?></h1></div> -->
    <header>
        <div class="paging">
            Page: <a href="">1</a>&nbsp; | &nbsp;2&nbsp; | &nbsp;<a  href="">3</a>  |  <a  href="">View All</a>
        </div>
       

    </header>
    <ul id="items">
<?php
//$ob2=R::load('items',$id);
     foreach($pages2 as $entry)
    { 
     ?>      
       <li> 
            <a href="item.php?id=<?php echo $entry['id']; ?>">
            <img src=<?php echo $entry['pic_path']; ?> alt=""/></a>
            <a href="item.php?id=<?php echo $entry['id']; ?>" class="title"><?php echo $entry['name']; ?></a>
          <strong>EU <?php echo $entry['price']; ?></strong>
      </li>

<?php }
?>
    </ul>
    <footer>
       <br><br>
       <div class="paging">
            Page: <a href="">1</a>&nbsp; | &nbsp;2&nbsp; | &nbsp;<a  href="">3</a>  |  <a  href="">View All</a>
        </div>
    </footer>
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
