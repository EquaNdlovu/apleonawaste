
<script>

var barGraph1;
var barGraph2;
var barGraph3;
var barGraph4;
var barGraph5;
var barGraph6
var charityGraph1;
var charityGraph2;
var charityGraph3;

var ROOTWASTE = "<?php echo URLROOTWASTE; ?>";

function getCustomer(val) {
                   $.ajax({
                        type: "POST",
                        async: false,
                        //url: "https://www.apleona.ie/wastefiles_test/get_customer.php",
                        url: ROOTWASTE + "/get_customer.php",
                        data: 'selected_country=' + encodeURIComponent(val),
                        success: function(data){
                          $( '#collections_customer_number' ).html(data);
                        //alert("in getCustomer  was succesfully captured" +data);
                         }
                      });
                    } 

 function getCustomerforSite(val) {
                   $.ajax({
                        type: "POST",
                        async: false,
                        //url: "https://www.apleona.ie/wastefiles_test/get_customer.php",
                        url: ROOTWASTE + "/get_customer.php",
                        data: 'selected_country=' + encodeURIComponent(val),
                        success: function(data){
                          $( '#waste_site_customer' ).html(data);
                        //alert("in getCustomer  was succesfully captured" +data);
                         }
                      });
                    }  



   function getCustomerSite(val) {
                //var element = document.getElementById("collections_customer_site");
                //element.classList.add("selectpicker");
                //element.setAttribute("class", "selectpicker");
                if (val == '') {
                  val = document.getElementById("collections_customer_number").value;
                }
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_site.php",
                      url: ROOTWASTE + "/get_site.php",
                      data: 'selected_customer=' + encodeURIComponent(val),
                      success: function(data){
                        $( '#collections_customer_site' ).html(data);
                        $("#collections_customer_site").selectpicker("refresh");
                      //  alert("Data was succesfully captured" +data);
                       }
                    });
                  }  


   function getWasteProducer(val) {
                var customer = document.getElementById("collections_customer_number").value;
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_waste_producer.php",
                      url: ROOTWASTE + "/get_waste_producer.php",
                      data: 'selected_site=' + encodeURIComponent(val) + '&selected_customer=' + encodeURIComponent(customer),
                      success: function(data){
                        $( '#Customer_Waste_Producer' ).html(data);
                        $("#Customer_Waste_Producer").selectpicker("refresh");
                       // alert("Data was succesfully captured" +data);
                       }
                    });
                  } 

function getWasteProducerWorkspace(val) {
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_waste_producer_workspace.php",
                      url: ROOTWASTE + "/get_waste_producer_workspace.php",
                      data: 'selected_customer=' + encodeURIComponent(val),
                      success: function(data){
                        $( '#Customer_Waste_Producer' ).html(data);
                        $("#Customer_Waste_Producer").selectpicker("refresh");
                       // alert("Data was succesfully captured" +data);
                       }
                    });
                  }  


       function getCustomerAddress(val) {
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_address.php",
                      url: ROOTWASTE + "/get_address.php",
                      data: 'selected_site=' + encodeURIComponent(val),
                      success: function(data){
                        $( '#collections_address' ).html(data);
                        $('#collections_address').selectpicker("refresh");
                       //alert("Data was succesfully captured" +data);
                       }
                    });
                  }  

function getCustomerGroup(val) {
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_customer_group.php",
                      url: ROOTWASTE + "/get_customer_group.php",
                      data: 'selected_customer=' + encodeURIComponent(val),
                      success: function(data){
                        $( '#collections_customer_group' ).html(data);
                       //alert("Data was succesfully captured" +data);
                       }
                    });
                  } 

     function getOverallCustomer(val) {
                $.ajax({
                      type: "POST",
                      async: false,
                      //url: "https://www.apleona.ie/wastefiles_test/get_overall_customer.php",
                      url: ROOTWASTE + "/get_overall_customer.php",
                      data: 'selected_site=' + encodeURIComponent(val),
                      success: function(data){
                        $( '#collections_customer' ).html(data);
                       //alert("Data was succesfully captured" +data);
                       }
                    });
                  }  

function setEWCWorkspace(val)
{
    if (val.includes("Metal")) {
      $("#ewc_parent").selectpicker('val', "20 01 40")
      getChildEWC("20 01 40");
    } else if (val.includes("Mixed General Waste")) {
        $("#ewc_parent").selectpicker('val', "20 03 01")
        getChildEWC("20 03 01");
    } else if (val.includes("Wood")) {
        $("#ewc_parent").selectpicker('val', "17 02 01")
        getChildEWC("17 02 01");
    } else {
      $("#ewc_parent").selectpicker('val', "")
      getChildEWC("");

    }
}

                  
function getChildEWC(val) {
                   $.ajax({
                        type: "POST",
                        async: false,
                        //url: "https://www.apleona.ie/wastefiles_test/get_child_ewc.php",
                        url: ROOTWASTE + "/get_child_ewc.php",
                        data: 'selected_ewc=' + encodeURIComponent(val),
                        success: function(data){
                          $( '#ewc_sub' ).html(data);
                        //alert("in getCustomer  was succesfully captured" +data);
                         }
                      });
                    }  

function getSubEWC(val) {
                   $.ajax({
                        type: "POST",
                        async: false,
                        //url: "https://www.apleona.ie/wastefiles_test/get_sub_ewc.php",
                        url: ROOTWASTE + "/get_sub_ewc.php",
                        data: 'selected_child=' + encodeURIComponent(val),
                        success: function(data){
                          $( '#ewc_child' ).html(data);
                        //alert("in getCustomer  was succesfully captured" +data);
                         }
                      });
                    } 



/* ----------------  Graph Stuff Starts Here  --------------- */


    function showGraph(site, customer, fullStartDate, fullEndDate)
        {

            {

                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (barGraph1) {
                    barGraph1.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = fullStartDate;
                var endDate = fullEndDate;
                //alert ("customer is" + customer +  "   site is"  +  site +  "  start is   " + start + "    end is   " + end);
                //$.post("https://www.apleona.ie/wastefiles_test/top_quantities_new.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                $.post(ROOTWASTE + "/top_quantities_new.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                function (data)
                {
                    console.log(data);
                     var material = [];
                    var amount = [];

                    for (var i in data) {
                        material.push(data[i].Material_Description);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: material,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };


                    var graphTarget = $("#graphCanvas");

                    barGraph1 = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    },
                                    afterDataLimits(scale) {
                                        scale.max += (scale.max*0.10);
                                      }
                                }],
                            },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                //render: 'value',
                                render: function (args) {
                                    return numeral(args.value).format('0,0');
                                },
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#000000',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,

                              }
                            }
                        }
                    });
                });
            }
        }
/* ----------------------------- */

  function showGraph1(site, customer, start, end)
        {
            {

                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (barGraph2) {
                    barGraph2.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = start;
                var endDate = end;
                
                //$.post("https://www.apleona.ie/wastefiles_test/top_types_new.php?mySite=" + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                $.post(ROOTWASTE + "/top_types_new.php?mySite=" + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                 function (data)
                {
                    console.log(data);
                    var material = [];
                    var amount = [];

                    for (var i in data) {
                        material.push(data[i].Material_Description);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: material,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#ffffff',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas1");

                    barGraph2 = new Chart(graphTarget, {
                        type: 'doughnut',
                        data: chartdata,
                        options: {
                            // title: {
                            //     display: true,
                            //     text: 'just a code snippet ...'
                            //   },
                              legend: {
                                display: true,
                                position: 'bottom',
                                // labels: {
                                //   /* here one can adjust the legend's labels, if required */
                                //   //generateLabels: function(chart) {}
                                // }
                              },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                render: 'percentage',
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#fff',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,

                                // draw label even it's overlap, default is true
                                // bar chart ignores this
                                overlap: true,

                                // position to draw label, available value is 'default', 'border' and 'outside'
                                // bar chart ignores this
                                // default is 'default'
                                position: 'default',

                                // add padding when position is `outside`
                                // default is 2
                                //outsidePadding: 4,

                                // add margin of text when position is `outside` or `border`
                                // default is 2
                                textMargin: 2,
                              }
                            }
                        }
                        
                    });
                });
            }
        }

/* ---------------------------------- */

  function showGraph2(site, customer, start, end)
        {
            {

                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (barGraph3) {
                    barGraph3.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = start;
                var endDate = end;
                //$.post("https://www.apleona.ie/wastefiles_test/top_by_waste_producer_new.php?mySite=" + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                $.post(ROOTWASTE + "/top_by_waste_producer_new.php?mySite=" + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                 function (data)
                {
                    console.log(data);
                     var producer = [];
                    var amount = [];

                    for (var i in data) {
                        producer.push(data[i].Customer_Waste_Producer);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: producer,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#ffffff',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas2");

                    barGraph3 = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    afterDataLimits(scale) {
                                        scale.max += (scale.max*0.10);
                                      }
                                }]
                            },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                //render: 'value',
                                render: function (args) {
                                    return numeral(args.value).format('0,0');
                                },
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#000000',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,

                              }
                            }
                        }
                    });
                });
            }
        }


/* ---------------------------------- */


function showGraph3(site, customer, fullStartDate, fullEndDate)
        {

            {

                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (barGraph4) {
                    barGraph4.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = fullStartDate;
                var endDate = fullEndDate;
                //alert ("customer is" + customer +  "   site is"  +  site +  "  start is   " + start + "    end is   " + end);
                //$.post("https://www.apleona.ie/wastefiles_test/top_quantities_cost.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                $.post(ROOTWASTE + "/top_quantities_cost.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                function (data)
                {
                    console.log(data);
                    var material = [];
                    var amount = [];

                    for (var i in data) {
                        material.push(data[i].Material_Description);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: material,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };


                    var graphTarget = $("#graphCanvas3");

                    barGraph4 = new Chart(graphTarget, {
                        type: 'doughnut',
                        data: chartdata,
                        options: {
                            // title: {
                            //     display: true,
                            //     text: 'just a code snippet ...'
                            //   },
                            legend: {
                                display: true,
                                position: 'bottom',
                                maxWidth: 10,
                                // labels: {
                                //   /* here one can adjust the legend's labels, if required */
                                //   //generateLabels: function(chart) {}
                                // }
                              },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                render: 'percentage',
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#fff',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,

                                // draw label even it's overlap, default is true
                                // bar chart ignores this
                                overlap: true,

                                // position to draw label, available value is 'default', 'border' and 'outside'
                                // bar chart ignores this
                                // default is 'default'
                                position: 'default',

                                // add padding when position is `outside`
                                // default is 2
                                //outsidePadding: 4,

                                // add margin of text when position is `outside` or `border`
                                // default is 2
                                textMargin: 2,
                              }
                            }
                        }
                    });
                });
            }
        }
/* ----------------------------- */

function showGraph4(site, customer, fullStartDate, fullEndDate)
        {

            {

                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (barGraph5) {
                    barGraph5.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = fullStartDate;
                var endDate = fullEndDate;
                //alert ("customer is" + customer +  "   site is"  +  site +  "  start is   " + start + "    end is   " + end);
                //$.post("https://www.apleona.ie/wastefiles_test/waste_removed.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                $.post(ROOTWASTE + "/waste_removed.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                function (data)
                {
                    console.log(data);
                     var material = [];
                    var amount = [];

                    for (var i in data) {
                        material.push(data[i].Treatment_Method_Detail);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: material,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };


                    var graphTarget = $("#graphCanvas4");

                    barGraph5 = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    afterDataLimits(scale) {
                                        scale.max += (scale.max*0.10);
                                      }
                                }]
                            },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                //render: 'value',
                                render: function (args) {
                                    return numeral(args.value).format('0,0');
                                },
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#000000',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,


                              }
                            }
                        }
                    });
                });
            }
        }
/* ----------------------------- */

function showGraph5(site, customer, fullStartDate, fullEndDate)
        {

            {

                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (barGraph6) {
                    barGraph6.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = fullStartDate;
                var endDate = fullEndDate;
                //alert ("customer is" + customer +  "   site is"  +  site +  "  start is   " + start + "    end is   " + end);
                //$.post("https://www.apleona.ie/wastefiles_test/items_reused.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                $.post(ROOTWASTE + "/items_reused.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                function (data)
                {
                    console.log(data);
                     var material = [];
                    var amount = [];

                    for (var i in data) {
                        material.push(data[i].Treatment_Method_Detail);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: material,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };


                    var graphTarget = $("#graphCanvas5");

                    barGraph6 = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    afterDataLimits(scale) {
                                        scale.max += (scale.max*0.10);
                                      }
                                }]
                            },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                //render: 'value',
                                render: function (args) {
                                    return numeral(args.value).format('0,0');
                                },
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#000000',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,


                              }
                            }
                        }
                    });
                });
            }
        }
