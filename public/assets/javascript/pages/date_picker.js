
<script>

flatpickr("#rangeDatepicker2", {
  mode: "range",
  enableTime: false,
  dateFormat: "d-m-y",
  onChange: ([start, end]) => {
    if (start && end) {
 

 <?php
             //prep the php values for javascript

             echo 'var customer = "' . $customer . '";';
             echo 'var site = "' . $site . '";';
           


            
  ?>   

	    //var dateFormat = require('dateformat');
		//dateFormat(start, "dddd, mmmm dS, yyyy, h:MM:ss TT");
		//var mystart = new Date();
		//mystart.toString('yyyy-MM-dd');
		
		//$.flatpickr.formatDate(mystart);
		startYear = start.getFullYear();
		startMonth = start.getMonth();
		startDay = start.getDate();
		fullStartDate = startYear + "-" + (startMonth + 1) + "-" + startDay;

		endYear = end.getFullYear();
		endMonth = end.getMonth();
		endDay = end.getDate();
		fullEndDate = endYear + "-" + (endMonth + 1) + "-" + endDay;

		console.log(startYear);
		console.log(startMonth);
		console.log(startDay);
		console.log(fullStartDate);
		console.log(fullEndDate);


	    console.log({ start, end });
	    refreshScreen(site, customer, fullStartDate, fullEndDate);
		
	    
    }
  }
});

  function refreshScreen(site, customer, fullStartDate, fullEndDate)
        {
        	//alert ("customer is" + customer +  "   site is"  +  site +  "  start is   " + start + "    end is   " + end);
        	//location.reload();
			//var url = window.location.href;
            //url += '&myStart=' + fullStartDate + '&myEnd=' + fullEndDate;
			//url.searchParams.set('myStart', fullStartDate);
            //window.location.href = url;
			//window.location.search = jQuery.query.set("myCustomer", 10);
			var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?mySite=' + site + '&myCustomer=' + customer + '&myStart=' + fullStartDate + '&myEnd=' + fullEndDate;    
			window.history.pushState({ path: refresh }, '', refresh);
			updateDiv();
			//$("#graphCanvas").remove();
        	showGraph(site, customer, fullStartDate, fullEndDate);
        	showGraph1(site, customer, fullStartDate, fullEndDate);
        	showGraph2(site, customer, fullStartDate, fullEndDate);
			showGraph3(site, customer, fullStartDate, fullEndDate);
			//console.log(refresh);
			//window.location.href = refresh;

        	
        }

		function updateDiv() {      
			$( "#testDiv" ).load(location.href + " #testDiv" );
			//$( "#Graph1" ).load(location.href + " #Graph1" );
		}

		window.onload = function() {
			// showGraph(site, customer, fullStartDate, fullEndDate);
        	// showGraph1(site, customer, fullStartDate, fullEndDate);
        	// showGraph2(site, customer, fullStartDate, fullEndDate);

			<?php
             //prep the php values for javascript
             echo 'var customer = "' . $customer . '";';
             echo 'var site = "' . $site . '";';            
			?> 

			var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?mySite=' + site + '&myCustomer=' + customer;    
			window.history.pushState({ path: refresh }, '', refresh);
			updateDiv();
		  };

		//   window.onbeforeunload = function() { 
		// 	window.setTimeout(function () { 
		// 		window.location = '';
		// 	}, 0); 
		// 	window.onbeforeunload = null; // necessary to prevent infinite loop, that kills your browser 
		// }






</script>