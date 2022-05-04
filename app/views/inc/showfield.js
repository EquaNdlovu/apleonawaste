<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    alert("Welcome!");
    $.viewMap = {
      '0' : $('#Customer_Waste_Producer')
    };
  
    $('#collections_customer_number').change(function() {
      // hide all
      $.each($.viewMap, function() { this.hide(); });
      // show current
      $.viewMap[$(this).val()].show();
    });
  });
</script>