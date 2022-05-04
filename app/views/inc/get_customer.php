<?php


if(!empty ($_POST["selected_country"])) {

        $selected_country = $_POST["selected_country"];
        $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
	     	$sql = "SELECT * FROM wm_customer WHERE waste_customer_country = '$selected_country'";
		    $result = mysqli_query($db, $sql);
		    echo "<option value=0>Please Select</option>";
              while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" .$row['waste_customer_name']."'> ".$row['waste_customer_name'] . "</option>"; 
                    }
            //  echo "</select>";

}

		
?>
