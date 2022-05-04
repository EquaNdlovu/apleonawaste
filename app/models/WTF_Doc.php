<?php
  class WTF_Doc {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getWTF(){
      $this->db->query('SELECT *
                        FROM wtf_docs
                        ORDER BY wtf_key DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addFile($data, $arr, $i, $var){

      if($var == 'add') {
      // This section is for adding a new collection e.g. no key defined yet
      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      $sql = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'apleona_waste' AND   TABLE_NAME   = 'wtf_docs';";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);

      $this->db->query('INSERT INTO wtf_files (wtf_files_docs_key, file_name) VALUES(:wtf_files_docs_key, :file_name)');
      // Bind values
      $this->db->bind(':wtf_files_docs_key', current($row));
      $this->db->bind(':file_name', $arr[$i]);

      } else {
        // This is for updating an existing collection e.g. key is already defined
        $this->db->query('INSERT INTO wtf_files (wtf_files_docs_key, file_name) VALUES(:wtf_files_docs_key, :file_name)');
        // Bind values
        $this->db->bind(':wtf_files_docs_key', $data['wtf_key']);
        $this->db->bind(':file_name', $arr[$i]);

      }


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function addWTF($data){
      if (isset($_POST['submit'])) {
  
        $countfiles = count($_FILES['file']['name']);
        $values = "";
        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {
          $filename = $_FILES['file']['name'][$i];
          $values != "" && $values .= ",";
          $values .= $filename;
          // Upload file
          move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/WTF_Docs/files/' . $filename);
        }
        // $WTFClient = $_POST['wtf_client'];
        // $WTFSite = $_POST['wtf_site'];
        // $WTFDate = $_POST['wtf_date'];
        // $WTFNumber = $_POST['wtf_number'];
        // $WTFOwner = $_POST['wtf_owner'];
        // $WTFCountry = $_POST['wtf_country'];
  
        $this->db->query("INSERT INTO wtf_docs
          (wtf_client, wtf_site, wtf_date, wtf_documentation, wtf_number, wtf_owner, wtf_country, wtf_customer) 
          VALUES (:wtf_client, :wtf_site, :wtf_date, :wtf_documentation, :wtf_number, :wtf_owner, :wtf_country, :wtf_customer)");
        $this->db->bind(':wtf_client', $data['wtf_client']);
        $this->db->bind(':wtf_site', $data['wtf_site']);
        $this->db->bind(':wtf_date', $data['wtf_date']);
        $this->db->bind(':wtf_documentation', $data['wtf_documentation']);
        $this->db->bind(':wtf_number', $data['wtf_number']);
        $this->db->bind(':wtf_owner', $data['wtf_owner']);
        $this->db->bind(':wtf_country', $data['wtf_country']);
        $this->db->bind(':wtf_customer', $data['wtf_customer']);
      }
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

    public function updateWTF($data){
      if(isset($_POST['submit'])){
      // Count total files

      if (empty($_FILES['file']['name'][0])){

        $WTFKey = $_POST['wtf_key'];
        $WTFClient = $_POST['wtf_client'];
        $WTFSite = $_POST['wtf_site'];
        $WTFDate = $_POST['wtf_date'];
        $WTFDocumentation = $data['wtf_documentation'];
        $WTFNumber = $_POST['wtf_number'];

        $this->db->query("UPDATE wtf_docs SET
        wtf_client = '$WTFClient', wtf_site = '$WTFSite', wtf_date = '$WTFDate', wtf_documentation = ':wtf_documentation', wtf_number = '$WTFNumber'
        WHERE wtf_key = '$WTFKey'");
        $this->db->bind('$WTFKey', $data['wtf_key']);
        $this->db->bind('$WTFClient', $data['wtf_client']);
        $this->db->bind('$WTFSite', $data['wtf_site']);
        $this->db->bind('$WTFDate', $data['wtf_date']);
        $this->db->bind(':wtf_documentation', $data['wtf_documentation']);
        $this->db->bind('$WTFNumber', $data['wtf_number']);

      } else {

          $countfiles = count($_FILES['file']['name']);
          $values = "";
          // Looping all files
          for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];
            $values != "" && $values .= ",";
            $values .= $filename;
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i], APPROOT . '/views/WTF_Docs/files/'.$filename);
          } 
            //$fileName = $_FILES['file']['name'];
            //$filename = $_FILES['file']['name'][$i];
            //$fileTmpName = $_FILES['file']['tmp_name'];
            //$path = APPROOT . '/views/wtf_docs/files/'.$fileName;
            //move_uploaded_file($fileTmpName,$path);
            $WTFKey = $_POST['wtf_key'];
            $WTFClient = $_POST['wtf_client'];
            $WTFSite = $_POST['wtf_site'];
            $WTFDate = $_POST['wtf_date'];
            $WTFNumber = $_POST['wtf_number'];
    
            $this->db->query("UPDATE wtf_docs SET
            wtf_client = '$WTFClient', wtf_site = '$WTFSite', wtf_date = '$WTFDate', wtf_documentation = '$values', wtf_number = '$WTFNumber' 
            WHERE wtf_key = '$WTFKey'");
            $this->db->bind('$WTFKey', $data['wtf_key']);
            $this->db->bind('$WTFClient', $data['wtf_client']);
            $this->db->bind('$WTFSite', $data['wtf_site']);
            $this->db->bind('$WTFDate', $data['wtf_date']);
            $this->db->bind('$values', $data['wtf_documentation']);
            $this->db->bind('$WTFNumber', $data['wtf_number']);

      }

        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
        
    }
  }

  public function downloadWTF(){
    if(!empty($_GET['file'])){
      $filename  = basename($_GET['file']);
      $filePath = APPROOT . '/views/wtf_docs/files/'.$filename;
      
      if(!empty($filename) && file_exists($filePath)){
          //define header
          header("Cache-Control: public");
          header("Content-Description: File Transfer");
          header("Content-Disposition: attachment; filename=$filename");
          header("Content-Type: application/zip");
          header("Content-Transfer-Encoding: binary");

          ob_clean();
          flush();
          
          //read file 
          readfile($filePath);
          exit;
      }
      else{
          echo "file not exit";
      }
  }
}

  public function deleteWTF()
  {
    if (!empty($_GET['file'])) {
    $filename  = basename($_GET['file']);
    $WTFKey = $_GET['key'];
    $str_arr = explode (",", $filename);
    foreach ($str_arr as $value) {
     $filePath = APPROOT . '/views/wtf_docs/files/' . $value;
      unlink($filePath);
    }
    $this->db->query("UPDATE wtf_docs SET wtf_documentation = '' WHERE wtf_key = '".$WTFKey."'");
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }

    public function getWTFById($wtf_key){
      $this->db->query('SELECT * FROM wtf_docs WHERE wtf_key = :wtf_key');
      $this->db->bind(':wtf_key', $wtf_key);

      $row = $this->db->single();

      return $row;
    }

    public function deletecollector($waste_collector_key){
      $this->db->query('DELETE FROM waste_collector WHERE waste_collector_key = :waste_collector_key');
      // Bind values
      $this->db->bind(':waste_collector_key', $waste_collector_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }