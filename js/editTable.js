$(function () 
{ 

$("td").dblclick(function () 

	{ 
	var OriginalContent = $(this).text(); 
	
	/* gets the partner name and report ID from the cells along the same row */
	var partnerName = $(this).closest("tr").find("#partnerName").text();
	var reportID = $(this).closest("tr").find("#reportID").text();
	
	$(this).addClass("cellEditing"); 
	$(this).html("<input type='text' value='" + OriginalContent + "' />"); 
	$(this).children().first().focus(); 
	
	/* Enter Key pressed */
	$(this).children().first().keypress(function (e) 
	
		{ 
		if (e.which == 13) { 
		var newContent = $(this).val(); 
		$(this).parent().text(newContent); 
		$(this).parent().removeClass("cellEditing");
		
		alert("updating Report \n " + "partner: " + partnerName + ", report :" + newContent);
		
		// declare data to be transferred by ajax call 
		
		updateType = "ajaxReportUpdate";
		
		dataString = {
			'reportID': reportID,
			'partnerName': partnerName,
			'reportText': newContent,
			'ajaxUpdateType': updateType
		}
		
		// ajax call 
		
		request = $.ajax({
			url: "report-controller.php",
			type:"POST",
			data: dataString,
			
		}); 
		
		request.done(function(response,status, jqXHR)
		{
			alert(response,status);
		});
		
		request.fail(function (jqXHR, textStatus, err)
		{

		alert(err);
		
		});
		
		request.always(function(){
			
		});
		
		event.preventDefault();
		
		
		/* return false; */
		
		/* ajax call 
		var action = "update-report.php";
		var format = "html";
		var ws = e.target.action
		var url = ws + 
				"?partnerName=" + partnerName +
				"&reportText=" + newContent +
				"&format=";
				
		$("#output").load(url);
		
		return false;*/ 
		
		} 
		}); 
		$(this).children().first().blur(function()
			{ 
			$(this).parent().text(OriginalContent); 
			$(this).parent().removeClass("cellEditing"); 
		}); 
	}); 
}); 

