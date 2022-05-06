<script type="text/javascript">

var ROOTWASTE = "<?php echo URLROOTWASTE; ?>";

function chPy()
{
    var cost1 = document.getElementById("Treatment_Cost").value;
    var cost2 = document.getElementById("Packaging_Cost").value;
    var cost3 = document.getElementById("Transport_Cost").value;
    var cost4 = document.getElementById("Other_Cost").value;
    var num1 = parseFloat(cost1) || 0;
    var num2 = parseFloat(cost2) || 0;
    var num3 = parseFloat(cost3) || 0;
    var num4 = parseFloat(cost4) || 0;
    var total = parseFloat(num1) + parseFloat(num2) +parseFloat(num3) + parseFloat(num4);
    var total_rounded = parseFloat(total).toFixed(2);
    var num1_rounded = parseFloat(num1).toFixed(2);
    var num2_rounded = parseFloat(num2).toFixed(2);
    var num3_rounded = parseFloat(num3).toFixed(2);
    var num4_rounded = parseFloat(num4).toFixed(2);
    document.forms['stepperForm'].Treatment_Cost.value = num1_rounded;
    document.forms['stepperForm'].Packaging_Cost.value = num2_rounded;
    document.forms['stepperForm'].Transport_Cost.value = num3_rounded;
    document.forms['stepperForm'].Other_Cost.value = num4_rounded;
    document.forms['stepperForm'].Total_Cost.value = total_rounded;
}

function makeFreeText()
{
    var str = document.getElementById("collections_customer_number").value;
    var str_country = document.getElementById("collections_customer_country").value;
    var mdivone =  document.getElementById("IE_MD");
    var mdivtwo =  document.getElementById("Stryker_MD");
    var mdivthree =  document.getElementById("IE_MAD");
    var mdivfour =  document.getElementById("Stryker_MAD");
    var mdivfive =  document.getElementById("IE_MC");
    var mdivsix =  document.getElementById("Stryker_MC");
    var mdivseven =  document.getElementById("IE_TMD");
    var mdiveight =  document.getElementById("Stryker_TMD");
    var html4 = '<div class="form-group" id="Stryker_TMD_Content"><label class="control-label" for="Treatment_Method_Detail">Treatment Method Detail</label><input type="text" id="Treatment_Method_Detail" class="form-control" name="Treatment_Method_Detail" value="<?php echo $data['Treatment_Method_Detail'] ?>" data-parsley-group="fieldset04"></div>';
    var html3 = '<div class="form-group" id="Stryker_MC_Content"><label class="control-label" for="Material_Class">Class</label><input type="text" id="Material_Class" class="form-control" name="Material_Class" value="<?php echo $data['Material_Class'] ?>" data-parsley-group="fieldset02"></div>';
    var html2 = '<div class="form-group" id="Stryker_MD_Content"><label class="control-label" for="Material_Description">Material Description</label><input type="text" id="Material_Description" class="form-control" name="Material_Description" value="<?php echo $data['Material_Description'] ?>" data-parsley-group="fieldset02"></div>';
    var html = '<div class="form-group" id="Stryker_MAD_Content"><label class="control-label" for="Material_Detail">Material Analysis Detail</label><input type="text" id="Material_Detail" class="form-control" name="Material_Detail" value="<?php echo $data['Material_Detail'] ?>" data-parsley-group="fieldset02"></div>';
    if (str.includes("Stryker")) {
      $("#Stryker_TMD_Content").remove();
      $("#Stryker_MAD_Content").remove();
      $("#Stryker_MD_Content").remove();
      $("#Stryker_MC_Content").remove();
      $("#Stryker_MAD").append(html);
      $("#Stryker_MD").append(html2);
      $("#Stryker_MC").append(html3);
      $("#Stryker_TMD").append(html4);
      mdivone.style.display = "none";
      mdivtwo.style.display = "block";
      mdivthree.style.display = "none";
      mdivfour.style.display = "block";
      mdivfive.style.display = "none";
      mdivsix.style.display = "block";
      mdivseven.style.display = "none";
      mdiveight.style.display = "block";
    } else {
      $("#Stryker_TMD_Content").remove();
      $("#Stryker_MAD_Content").remove();
      $("#Stryker_MD_Content").remove();
      $("#Stryker_MC_Content").remove();
      mdivone.style.display = "block";
      mdivtwo.style.display = "none";
      mdivthree.style.display = "block";
      mdivfour.style.display = "none";
      mdivfive.style.display = "block";
      mdivsix.style.display = "none";
      mdivseven.style.display = "block";
      mdiveight.style.display = "none";
    }

}