/* ----------------------------- */

   function showCharityGraph1(site, customer, fullStartDate, fullEndDate)
        {
            

            {

                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (charityGraph1) {
                    charityGraph1.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = fullStartDate;
                var endDate = fullEndDate;
                //alert ("customer is" + customer +  "   site is"  +  site +  "  start is   " + start + "    end is   " + end);
                //$.post("https://www.apleona.ie/wastefiles_test/top_charity_quantities.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate, 
                $.post(ROOTWASTE + "/top_charity_quantities.php?mySite="  + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                function (data)
                {
                    console.log(data);
                     var material = [];
                    var amount = [];

                    for (var i in data) {
                        material.push(data[i].material_description);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: material,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };

                    var graphTarget = $("#charityCanvas1");

                        charityGraph1 = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    afterDataLimits(scale) {
                                        scale.max += (scale.max*0.10);
                                      }
                                }]
                            },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                render: 'value',
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#000000',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,

                              }
                            }
                        }
                    });
                });
            }
        }
/* ----------------------------- */

   function showCharityGraph2(site, customer, fullStartDate, fullEndDate)
        {
            {

                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (charityGraph2) {
                    charityGraph2.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = fullStartDate;
                var endDate = fullEndDate;
                //$.post("https://www.apleona.ie/wastefiles_test/top_charity_by_waste_producer.php?mySite=" + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                $.post(ROOTWASTE + "/top_charity_by_waste_producer.php?mySite=" + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                 function (data)
                {
                    console.log(data);
                    var producer = [];
                    var amount = [];

                    for (var i in data) {
                        producer.push(data[i].Customer_Waste_Producer);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: producer,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#ffffff',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };

                    var graphTarget = $("#charityCanvas2");

                    charityGraph2 = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    afterDataLimits(scale) {
                                        scale.max += (scale.max*0.10);
                                      }
                                }]
                            },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                render: 'value',
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#000000',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,

                              }
                            }
                        }
                    });
                });
            }
        }

/* ---------------------------------- */

function showCharityGraph3(site, customer, fullStartDate, fullEndDate)
        {
            {

                                // if the chart is not undefined (e.g. it has been created)
                // then destory the old one so we can create a new one later
                if (charityGraph3) {
                    charityGraph3.destroy();
                }

                var thisSite = site;
                var thisCustomer = customer;
                var startDate = fullStartDate;
                var endDate = fullEndDate;
                //$.post("https://www.apleona.ie/wastefiles_test/donations_by_charity.php?mySite=" + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                $.post(ROOTWASTE + "/donations_by_charity.php?mySite=" + thisSite + "&myCustomer=" + thisCustomer + "&myStart=" + startDate + "&myEnd=" + endDate,
                 function (data)
                {
                    console.log(data);
                    var producer = [];
                    var amount = [];

                    for (var i in data) {
                        producer.push(data[i].charity_donated_to);
                        amount.push(data[i].Total);
                    }

                    var chartdata = {
                        labels: producer,
                        datasets: [
                            {
                                label: 'Quantity',
                                backgroundColor: ['#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59', '#1E5631', '#A4DE02', '#76BA1B', '#4C9A2A', '#ACDF87', '#68BB59'],
                                borderColor: '#ffffff',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };

                    var graphTarget = $("#charityCanvas3");

                    charityGraph3 = new Chart(graphTarget, {
                        type: 'doughnut',
                        data: chartdata,
                        options: {
                            // title: {
                            //     display: true,
                            //     text: 'just a code snippet ...'
                            //   },
                              legend: {
                                display: true,
                                position: 'left',
                                // labels: {
                                //   /* here one can adjust the legend's labels, if required */
                                //   //generateLabels: function(chart) {}
                                // }
                              },
                            plugins: {
                              labels: {
                                // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                                render: 'percentage',
                                        // font size, default is defaultFontSize
                                fontSize: 12,

                                // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                                fontColor: '#fff',

                                // font style, default is defaultFontStyle
                                fontStyle: 'normal',

                                // font family, default is defaultFontFamily
                                fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

                                // draw text shadows under labels, default is false
                                textShadow: true,

                                // draw label even it's overlap, default is true
                                // bar chart ignores this
                                overlap: true,

                                // position to draw label, available value is 'default', 'border' and 'outside'
                                // bar chart ignores this
                                // default is 'default'
                                position: 'default',

                                // add padding when position is `outside`
                                // default is 2
                                //outsidePadding: 4,

                                // add margin of text when position is `outside` or `border`
                                // default is 2
                                textMargin: 2,
                              }
                            }
                        }
                    });
                });
            }
        }

/* ---------------------------------- */

 
</script>



 