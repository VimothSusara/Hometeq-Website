<?php

session_start();

include ("db.php");

$pagename="Smart Basket"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

    include ("headfile.html"); //include header layout file

    echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
	
	if (isset($_POST['del_prodid'])){
		
		$delprodid=$_POST['del_prodid'];
		
		unset ($_SESSION['basket'][$delprodid]);
		
		echo "<p>1 item removed";
		
	}

    if(isset($_POST['h_prodid'])){

	    $newprodid = $_POST['h_prodid'];

		$reququantity = $_POST['p_quantity'];

		//echo "<p>Selected product id:".$newprodid;

		//echo "<p>Quantity of selected product:".$reququantity;

		$_SESSION['basket'][$newprodid]=$reququantity;

		echo "<p>1 item added";

    }
    else{

        echo "<p>Basket unchanged.";

    }

    $total = 0;

    echo "<table id='baskettable'>";

        echo "<tr>";

            echo "<th>Product Name</th>";

            echo "<th>Price</th>";

            echo "<th>Quantity</th>";

            echo "<th>Subtotal</th>";
			
			echo "<th>Remove</th>";

        echo "</tr>";

        if (isset($_SESSION['basket'])){
               
            foreach($_SESSION['basket'] as $index => $value){
                    
                $SQL = "select prodId, prodName, prodPrice, prodQuantity from Product where prodId =" .$index;
                    
                $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

                $arrayp = mysqli_fetch_array($exeSQL);
                    
                echo "<tr>";
                    
                    echo "<td>".$arrayp['prodName']."</td>";
					
					echo "<td>&pound".number_format($arrayp['prodPrice'],2)."</td>";
					
					echo "<td style='text-align:center;'>".$value."</td>";

				    $subtotal = $arrayp['prodPrice'] * $value;
					
					echo "<td>&pound".number_format($subtotal,2)."</td>";
					
					echo "<form action=basket.php method=post>";
					
						echo "<td>";
						
							echo "<input type=submit value='Remove' id='submitbtn'>";
						
						echo "</td>";
					
						echo "<input type=hidden name=del_prodid value=".$arrayp['prodId'].">";
						
					echo "</form>";
                    
                echo "</tr>";
				
				$total = $total + $subtotal;
                    
            }
               
        }
		else{
			
			echo "<p>Empty basket";
			
		}
		
		echo "<tr>";
		
		echo "<td colspan=3>Total</td>";
		
		echo "<td>&pound".number_format($total,2)."</td>";
		
		echo "</tr>";

    echo "</table>";
	
	echo "<br><p><a href='clearbasket.php'>CLEAR BASKET</a></p>";
	
	echo "<br><p>New homteq customers: <a href='signup.php'>Sign up</a></p>";
	
	echo "<p>Returning homteq customers: <a href='login.php'>Login</a></p>";

    include("footfile.html"); //include head layout

echo "</body>";

?>