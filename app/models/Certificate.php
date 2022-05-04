<?php
  class Certificate {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getcertificates(){
      $this->db->query('SELECT *
                        FROM collector_certificates
                        ORDER BY collector_certificates_key DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addcertificate($data){
      //$conn = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
      if(isset($_POST['submit'])){
          $fileName = $_FILES['file']['name'];
          $fileTmpName = $_FILES['file']['tmp_name'];
          $path = APPROOT . '/views/certificates/files/'.$fileName;
          //$path = "c:/wamp64/tmp/".$fileName;
          move_uploaded_file($fileTmpName,$path);
          $collectorKey = $_POST['collector_certificates_collector_key'];
          $permitType = $_POST['collector_certificates_type'];
          $permitNo = $_POST['collector_certificates_permit_no'];
          $permitExpiry = $_POST['collector_certificates_date'];

          //$query = "INSERT INTO collector_certificates(collector_certificates_file) VALUES ('$fileName')";
          $this->db->query("INSERT INTO collector_certificates 
          (collector_certificates_collector_key, collector_certificates_type, collector_certificates_permit_no, collector_certificates_date, collector_certificates_file) 
          VALUES('$collectorKey', '$permitType', '$permitNo', '$permitExpiry', '$fileName')");
          $this->db->bind('$collectorKey', $data['collector_certificates_collector_key']);
          $this->db->bind('$permitType', $data['collector_certificates_type']);
          $this->db->bind('$permitNo', $data['collector_certificates_permit_no']);
          $this->db->bind('$permitExpiry', $data['collector_certificates_date']);
          $this->db->bind('$filename', $data['collector_certificates_file']);
          // $run = mysqli_query($conn,$query);
          
          // if($run){
          //     move_uploaded_file($fileTmpName,$path);
          //     echo "success";
          // }
          // else{
          //     echo "error".mysqli_error($conn);
          // }
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
          
      }
    }


    public function updatecertificate($data){
      if(isset($_POST['submit'])){
  
      if (empty($_FILES['file']['name'])){
  
        $certificateKey = $data['collector_certificates_key'];
        $collectorKey = $_POST['collector_certificates_collector_key'];
        $permitType = $_POST['collector_certificates_type'];
        $permitNo = $_POST['collector_certificates_permit_no'];
        $permitExpiry = $_POST['collector_certificates_date'];
        $permitFile = $data['collector_certificates_file'];
  
        $this->db->query("UPDATE collector_certificates SET 
                          collector_certificates_collector_key = '$collectorKey', collector_certificates_type = '$permitType', 
                          collector_certificates_permit_no = '$permitNo', collector_certificates_date = '$permitExpiry', collector_certificates_file = '$permitFile' 
                          WHERE collector_certificates_key = '$certificateKey'");
        // Bind values
        $this->db->bind('$certificateKey', $data['collector_certificates_key']);
        $this->db->bind('$collectorKey', $data['collector_certificates_collector_key']);
        $this->db->bind('$permitType', $data['collector_certificates_type']);
        $this->db->bind('$permitNo', $data['collector_certificates_permit_no']);
        $this->db->bind('$permitExpiry', $data['collector_certificates_date']);
        $this->db->bind('$permitFile', $data['collector_certificates_file']);
  
      } else {
  
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $path = APPROOT . '/views/certificates/files/'.$fileName;
        $certificateKey = $data['collector_certificates_key'];
        $collectorKey = $_POST['collector_certificates_collector_key'];
        $permitType = $_POST['collector_certificates_type'];
        $permitNo = $_POST['collector_certificates_permit_no'];
        $permitExpiry = $_POST['collector_certificates_date'];
        move_uploaded_file($fileTmpName,$path);
        
        $this->db->query("UPDATE collector_certificates SET 
        collector_certificates_collector_key = '$collectorKey', collector_certificates_type = '$permitType', collector_certificates_permit_no = '$permitNo', 
        collector_certificates_date = '$permitExpiry', collector_certificates_file = '$fileName' 
        WHERE collector_certificates_key = '$certificateKey'");
        // Bind values
        $this->db->bind('$certificateKey', $data['collector_certificates_key']);
        $this->db->bind('$collectorKey', $data['collector_certificates_collector_key']);
        $this->db->bind('$permitType', $data['collector_certificates_type']);
        $this->db->bind('$permitNo', $data['collector_certificates_permit_no']);
        $this->db->bind('$permitExpiry', $data['collector_certificates_date']);
        $this->db->bind('$fileName', $data['collector_certificates_file']);
      }
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }
    }

    public function downloadcertificate(){
      if(!empty($_GET['file'])){
        $fileName  = basename($_GET['file']);
        $filePath = APPROOT . '/views/certificates/files/'.$fileName;
        
        if(!empty($fileName) && file_exists($filePath)){
            //define header
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
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

  public function deleteCertificateFile()
  {
    if (!empty($_GET['file'])) {
    $filename  = basename($_GET['file']);
    $PermitKey = $_GET['key'];
     $filePath = APPROOT . '/views/certificates/files/' . $filename;
      unlink($filePath);
    $this->db->query("UPDATE collector_certificates SET collector_certificates_file = '' WHERE collector_certificates_key = '".$PermitKey."'");
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }

    public function getcertificateById($collector_certificates_key){
      $this->db->query('SELECT * FROM collector_certificates WHERE collector_certificates_key = :collector_certificates_key');
      $this->db->bind(':collector_certificates_key', $collector_certificates_key);

      $row = $this->db->single();

      return $row;
    }

    public function deletecertificate($collector_certificates_key){
      $this->db->query('DELETE FROM collector_certificates WHERE collector_certificates_key = :collector_certificates_key');
      // Bind values
      $this->db->bind(':collector_certificates_key', $collector_certificates_key);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }