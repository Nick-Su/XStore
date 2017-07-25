<!DOCTYPE html>
<?php
   include("functions.php");
   session_start();
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XStore | digital</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <!-- <link href="css/styles.css" rel="stylesheet"> -->
    <!-- CSS -->
    <link href="custom_css/basic_style.css" rel="stylesheet">
  </head>
  <body>

<!-- Choose city, Shops, 4customers, Login and Registration -->
    <div class="col-md-12 col-lg-12" id="pre-header">
        <?php include("includes/pre-header.php") ?>
    </div>

<!-- Logo, Navigation, Custom, Search, Cart-->
    <div class="col-md-12 col-lg-12" id="header">
        <?php include("includes/header.php") ?>
    </div>

<!-- Left Side Bar navigation -->
    <div class="col-md-2 col-sm-2 .col-xs-2 " id="left_side_bar">
        <?php include("includes/left_side_bar.php") ?>
   </div>

<!-- Content and Product box -->
    <div class="col-md-9 col-sm-9 .col-xs-2" id="content">
        <div id="products_box" class="col-md-12">
            <?php
              getCatPro();
              getBrandPro();
              if(isset($_SESSION['customer_email'])){
                cart();
              } else {
                guest_cart();
              }
		
			
			//*** custom search engine ***///
            if(isset($_GET['search_now'])){
	
            $search_query = $_GET['user_query'];
			
			$search_query = htmlspecialchars(strip_tags(trim($search_query)));
			
            //$get_pro = "SELECT * FROM products WHERE product_keywords LIKE '%$search_query%'";
			$get_pro = "SELECT * , MATCH (product_title,product_desc, product_keywords) 
						AGAINST ('$search_query') FROM `products` 
						WHERE MATCH (product_title,product_desc,product_keywords) AGAINST ('$search_query') > 1";
            $run_pro = mysqli_query($con, $get_pro);
			
			$number = mysqli_num_rows($run_pro);
			
			if($number >= 1) {
              while ($row_pro = mysqli_fetch_array($run_pro)) {
                $pro_id = $row_pro['product_id'];
                $pro_cat = $row_pro['product_cat'];
                $pro_brand = $row_pro['product_brand'];
                $pro_title = $row_pro['product_title'];
                $pro_price = $row_pro['product_price'];
                $pro_image = $row_pro['product_image'];
				
				
				
				

					echo "
						  <div id='single_product' class='col-xs-3'>
							<div id='pro-title'>
							  <h3>$pro_title</h3>
							</div>
							  <img src='admin_area/product_images/$pro_image' width='180' height='180' />

							  <p><b> $pro_price</b><span class='glyphicon glyphicon-usd'></span></p>
							  <div id='wrap' class='col-md-12'></div>
							  <a href='details.php?pro_id=$pro_id' style='float:center'>Подробнее</a>
							  <div class='btn-wrap'>
							  <a href='index.php?add_cart=$pro_id'>
								<button type='button' class='btn btn-success' style='float:none'>В Корзину!</button>
							  </a>
							  </div>
						  </div>
					  ";

                
			  }
			  
			  
			  $get_pro = "SELECT * , MATCH (product_title,product_desc, product_keywords) 
						AGAINST ('$search_query') FROM `products` 
						WHERE MATCH (product_title,product_desc,product_keywords) AGAINST ('$search_query') > 0.15";
			$run_pro = mysqli_query($con, $get_pro);
			
			$numb = mysqli_num_rows($run_pro);
			
			if($numb >= 1) {
			echo "
				<div class='col-md-12' style='background-color:#0098E5; margin-top:2em;'>
				<h2 style='padding:15px'>Возможно, Вас также заинтересует:</h2>
				</div>
				";
              while ($row_pro = mysqli_fetch_array($run_pro)) {
                $pro_id = $row_pro['product_id'];
                $pro_cat = $row_pro['product_cat'];
                $pro_brand = $row_pro['product_brand'];
                $pro_title = $row_pro['product_title'];
                $pro_price = $row_pro['product_price'];
                $pro_image = $row_pro['product_image'];
				
				
				
				

					echo "
						  <div id='single_product' class='col-xs-3'>
							<div id='pro-title'>
							  <h3>$pro_title</h3>
							</div>
							  <img src='admin_area/product_images/$pro_image' width='180' height='180' />

							  <p><b> $pro_price</b><span class='glyphicon glyphicon-usd'></span></p>
							  <div id='wrap' class='col-md-12'></div>
							  <a href='details.php?pro_id=$pro_id' style='float:center'>Подробнее</a>
							  <div class='btn-wrap'>
							  <a href='index.php?add_cart=$pro_id'>
								<button type='button' class='btn btn-success' style='float:none'>В Корзину!</button>
							  </a>
							  </div>
						  </div>
					  ";

                
			  }
			  
			  
			  
			  
			  
			  
			} } else {
				echo "<h1>Извините, по вашему запросу ничего не найдено. <br> Попробуйте построить фразу иначе</h1>";
				} 
			}
	
	

	
	//main //
	/*
	  if(isset($_GET['search_now'])){
		if(isset($_GET['user_query'])){
			if(preg_match("/^[a-zA-Z0-9 \s]+$/", $_GET['user_query'])){ 
	  			$name=$_GET['user_query']; 
				
				//connect  to the database 
	 		 	$db=mysql_connect ("localhost",  "root", "") or die ('I cannot connect  to the database because: ' . mysql_error());
				//-select  the database to use 
	  			$mydb=mysql_select_db("xstore"); 
				 //-query  the database table 
	  			$sql="SELECT * FROM products WHERE product_title LIKE '%" . $name . "%' OR product_desc LIKE '%" . $name  ."%'";
				//-run  the query against the mysql query function 
				$result=mysql_query($sql); 

				 //-create  while loop and loop through result set 
				while($row=mysql_fetch_array($result)){ 
			          $FirstName  =$row['product_title']; 
			          $LastName=$row['product_desc']; 
			          $ID=$row['product_id']; 
					  //-display the result of the array 
					  echo "<ul>\n"; 
					  echo "<li>" . "<a  href=\"search.php?id=$ID\">"   .$FirstName . " " . $LastName .  "</a></li>\n"; 
					  echo "</ul>"; 
				} 
			} else {
				echo "Please, enter your search query!";
			  }
    
		} 
	  }
	
	
	*/
	
	
	
	
	

	// Another still bad search //
	/*
	$k = $_GET['user_query'];
	$terms = explode("  ", $k);
	$query= "SELECT * FROM products WHERE ";

	foreach($terms as $each)
	{
		$i=0;
		$i++;
		
		if($i==1)
		{
			$query.="product_keywords LIKE '%$each%' ";
		}
		
		
		else
		{
			$query.="OR product_keywords LIKE '%$each%' ";
			
		}
			
	}

//connection
	mysql_connect("localhost", "root", "");
	mysql_select_db("xstore");
	
	
//query
	$query=mysql_query($query);
	$numrows= mysql_num_rows($query);
		if($numrows>0)
		{
			while($row = mysql_fetch_assoc($query))
			{
				$id= $row['product_id'];
				$title= $row['product_title'];
				$description= $row['product_desc'];
				$keywords= $row['product_keywords'];
				
				
				echo "<h2><a href=''>$title</a></h2>
				$description<br/> <br/>";
			}
		
		}
	
		else
		{
	
			echo"No results found for <b>$k</b>\"";
		
		}

	

	
	
	/// WORKS  NOT WELL ////		
	/*	mysql_connect("localhost", "root", "") or die("could not connect");
		mysql_select_db("xstore") or die("No DB");
		$output = '';
		
		//collect//
		if(isset($_GET['search_now'])){
			
			$searchq = $_GET['user_query'];
			$searchq = preg_replace("#[^0-9a-z]#i", " ", $searchq);
			
			$query = mysql_query("SELECT * FROM products WHERE product_title LIKE '%$searchq%' OR product_keywords LIKE '%$searchq%'") or die("could not search");
			$count = mysql_num_rows($query);
			if($count == 0){
				$output = 'There was no search results!';
			} else {
				while($row = mysql_fetch_array($query)){
					$fname = $row['product_title'];
					$lname = $row['product_desc'];
					$id = $row['product_id'];
					
					$output .= '<div> ' .$fname.' '.''.'</div>';
					
					echo "
                      <div id='single_product' class='col-xs-3'>
                        <div id='pro-title'>
                          <h3>$fname</h3>
                        </div>
                          <img src='admin_area/product_images/' width='180' height='180' />

                          <p><b> </b><span class='glyphicon glyphicon-usd'></span></p>
                          <div id='wrap' class='col-md-12'></div>
                          <a href='details.php?pro_id=$id' style='float:center'>Подробнее</a>
                          <div class='btn-wrap'>
                          <a href='index.php?add_cart=$id'>
                            <button type='button' class='btn btn-success' style='float:none'>В Корзину!</button>
                          </a>
                          </div>
                      </div>
                  ";
				}
			}
			
		}
		
			print("$output"); 
			  
      //*** custom search engine ***///
     /*       if(isset($_GET['search_now'])){

            $search_query = $_GET['user_query'];

            $get_pro = " SELECT * FROM `products` WHERE `product_keywords` LIKE '%$search_query%' OR `product_title` LIKE '%$search_query%' OR `product_desc` LIKE '%$search_query%'";
              $run_pro = mysqli_query($con, $get_pro);
              while ($row_pro = mysqli_fetch_array($run_pro)) {
                $pro_id = $row_pro['product_id'];
                $pro_cat = $row_pro['product_cat'];
                $pro_brand = $row_pro['product_brand'];
                $pro_title = $row_pro['product_title'];
                $pro_price = $row_pro['product_price'];
                $pro_image = $row_pro['product_image'];

                echo "
                      <div id='single_product' class='col-xs-3'>
                        <div id='pro-title'>
                          <h3>$pro_title</h3>
                        </div>
                          <img src='admin_area/product_images/$pro_image' width='180' height='180' />

                          <p><b> $pro_price</b><span class='glyphicon glyphicon-usd'></span></p>
                          <div id='wrap' class='col-md-12'></div>
                          <a href='details.php?pro_id=$pro_id' style='float:center'>Подробнее</a>
                          <div class='btn-wrap'>
                          <a href='index.php?add_cart=$pro_id'>
                            <button type='button' class='btn btn-success' style='float:none'>В Корзину!</button>
                          </a>
                          </div>
                      </div>
                  ";

                }
              } */
			  
			  
			  
			  
			  
			  
			  
	/*		
$search = $_GET['user_query'];

 if(isset($_GET['search_now'])){

    mysql_connect ( "localhost", "root", "" ); 
	mysql_select_db ( "xstore" );
	
	
	$search_exploded = explode ( " ", $search ); $x = 0; 
	foreach( $search_exploded as $search_each ) { 
		$x++; 
		$construct = " "; 
		if( $x == 1 ) {
			$construct .= "keywords LIKE '%$search_each%' "; 
		}	else {
			$construct .= "AND keywords LIKE '%$search_each%' "; 
			} 
	}
	
	$construct = " SELECT * FROM products WHERE $construct "; 
	$run = mysqli_query($con, $construct );
	$foundnum = mysqli_num_rows($run);
	
	 if ($foundnum == 0)
		 echo "Sorry, there are no matching result for <b> $search </b>.
		</ br >
		</ br > 1. Try more general words. for example: If you want to search 'how to create a website' then use general keyword like 'create' 'website' </ br > 
		2. Try different words with similar meaning
		</ br > 3. Please check your spelling";
		 else {
			 echo "$foundnum results found !<p>";
			 while ( $runrows = mysql_fetch_assoc($run) ) {
				  $title = $runrows ['title'];
				  $desc = $runrows ['description'];
				  $url = $runrows ['url'];
				   echo "<a href='$url'> <b> $title </b> </a> <br> $desc <br> <a href='$url'> $url </a> <p>";
			 }
		 }

		
		
		 if( strlen( $search ) <= 1 )
			 echo "Search term too short";
		 else {
			echo "You searched for <b> $search </b> <hr size='1' > </ br > "; mysql_connect( "localhost","USERNAME","PASSWORD") ; 
			mysql_connect( "localhost","USERNAME","PASSWORD") ; 
            mysql_select_db("DBNAME");
			
			$search_exploded = explode ( " ", $search ); 
			$x = 0; 
			
			foreach( $search_exploded as $search_each ) {
				$x++; 
				$construct = ""; 
				if( $x == 1 )
					$construct .="keywords LIKE '%$search_each%'";
				else
                    $construct .="AND keywords LIKE '%$search_each%'";
			}
			
			$construct = " SELECT * FROM SEARCH_ENGINE WHERE $construct ";
			$run = mysql_query( $construct );
			
			 $foundnum = mysql_num_rows($run);
			 
			 if ($foundnum == 0)
				 echo "Sorry, there are no matching result for <b> $search </b>. </br> </br> 1. Try more general words. for example: If you want to search 'how to create a website' then use general keyword like 'create' 'website' </br> 2. Try different words with similar meaning </br> 3. Please check your spelling"; 
			 else {
				  echo "$foundnum results found !<p>";
				  
				  while( $runrows = mysql_fetch_assoc( $run ) ) {
					$title = $runrows ['title'];
					 $desc = $runrows ['description'];
					 $url = $runrows ['url'];
					echo "<a href='$url'> <b> $title </b> </a> <br> $desc <br> <a href='$url'> $url </a> <p>";
				  }
			 }
		 }
 }

//disconnect
	mysql_close();
 

		
			  
		*/	  
			  
			  
	mysql_close();		  
            ?>


        </div>
    </div>

    <div class="col-md-12" id="footer">

    </div>

          <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
