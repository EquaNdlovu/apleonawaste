<?php


if(!empty ($_POST["selected_customer"])) {

        $selected_customer = $_POST["selected_customer"];
        $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
	     	$sql = "SELECT * FROM wm_site WHERE waste_site_customer = '$selected_customer'";
	     	echo "<option value=0>Please Select</option>";
		    $result = mysqli_query($db, $sql);
              while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" .$row['waste_site_name']."'> ".$row['waste_site_name'] . "</option>"; 
                    }
            //  echo "</select>";

}

		
?>
