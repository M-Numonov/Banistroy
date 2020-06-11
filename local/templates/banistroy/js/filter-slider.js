$(document).ready(function(){

	/*- slider-range -*/

	var mini = parseFloat($(".min-price").data("value"));
	var maxi = parseFloat($(".max-price").data("value"));

	var mini_val = parseFloat($(".min-price").val());
	var maxi_val = parseFloat($(".max-price").val());


	$( "#slider-range" ).slider({
		range: true,
		min: mini,
		max: maxi,
		values: [ mini_val, maxi_val ],
		slide: function( event, ui ) {
			$( "#first-price" ).val(ui.values[0]).change();
			$( "#last-price" ).val(ui.values[1]).change();
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
		$(this).keyup();
		$("#slider-range").slider("values",0,value1);
	});

	$("#last-price").change(function(){

		var value1=$("#first-price").val();
		var value2=$("#last-price").val();

		if(parseInt(value1) > parseInt(value2)){
			value2 = value1;
			$("#last-price3").val(value2);
		}
		$(this).keyup();
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

	var mina = parseFloat($("#first-area").data("value"));
	var maxa = parseFloat($("#last-area").data("value"));

	var mina_val = parseFloat($("#first-area").val());
	var maxa_val = parseFloat($("#last-area").val());

	$( "#slider-range2" ).slider({
		range: true,
		min: mina,
		max: maxa,
		values: [ mina_val, maxa_val ],
		slide: function( event, ui ) {
			$( "#first-area" ).val(ui.values[0]).change();
			$( "#last-area" ).val(ui.values[1]).change();
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