function showHazardousFieldsEWC()
{
    var mdivone =  document.getElementById("Material_UN_Code_div");
    var mdivtwo =  document.getElementById("Material_Packaging_div");
    var check = document.getElementById("ewc_parent").value;
    if (check.includes("*")) {
       mdivone.style.display = "block";
       mdivtwo.style.display = "block";
    } else {
      mdivone.style.display = "none";
      mdivtwo.style.display = "none";
    }
}

function showHazardousCheckboxFields()
{
    var mdivone =  document.getElementById("Material_UN_Code_div");
    var mdivtwo =  document.getElementById("Material_Packaging_div");
    var mdivthree =  document.getElementById("Material_Class_div");
    var checkbox = document.getElementById("hazardous_checkbox").value;
    if (document.getElementById("hazardous_checkbox").checked) {
       mdivone.style.display = "block";
       mdivtwo.style.display = "block";
       mdivthree.style.display = "block";
    } else
    {
      mdivone.style.display = "none";
      mdivtwo.style.display = "none";
      mdivthree.style.display = "none";
    }
}

function showHazardousWasteFields()
{
    var mdivone =  document.getElementById("Material_UN_Code_div");
    var mdivtwo =  document.getElementById("Material_Packaging_div");
    var check = document.getElementById("Material_Class").value;
    if (check.includes("Haz")) {
      if (check.includes("Non")) {
        mdivone.style.display = "none";
        mdivtwo.style.display = "none";
      } else {
       mdivone.style.display = "block";
       mdivtwo.style.display = "block";
      }
    } else
    {
      mdivone.style.display = "none";
      mdivtwo.style.display = "none";
    }
}

function showCharityDonated()
{
    var mdivone =  document.getElementById("Charity_Donated_div");
    var rdcode = document.getElementById("RD_Codes_Treatment").value;
    if (rdcode.includes("C1")) {
       mdivone.style.display = "block";
    } else
    {
      mdivone.style.display = "none";
    }
}

function showCharityDonatedWorkspace()
{
    var mdivone =  document.getElementById("Charity_Donated_div");
    var tmd = document.getElementById("Treatment_Method_Detail").value;
    if (tmd.includes("Charity")) {
       mdivone.style.display = "block";
    } else {
      mdivone.style.display = "none";
    }
}

function getCustomerSiteonload() {
                var val = document.getElementById("collections_customer_number").value;
                var site = document.getElementById("collections_customer_site").value;
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_site_onload.php",
                      url: ROOTWASTE + "/get_site_onload.php",
                      data: 'selected_customer=' + encodeURIComponent(val) + '&selected_site=' + encodeURIComponent(site),
                      success: function(data){
                        $( '#collections_customer_site' ).html(data);
                        $("#collections_customer_site").selectpicker("refresh");
                      //  alert("Data was succesfully captured" +data);
                       }
                    });
                  } 

function getCustomerSiteonloadWorkSpace() {
                var val = document.getElementById("Customer_Waste_Producer").value;
                var site = document.getElementById("collections_customer_site").value;
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_site_onload_workspace.php",
                      url: ROOTWASTE + "/get_site_onload_workspace.php",
                      data: 'selected_customer=' + encodeURIComponent(val) + '&selected_site=' + encodeURIComponent(site),
                      success: function(data){
                        $( '#collections_customer_site' ).html(data);
                        $("#collections_customer_site").selectpicker("refresh");
                      //  alert("Data was succesfully captured" +data);
                       }
                    });
                  } 

function getProduceronloadWorkSpace() {
                var val = document.getElementById("collections_customer_number").value;
                var producer = document.getElementById("Customer_Waste_Producer").value;
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_producer_onload.php",
                      url: ROOTWASTE + "/get_producer_onload.php",
                      data: 'selected_customer=' + encodeURIComponent(val) + '&selected_producer=' + encodeURIComponent(producer),
                      success: function(data){
                        $( '#Customer_Waste_Producer' ).html(data);
                        $("#Customer_Waste_Producer").selectpicker("refresh");
                      //  alert("Data was succesfully captured" +data);
                       }
                    });
                  } 

window.onload = function() {
  var country = document.getElementById("collections_customer_country").value;
  if (country == "Workspace") {
    showCharityDonatedWorkspace();
    getCustomerSiteonloadWorkSpace();
    getProduceronloadWorkSpace();
  } else {
    showHazardousWasteFields();
    makeFreeText();
    showCharityDonated();
    getCustomerSiteonload();
  }
};
</script>