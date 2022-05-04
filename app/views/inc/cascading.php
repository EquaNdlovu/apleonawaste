<!-- Scripts for Dropdowns -->
<script>
   
  function getCustomerGroup(val) {
  
  
      
      alert("Selected Value is     " + val);
      
      $.ajax({
        url: 'http://localhost/get_group.php',
        data:'selected_customer='+val,
        type: 'GET',
        success: function(data){
          $('#collections_customer_group').prop('disabled', false);
          $('#collections_customer_group').hide();
        }
      });
    }
      
   

</script>


