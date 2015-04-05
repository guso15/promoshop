(function($) {
	$(document).ready(function() {
		$('.datepicker').change(function() {
			$.showProducts();
		});
		
		$('#datesetter').click(function() {
			$.showProducts();
		});
		
		$('#proimage').load(function() {
			$.showProducts();
		});
		
		$('.proselect').click(function() {
			$.showSubmitButton();
		});
		
		$('.submit').mouseenter(function() {
			if(!$('#agb').attr('checked')){
				alert(unescape('Sie m%FCssen unsere Ausleihbedingungen akzeptieren!'));
			} 
		});
		
		if ($('#delivery').attr("value") == 2) {
			$('#deliverynote').css('display','block');
		}
		
		$('#delivery').change(function() {
			if ($('#delivery').attr("value") == 2) {
				$('#deliverynote').css('display','block');
			} else {
				$('#deliverynote').css('display','none');
			}
		});
		
		$.extend({
			showSubmitButton: function() {
				/* alle Elemente mit der CSS-Klasse "proselect" durchlaufen */  
				$('.proselect').each(function(e) {  
	
					/* Wert des aktuellen Elements auslesen */  
					val = $(this).attr("value");  

					/* Wenn der Wert mindestens 1 ist */  
					if(val > 0) {  
						/* Submitbutton anzeigen und Schleife abbrechen */  
						$('.sButton').css('display','block');
						return false;
					} else {
						/* Andernfalls wenn alle Werte 0 sind Submitbutton ausblenden */  
						$('.sButton').css('display','none');
					}
				});
			},
			
			showProducts: function() {
				var $endtime = $('#endtime').attr("value");
				var $starttime = $('#starttime').attr("value");
				var $storagePid = $('#storagePid').attr("value");
				var $productStoragePid = $('#productStoragePid').attr("value");
				var $productCategorie = $('#productCategorie').attr("value");
				
				$('#datesetter').css('display','none');

				$.ajax({
					type: 'GET',
					url: 'index.php',
					data: {
						eID: 'availableProducts',
						starttime: $starttime,
						endtime: $endtime,
						storagePid: $storagePid,
						productStoragePid: $productStoragePid,
						productCategorie: $productCategorie
					},
					dataType: 'json',
					success: function(response) {
						if (response) {
							$('#showtime').html(response[0]);
							$('#showtime').css('display','block');
							
							var $selectedProducts = '';
							var $selected = '';
						
							if ($('#selectedProductField').attr("value")) {
								$selectedProducts = new Array();
								$prods = $('#selectedProductField').attr("value").split(',');
								$.each($prods, function(index, value) {
    								$pro = value.split('=');
    								$selectedProducts[$pro[0]] = $pro[1];
								});
							}
							// Set the selectable option fields for each product quantity
    						$.each(response[1], function(prod, amount) {
    						    var $i = 1;
 
 								$('#prod'+prod).children().remove();
    						    
    						    if (amount > 100) {
    						    	amount = 100;
    						    }
    						    if (amount < 1) {
    						    	$('#prod'+prod).append(
    					        		$('<option></option>').val(0).html('In diesem Zeitraum ausgebucht!')
   		 					    	);
    						    } else {
    						    	$('#prod'+prod).append(
    					        		$('<option></option>').val(0).html(0)
   		 					    	);
    						    }
    						    
    						    while($i <= amount) {
    						    	if ($selectedProducts[prod] == $i) {
    						    		$selected = ' selected="selected"';
    						    	} else {
    						    		$selected = '';
    					    		}
    					    		$('#prod'+prod).append(
    					        		$('<option' + $selected + '></option>').val($i).html($i)
   		 					    	);
    						    	$i++;
    						    };
    						});
    						$.showSubmitButton();
						}
					}
				});
			}
		
		});
		
	});
 })(jQuery);