$(document).ready(function(){


					$('#a').click(function () 
					{
				  if ($('#a:checked').length == 1)
				    $('#mytestbutton').removeAttr('disabled');
				  else
				    $('#mytestbutton').attr('disabled','disabled');
				});
					
					   
					
				})
				
				