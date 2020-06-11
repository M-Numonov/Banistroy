$(document).ready(function(){

	/*- slider-range -*/
	$( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 2000000,
      values: [ 0, 2000000 ],
      slide: function( event, ui ) {
		$( "#first-price" ).val(ui.values[ 0 ]);
		$( "#last-price" ).val(ui.values[ 1 ]);
      }
    });
    $( "#first-price" ).val( $( "#slider-range" ).slider( "values", 0 ) );
	$( "#last-price" ).val( $( "#slider-range" ).slider( "values", 1 ) );
	
	$("#first-price").change(function(){

		var value1=$("#first-price").val();
		var value2=$("#last-price").val();

		if(parseInt(value1) > parseInt(value2)){
			value1 = value2;
			$("#first-price").val(value1);
		}
		$("#slider-range").slider("values",0,value1);	
	});
	
	$("#last-price").change(function(){

		var value1=$("#first-price").val();
		var value2=$("#last-price").val();

		if(parseInt(value1) > parseInt(value2)){
			value2 = value1;
			$("#last-price3").val(value2);
		}
		$("#slider-range").slider("values",1,value2);	
	});
	
	$('#first-price, #last-price').keypress(function(event){
		var key, keyChar;
		if(!event) var event = window.event;
		
		if (event.keyCode) key = event.keyCode;
		else if(event.which) key = event.which;
	
		if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==37 || key==39 ) return true;
		keyChar=String.fromCharCode(key);
		
		if(!/\d/.test(keyChar))	return false;
	
	});

	$( "#slider-range2" ).slider({
      range: true,
      min: 0,
      max: 100,
      values: [ 0, 100 ],
      slide: function( event, ui ) {
		$( "#first-area" ).val(ui.values[ 0 ]);
		$( "#last-area" ).val(ui.values[ 1 ]);
      }
    });
    $( "#first-area" ).val( $( "#slider-range2" ).slider( "values", 0 ) );
	$( "#last-area" ).val( $( "#slider-range2" ).slider( "values", 1 ) );
	
	$("#first-area").change(function(){

		var value1=$("#first-area").val();
		var value2=$("#last-area").val();

		if(parseInt(value1) > parseInt(value2)){
			value1 = value2;
			$("#first-area").val(value1);
		}
		$("#slider-range2").slider("values",0,value1);	
	});
	
	$("#last-area").change(function(){

		var value1=$("#first-area").val();
		var value2=$("#last-area").val();

		if(parseInt(value1) > parseInt(value2)){
			value2 = value1;
			$("#last-price3").val(value2);
		}
		$("#slider-range2").slider("values",1,value2);	
	});
	
	$('#first-area, #last-area').keypress(function(event){
		var key, keyChar;
		if(!event) var event = window.event;
		
		if (event.keyCode) key = event.keyCode;
		else if(event.which) key = event.which;
	
		if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==37 || key==39 ) return true;
		keyChar=String.fromCharCode(key);
		
		if(!/\d/.test(keyChar))	return false;
	
	});
		
});











