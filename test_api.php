<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script>

$(document).ready(function() {

	var debug    = true;
	var original = window.console;
	window.console = {};

	console['log'] = function () {
		return (debug && original) ? original['log'].apply(original, arguments) : false;
	}

	$("#api_responce").click(function(){
		var text = document.getElementById('api_responce');
		if ($.browser.msie) {
			var range = document.body.createTextRange();
			range.moveToElementText(text);
			range.select();
		} else if ($.browser.mozilla || $.browser.opera) {
			var selection = window.getSelection();
			var range = document.createRange();
			range.selectNodeContents(text);
			selection.removeAllRanges();
			selection.addRange(range);
		} else if ($.browser.safari) {
			var selection = window.getSelection();
			selection.setBaseAndExtent(text, 0, text, 1);
		}
	});

});

//add your AbanteCart main index.php URL here 
 var abantecart_url = 'http://[domain]/index.php';
 var abantecart_ssl_url = 'https://[domain]/index.php';
 
var token = '';
var api_key = '';

function add_to_cart () {

	$('#api_responce').html( '' );

	var input_data = {
		'rt': 'a/checkout/cart',
		'product_id' : $('#product_id').val(),
		'quantity' : $('#quantity').val(),
		'option' : {},
		'api_key' : $('#api_key').val()
	}
	input_data.option[ $('#option_id').val() ] = $('#option_value').val();

	$.ajax({
		type: 'POST',
		url: abantecart_url,
		data: input_data,
		success: function (data) {
			showResponse(this, data);
		},
		dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});

}

function get_cart () {

	$('#api_responce').html( '' );

	$.ajax({
		type: 'POST',
		url: abantecart_url,
		data: {'rt': 'a/checkout/cart', 'api_key' : $('#api_key').val() },
		success: function (data)
		{
			showResponse(this, data);
		},
		dataType: "text",
		error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});

	}

function remove_cart () {

    $('#api_responce').html( '' );
    var remove = {};
	remove[ $('#remove_key1').val() ] = 1;
	remove[ $('#remove_key2').val() ] = 1;
		
	$.ajax({
		type: 'POST',
		url: abantecart_url,
		data: {
			'rt': 'a/checkout/cart',
			'remove' : remove,
			'api_key' : $('#api_key').val()
		},
		success: function (data) {
			showResponse(this, data);
		},
		dataType: "text",
		error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});

}

function remove_cart_get() {

    $('#api_responce').html( '' );
    var remove = {};
	remove[ $('#remove_key1').val() ] = 1;
	remove[ $('#remove_key2').val() ] = 1;
		
	$.ajax({
		type: 'get',
		url: abantecart_url,
		data: {
			'rt': 'a/checkout/cart/delete',
			'remove' : remove,
			'api_key' : $('#api_key').val()
		},
		success: function (data) {
			showResponse(this, data);
		},
		dataType: "text",
		error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});

}


function login () {

	api_key = $('#api_key').val();

    $('#api_responce').html( '' );
    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {'rt': 'a/account/login', 'email' : $('#email').val(), 'password' : $('#password').val(), 'api_key' : api_key },
		dataType: "json",
        success: function (data) {
            console.log(data);
			console.log('Token: '+ data.token);
			token = data.token;
            load_account();
        },
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });

}

function validate_login () {

    $('#api_responce').html( '' );

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {'rt': 'a/account/login', 'token' : token, 'api_key' : api_key },
		dataType: "text",
        success: function (data) {
            showResponse(this, data);
        },
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}

    });

}

function logout () {

    $('#api_responce').html( '' );

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {'rt': 'a/account/logout', 'token' : token, 'api_key' : api_key },
        success: function (data) {
            showResponse( this, data );
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });

}

function load_account () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {'rt': 'a/account/account', 'token' : token, 'api_key' : api_key },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });
}

function load_history () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {'rt': 'a/account/history', 'token' : token, 'api_key' : api_key },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });
}

function getProduct ()
{
	var test = $('#product_id').val();
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt': 'a/product/product',
			'product_id' : test,
			'api_key' : api_key
		},
		dataType: 'text',
		success: function (res)
		{
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function getProductQTY ()
{
	var test = $('#product_id_qty').val();
	var option = $('#option_value_id_qty').val();
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt': 'a/product/quantity',
			'product_id' : test,
			'option_value_id' : option,
			'api_key' : api_key
		},
		dataType: 'text',
		success: function (res)
		{
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}


function getRelatedProducts()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt' : 'a/product/related',
			'product_id' : $('#product_id').val(),
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function getProductImage()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt' : 'a/product/resources',
			'product_id' : $('#product_id').val(),
			'resource_type' : 'image',
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function getProductResources()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt' : 'a/product/resources',
			'product_id' : $('#product_id').val(),
			'resource_type' : 'all',
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function getProductReview()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 'rt' : 'a/product/review',
			'product_id' : $('#product_id').val(),
			'page' : 1,
			'rows' : 5,
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function getCategory()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 'rt' : 'a/product/category', 'category_id' : $('#category_id').val(), 'api_key' : api_key },
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function getManufacturer()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 'rt' : 'a/product/manufacturer', 'manufacturer_id' : $('#manufacturer_id').val(), 'api_key' : api_key },
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function getManufacturers()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 'rt' : 'a/product/manufacturer', 'api_key' : api_key },
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}


function getProductsByCategory()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 'rt' : 'a/product/filter', 'category_id' : $('#category_id').val(), 'api_key' : api_key },
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function search()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt' : 'a/product/filter',
			'keyword' : $('#keyword').val(),
			'page' : 1,
			'rows' : 10,
			'sidx' : 'price',
			'sord' : 'ACS',
			'_search' : 'true',
			'filters' : '%7B%22groupOp%22:%22AND%22,%22rules%22:%5B%7B%22field%22:%22name%22,%22op%22:%22cn%22,%22data%22:%22ab%22%7D%5D%7D',
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function createAccount()
{
	var values = {};
	$.each($('#AccountFrm').serializeArray(), function(i, field) {
	    values[field.name] = field.value;
	});
	//values['email'] = Math.random() + values['email'];
	values['rt'] = 'a/account/create';
	values['api_key'] = api_key;
    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: values,
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });

}

function getAccountFields()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 
			'rt' : 'a/account/create',
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function editAccount()
{
	var values = {};
	$.each($('#AccountEditFrm').serializeArray(), function(i, field) {
	    values[field.name] = field.value;
	});
	values['rt'] = 'a/account/edit';
	values['token'] = token;
	values['api_key'] = api_key;

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: values,
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });

}

function getAccountEditFields()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 
			'rt' : 'a/account/edit',
			'token' : token,
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}


function getZones()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 
			'rt' : 'a/common/zone',
			'country_id' : $('#country_id').val(),
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			if ( res.length > 0 )
			{
				console.log(eval('('+res+')'));
			}
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function getCountries()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: { 
			'rt' : 'a/common/country',
			'api_key' : api_key
		},
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});
}

function get_shipping () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {
        	'rt': 'a/checkout/shipping',
        	'token' : token,
        	'mode' : 'list',
        	'api_key' : api_key
        },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });
}

function select_shipping () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {
			'rt': 'a/checkout/shipping',
			'token' : token,
			'mode' : 'select',
			shipping_method : $('#shipping_method').val(),
			'api_key' : api_key
        },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });
}

function get_payment () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {
			'rt': 'a/checkout/payment',
			'token' : token,
			'mode' : 'list',
			'api_key' : api_key
        },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });
}

function select_payment () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {
			'rt': 'a/checkout/payment',
			'token' : token,
			'mode' : 'select',
			'payment_method' : $('#payment_method').val(),
			'agree' : '1',
			'api_key' : api_key
        },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });
}


function select_shipping_address () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {
			'rt': 'a/checkout/address',
			'token' : token,
			'mode' : 'shipping',
			'api_key' : api_key
        },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });
}

function update_shipping_address () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {
			'rt': 'a/checkout/address',
			'token' : token,
			'mode' : 'shipping',
			'address_id' : $('#shipping_address_id').val(),
			'api_key' : api_key
        },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });

}

function add_shipping_address()
{
	var values = {};
	$.each($('#ShippingAddressFrm').serializeArray(), function(i, field) {
	    values[field.name] = field.value;
	    console.log(field.value);
	});
	values['rt'] = 'a/checkout/address';
	values['token'] = token;
	values['mode'] = 'shipping';
	values['action'] = 'save';
	values['api_key'] = api_key;
	
    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: values,
		dataType: 'text',
		success: function(res)
		{
		console.log(this.data);
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });

}

function select_payment_address () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {
			'rt': 'a/checkout/address',
			'token' : token,
			'mode' : 'payment',
			'api_key' : api_key
        },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });
}

function update_payment_address () {

    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {
			'rt': 'a/checkout/address',
			'token' : token,
			'mode' : 'payment',
			'address_id' : $('#payment_address_id').val(),
			'api_key' : api_key
        },
        success: function (data) {
            showResponse(this, data);
        },
        dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });

}

function add_payment_address()
{
	var values = {};
	$.each($('#ShippingAddressFrm').serializeArray(), function(i, field) {
	    values[field.name] = field.value;
	});
	values['rt'] = 'a/checkout/address';
	values['token'] = token;
	values['mode'] = 'payment';
	values['action'] = 'save';
	values['api_key'] = api_key;
	
    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: values,
		dataType: 'text',
		success: function(res)
		{
			console.log(eval('('+res+')'));
			showResponse(this, res);
		},
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
    });

}

function get_confirmation () {

	$.ajax({
		type: 'POST',
		url: abantecart_ssl_url,
		data: {
			'rt': 'a/checkout/confirm', 
			'token' : token,
			'api_key' : api_key
		},
		success: function (data) {
			showResponse(this, data);
		},
		dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});

}

function process_order() {

	$.ajax({
		type: 'POST',
		url: abantecart_ssl_url,
		data: {
			'rt': 'a/checkout/process', 
			'token' : token, 
			'api_key' : api_key
		},
		success: function (data) {
			showResponse(this, data);
		},
		dataType: "text",
        error: function(obj, status, msg)
		{
			console.log(obj);
			console.log(status);
			console.log(msg);
			showResponse(this, obj.responseText);
		}
	});

}

function showResponse(ajax, data)
{
	var request = '';
	request += 'Request type: '+ ajax.type + "\n";
	if (ajax.data)
	{
		request += decodeURIComponent(ajax.data);
	}
	else
	{
		request += decodeURIComponent(ajax.url);
	}
	$('#api_request').val(request);
	var display_data = formatJson( data );
	$('#api_responce').html( display_data );
	$('#shadow').show();
	$('#response_section').show();
	scrollTo();
}

function hideResponse()
{
	$('#shadow').hide();
	$('#response_section').hide();
}

function getScrollY()
{
	var scrollY = 0;
	if (typeof window.pageYOffset == "number")
	{
		scrollY = window.pageYOffset;
	}
	else if (document.documentElement && document.documentElement.scrollTop)
	{
		scrollY = document.documentElement.scrollTop;
	}
	else if (document.body && document.body.scrollTop)
	{
		scrollY = document.body.scrollTop;
	}
	else if (window.scrollY)
	{
		scrollY = window.scrollY;
	}
	return scrollY;
}

function scrollTo()
{
	var scrollY = getScrollY();
	$('#response_section').css('top', scrollY + 150 + 'px');
}

// formatJson() :: formats and indents JSON string
function formatJson(val) {
	var retval = '';
	var str = val;
    var pos = 0;
    var strLen = str.length;
	var indentStr = '&nbsp;&nbsp;&nbsp;&nbsp;';
    var newLine = '<br />';
	var char = '';
	
	for (var i=0; i<strLen; i++) {
		char = str.substring(i,i+1);
		
		if (char == '}' || char == ']') {
			retval = retval + newLine;
			pos = pos - 1;
			
			for (var j=0; j<pos; j++) {
				retval = retval + indentStr;
			}
		}
		
		retval = retval + char;	
		
		if (char == '{' || char == '[' || char == ',') {
			retval = retval + newLine;
			
			if (char == '{' || char == '[') {
				pos = pos + 1;
			}
			
			for (var k=0; k<pos; k++) {
				retval = retval + indentStr;
			}
		}
	}
	
	return retval;
}

</script>

<style type="text/css">
body
{
	background-color: #5f6061;
	margin: 0;
}
.field{
	padding: 5px;
}

.main_content
{
	width: 1024px;
	margin: 0 auto;
	background-color: #FFFFFF;
	padding: 15px;
}
.container
{
	width: 350px;
}

.shadow
{
	width:100%;
	height:100%;
	overflow:hidden;
	position:fixed;
	left:0px; top:0px;
	background: #000;
	filter: progid:DXImageTransform.Microsoft.Alpha(opacity=55);
	-moz-opacity: 0.55;
	-khtml-opacity: 0.55;
	opacity: 0.55;
	display: none;
}

.popup
{
	width: 800px;
	overflow: hidden;
	position: absolute;
	left: 50%;
	margin-left: -408px;
	border: 1px solid #030000;
	display: none;
	background-color: #ffffff;
	padding: 10px;
}

.float_left
{
	float: left;
}

.float_right
{
	float: right;
}

.clear
{
	clear: both;
}

.field
{
	padding-top: 3px;
}

.btn_standard
{
	display: inline-block;
	white-space: nowrap;
	background-color: #ccc;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ccc));
	background-image: -webkit-linear-gradient(top, #eee, #ccc);
	background-image: -moz-linear-gradient(top, #eee, #ccc);
	background-image: -ms-linear-gradient(top, #eee, #ccc);
	background-image: -o-linear-gradient(top, #eee, #ccc);
	background-image: linear-gradient(top, #eee, #ccc);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#eeeeee', EndColorStr='#cccccc');
	border: 1px solid #777;
	padding: 0 1em;
	margin-right: 5px;
	font: bold 16px Arial, Helvetica;
	text-decoration: none;
	color: #333;
	text-shadow: 0 1px 0 rgba(255,255,255,.8);
	-moz-border-radius: .2em;
	-webkit-border-radius: .2em;
	border-radius: .2em;
	-moz-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
	-webkit-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
	box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
}

.btn_standard:hover
{
	background-color: #ddd;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#fafafa), to(#ddd));
	background-image: -webkit-linear-gradient(top, #fafafa, #ddd);
	background-image: -moz-linear-gradient(top, #fafafa, #ddd);
	background-image: -ms-linear-gradient(top, #fafafa, #ddd);
	background-image: -o-linear-gradient(top, #fafafa, #ddd);
	background-image: linear-gradient(top, #fafafa, #ddd);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#fafafa', EndColorStr='#dddddd');
}

.request_area
{
	width: 740px;
	height: 50px;
}
.response_area
{
	width: 740px;
	height: 250px;
	overflow: scroll;
}
</style>

</head>
<body>
	<div id="shadow" class="shadow">
	</div>

	<div id="response_section" class="popup">
		<div class="float_right">
			<a class="btn_standard" href="javascript:hideResponse();"><span>X</span></a>
		</div>
		Request:<br>
		<textarea id="api_request" class="request_area"></textarea>
		<br>
		Response:<br>
		<div id="api_responce" class="response_area"></div>
		<div class="clear"></div>
		<!--
		<div class="float_right">
			<a class="btn_standard" href="javascript:hideResponse();"><span>X</span></a>
		</div>
		-->
	</div>

	<div class="main_content">
		<p><b>This is a test script for AbanteCart API. </b><br> Need to be located on the same domain as AbanteCart. Can work remotely from other places if cross domain security is lifted </p>
		<div id="key_section" class="container">
			<div class="field clear">
				<div class="float_left">API key (optional is enabled):</div>
				<div class="float_right"><input type="text" id="api_key" /></div>
			</div>
		</div>
		<div class="clear"></div>
		<hr>
		<div id="login_section" class="container">
			<div class="field clear">
				<div class="float_left">E-mail:</div>
				<div class="float_right"><input type="text" id="email" /></div>
			</div>
			<div class="field clear">
				<div class="float_left">Password:</div>
				<div class="float_right"><input type="text" id="password" /></div>
			</div>
		</div>
		<div class="field clear">
			<a href="javascript:login()" class="btn_standard float_left" id="login"><span title="Login" class="button1" id="done"><span>Login</span></span></a>
			<a href="javascript:validate_login()" class="btn_standard float_left" id="validate_login"><span title="Login" class="button1" id="done"><span>Is logged in?</span></span></span></a>
			<a href="javascript:logout()" class="btn_standard float_left" id="logout"><span title="Logout" class="button1" id="done"><span>Logout</span></span></a>
			<a href="javascript:load_history()" class="btn_standard float_left" id="login"><span title="history" class="button1" id="done"><span>Account History</span></span></a>
		</div>
		<div class="clear"></div>
		<hr>

		<div id="registration_section">
			Customer Registration
			<div class="container">
			<form name="AccountFrm" id="AccountFrm">
				<div class="field clear">
					<div class="float_left">Loginname:</div>
					<div class="float_right"><input type="text" value="loginname" id="AccountFrm_loginname	" name="loginname"></div>
				</div>
				<div class="field clear">
					<div class="float_left">E-mail:</div>
					<div class="float_right"><input type="text" value="test@test.com" id="AccountFrm_email" name="email"></div>
				</div>
				<div class="field clear">
					<div class="float_left">First Name:</div>
					<div class="float_right"><input type="text" value="First Name" id="AccountFrm_firstname" name="firstname"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Last Name:</div>
					<div class="float_right"><input type="text" value="Last Name" id="AccountFrm_lastname" name="lastname"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Phone:</div>
					<div class="float_right"><input type="text" value="435435435" id="AccountFrm_telephone" name="telephone"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Fax:</div>
					<div class="float_right"><input type="text" value="434543543" id="AccountFrm_fax" name="fax"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Company:</div>
					<div class="float_right"><input type="text" value="test" id="AccountFrm_company" name="company"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Address 1:</div>
					<div class="float_right"><input type="text" value="Address 1" id="AccountFrm_address_1" name="address_1"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Address 2:</div>
					<div class="float_right"><input type="text" value="Address 2" id="AccountFrm_address_2" name="address_2"></div>
				</div>
				<div class="field clear">
					<div class="float_left">City:</div>
					<div class="float_right"><input type="text" value="Test City" id="AccountFrm_city" name="city"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Post Code:</div>
					<div class="float_right"><input type="text" value="087901" id="AccountFrm_postcode" name="postcode"></div>
				</div>

				<div class="field clear">
					<div class="float_left">Country Code:</div>
					<div class="float_right">
						<select id="AccountFrm_country_id" name="country_id" style="width: 142px;">
							<option selected="selected" value="223">United States</option>
						</select>
					</div>
				</div>

				<div class="field clear">
					<div class="float_left">State:</div>
					<div class="float_right">
						<select id="AccountFrm_zone_id" name="zone_id" style="width: 142px;">
							<option value="3676" selected="selected">Wisconsin</option>
						</select>
					</div>
				</div>
				<div class="field clear">
					<div class="float_left">Password:</div>
					<div class="float_right"><input type="password" value="123456789" id="AccountFrm_password" name="password"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Repeat password:</div>
					<div class="float_right"><input type="password" value="123456789" id="AccountFrm_confirm" name="confirm"></div>
				</div>
				<div class="field clear">
					<div class="float_left">Newsletter Subsribe:</div>
					<div class="float_right"><input type="radio" name="newsletter" value="1" id="AccountFrm_newsletter1"></div>
				</div>
				<div class="field clear">
					<div class="float_left">I am agree with Privacy Policy </div>
					<div class="float_right"><input type="checkbox" value="1" checked="checked" id="AccountFrm_agree" name="agree"></div>
				</div>
			</form>
			</div>

			<div class="field clear">
				<a href="javascript:createAccount();" class="btn_standard float_left"><span title="Greate Account" class="button1" id="done"><span>Create Account</span></span></a>
				<a href="javascript:getAccountFields();" class="btn_standard float_left"><span title="Get Create Account Fields" class="button1" id="done"><span>Get Create Account Fields</span></span></a>
			</div>
		</div>
		<div class="clear"></div>
		<hr>
		
		<div id="acc_edit_section">
			Customer Account Edit
			<div class="container">
				<form name="AccountEditFrm" id="AccountEditFrm">
					<div class="field clear">
						<div class="float_left">First Name:</div>
						<div class="float_right"><input type="text" value="First Name" id="AccountFrm_firstname" name="firstname"></div>
					</div>
					<div class="field clear">
						<div class="float_left">Last Name:</div>
						<div class="float_right"><input type="text" value="Last Name" id="AccountFrm_lastname" name="lastname"></div>
					</div>
					<div class="field clear">
						<div class="float_left">E-mail:</div>
						<div class="float_right"><input type="text" value="test@test.com" id="AccountFrm_email" name="email"></div>
					</div>
					<div class="field clear">
						<div class="float_left">Phone:</div>
						<div class="float_right"><input type="text" value="435435435" id="AccountFrm_telephone" name="telephone"></div>
					</div>
					<div class="field clear">
						<div class="float_left">Fax:</div>
						<div class="float_right"><input type="text" value="434543543" id="AccountFrm_fax" name="fax"></div>
					</div>
					<div class="field clear">
						<div class="float_left">Newsletter Subsribe:</div>
						<div class="float_right"><input type="radio" name="newsletter" value="1" id="AccountFrm_newsletter1"></div>
					</div>
				</form>
			</div>

			<div class="field clear">
				<a href="javascript:editAccount();" class="btn_standard float_left"><span title="Edit Account" class="button1" id="done"><span>Edit Account</span></span></a>
				<a href="javascript:getAccountEditFields();" class="btn_standard float_left"><span title="Get Edit Account Fields" class="button1" id="done"><span>Get Edit Account Fields</span></span></a>
			</div>
		</div>

		<div class="clear"></div>
		<hr>

		<div id="countries_section">
			<div class="container">
				<div class="field clear">
					<div class="float_left">Zones by Country ID:</div>
					<div class="float_right"><input type="text" id="country_id" /></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:getZones()" class="btn_standard float_left" id="getZones"><span title="getZones" class="button1" id="done"><span>Get Zones</span></span></a>
				<a href="javascript:getCountries()" class="btn_standard float_left" id="getCountries"><span title="getCountries" class="button1" id="done"><span>Get All Countries</span></span></a>
			</div>
		</div>

		<div class="clear"></div>
		<hr>
		
		<div id="products_section">
			<div class="container">
				<div class="field clear">
					<div class="float_left">Product ID:</div>
					<div class="float_right"><input type="text" id="product_id" /></div>
				</div>

				<div class="field clear">
					<div class="float_left">
						<a href="javascript:getProduct();" class="btn_standard" id="product"><span title="Get Product" class="button1" id="done"><span>Get Product</span></span></a>
					</div>
				</div>
			</div>

			<div class="container">

				<div class="field clear">
					<div class="float_left">Product ID:</div>
					<div class="float_right"><input type="text" id="product_id_qty" /></div>
					<div class="float_left">Option value ID (optional):</div>
					<div class="float_right"><input type="text" id="option_value_id_qty" /></div>					
				</div>

				<div class="field clear">
					<div class="float_left">
						<a href="javascript:getProductQTY();" class="btn_standard" id="product"><span title="Get Product QTY" class="button1" id="done"><span>Get Product QTY</span></span></a>
					</div>
				</div>
			</div>

			<div class="container">

				<div class="field clear">
					<div class="float_left">Quantity:</div>
					<div class="float_right"><input type="text" id="quantity" /></div>
				</div>

				<div class="field clear">
					<div class="float_left">Option ID:</div>
					<div class="float_right"><input type="text" id="option_id" /></div>
				</div>
				<div class="field clear">
					<div class="float_left">Option Value:</div>
					<div class="float_right"><input type="text" id="option_value" /></div>
				</div>
			</div>



			<div class="field clear">
				<a href="javascript:add_to_cart()" class="btn_standard float_left" id="add_to_cart"><span title="Add To Cart" class="button1" id="done"><span>Add to Cart</span></span></a> &nbsp; &nbsp;
				<a href="javascript:getRelatedProducts();" class="btn_standard float_left"><span title="Related Products"><span>Related Products</span></span></a>
				<a href="javascript:getProductReview();" class="btn_standard float_left"><span title="Product Review"><span>Product Review</span></span></a>
				<a href="javascript:getProductImage();" class="btn_standard float_left"><span title="Product Image"><span>Product Image</span></span></a>
				<a href="javascript:getProductResources();" class="btn_standard float_left"><span title="Product Review"><span>Product Resources</span></span></a>
			</div>
		</div>

		<div class="clear"></div>
		<hr>
		
		<div id="categories_section">
			<div class="container">
				<div class="field clear">
					<div class="float_left">Category ID:</div>
					<div class="float_right"><input type="text" id="category_id" /></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:getCategory();" class="btn_standard float_left"><span title="Get Category"><span>Get Category</span></span></a>
				<a href="javascript:getProductsByCategory();" class="btn_standard float_left"><span title="Products in Category"><span>Products in Category</span></span></a>
			</div>
		</div>
		<div class="clear"></div>
		<hr>

		<div id="categories_section">
			<div class="container">
				<div class="field clear">
					<div class="float_left">Manufacturer ID:</div>
					<div class="float_right"><input type="text" id="manufacturer_id" /></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:getManufacturer();" class="btn_standard float_left"><span title="Get Manufacturer"><span>Get Manufacturer</span></span></a>
				<a href="javascript:getManufacturers();" class="btn_standard float_left"><span title="Get Manufacturers"><span>Get Manufacturers</span></span></a>
			</div>
		</div>
		<div class="clear"></div>
		<hr>

		<div id="search_section">
			<div class="container">
				<div class="field clear">
					<div class="float_left">Search product:</div>
					<div class="float_right"><input type="text" id="keyword" /></div>
			</div>
			<div class="field clear">
				<a href="javascript:search();" class="btn_standard float_left"><span title="Search"><span>Search</span></span></a>
			</div>
		</div>
		<div class="clear"></div>
		<hr>

		<div id="checkout_section">
			
			<p>Checkout API</p>
			<div class="field clear">
				<a href="javascript:get_cart()" class="btn_standard float_left" id="get_cart"><span title="Cart Content" class="button1" id="done"><span>Show Cart Content</span></span></a>
			</div>
			<br>
			<br>
			<div class="container">
				<div class="field clear">
					<div class="float_left">Key 1:</div>
					<div class="float_right"><input type="text" id="remove_key1" /></div>
				</div>
				<div class="field clear">
					<div class="float_left">Key 2:</div>
					<div class="float_right"><input type="text" id="remove_key2" /></div>
				</div>
			</div>

			<div class="field clear">
				<a href="javascript:remove_cart()" class="btn_standard float_left" id="remove_from_cart"><span title="Cart Content" class="button1" id="done"><span>Delete from Cart (POST)</span></span></a>
			</div>
			<div class="field clear">
				<a href="javascript:remove_cart_get()" class="btn_standard float_left" id="remove_from_cart"><span title="Cart Content" class="button1" id="done"><span>Delete from Cart (GET)</span></span></a>
			</div>
			
		
			<br>
			<br>
			
			<div class="field clear">
				<a href="javascript:get_shipping()" class="btn_standard float_left" id="get_shipping"><span title="Select Shipping" class="button1" id="done"><span>Checkout (Select Shipping)</span></span></a>
			</div>

			<div class="container">
				<div class="field clear">
					<div class="float_left">Shipping Method:</div>
					<div class="float_right"><input type="text" id="shipping_method" /></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:select_shipping()" class="btn_standard float_left" id="select_shipping"><span title="Select Shipping" class="button1" id="done"><span>Select Shipping</span></span></a>
			</div>
			<div class="field clear">
				<a href="javascript:get_payment()" class="btn_standard float_left" id="get_payment"><span title="Get Payments" class="button1" id="done"><span>Payment Selections</span></span></a>
			</div>
			<div class="container">
				<div class="field clear">
					<div class="float_left">Payment Method:</div>
					<div class="float_right"><input type="text" id="payment_method" /></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:select_payment()" class="btn_standard float_left" id="select_payment"><span title="Select Payment" class="button1" id="done"><span>Select Payment</span></span></a>
			</div>
			<div class="field clear">
				<a href="javascript:select_shipping_address()" class="btn_standard float_left" id="select_shipping_addres"><span title="Select Shipping Address" class="button1" id="done"><span>Different  Shipping Address (get data)</span></span></a>
				<a href="javascript:select_payment_address()" class="btn_standard float_left" id="select_payment_addres"><span title="Select Payment Address" class="button1" id="done"><span>Different payment(billing) Address (get data)</span></span></a>
			</div>
			<br><br>
			<div class="container" style="width:460px;">
				<div class="field clear">
					<div class="float_left">Shipping Address Select (shipping address ID):</div>
					<div class="float_right"><input type="text" value="" id="shipping_address_id" name="Shipping Adress ID"></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:update_shipping_address();" class="btn_standard"><span title="Greate Account" class="button1" id="done"><span>Select Shipping Address</span></span></a>
			</div>
			<div class="container" style="width:460px;">
				<div class="field clear">
					<div class="float_left">Payment Address Select (payment address ID):</div>
					<div class="float_right"><input type="text" value="" id="payment_address_id" name="payment Adress ID"></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:update_payment_address();" class="btn_standard float_left"><span title="Greate Account" class="button1" id="done"><span>Select Payment (billing) Address</span></span></a>
			</div>
			<div class="clear"></div>

			<p>Add New Shipping Or Payment (billing) Address</p>
			<div class="container">
				<form name="AccountFrm" id="ShippingAddressFrm">
					<div class="field clear">
						<input type="text" value="First Name" id="AccountFrm_firstname" name="firstname">
					</div>
					<div class="field clear">
						<input type="text" value="Last Name" id="AccountFrm_lastname" name="lastname">
					</div>
					<div class="field clear">
						<input type="text" value="test" id="AccountFrm_company" name="company">
					</div>
					<div class="field clear">
						<input type="text" value="Address 1" id="AccountFrm_address_1" name="address_1">
					</div>
					<div class="field clear">
						<input type="text" value="Address 2" id="AccountFrm_address_2" name="address_2">
					</div>
					<div class="field clear">
						<input type="text" value="Test City" id="AccountFrm_city" name="city">
					</div>
					<div class="field clear">
						<input type="text" value="087901" id="AccountFrm_postcode" name="postcode">
					</div>
					<div class="field clear">
						<select id="AccountFrm_country_id" style="width: 142px;" name="country_id">
							<option selected="selected" value="223">United States</option>
						</select>
					</div>
					<div class="field clear">
						<select id="AccountFrm_zone_id" style="width: 142px;" name="zone_id">
							<option value="3676" selected="selected">Wisconsin</option>
						</select>
					</div>
				</form>
			</div>

			<div class="field clear">
				<a href="javascript:add_shipping_address();" class="btn_standard float_left"><span title="Greate Account" class="button1" id="done"><span>Add New Shipping Address</span></span></a>
				<a href="javascript:add_payment_address();" class="btn_standard float_left"><span title="Greate Account" class="button1" id="done"><span>Add New Payment Address</span></span></a>
			</div>
		</div>
		<br><br>
		<div class="field clear">
			<a href="javascript:get_confirmation();" class="btn_standard float_left"><span title="Greate Account" class="button1" id="done"><span>Get Confirmation </span></span></a>
			<a href="javascript:process_order();" class="btn_standard float_left"><span title="process order" class="button1" id="done"><span>Process Order</span></span></a>
		</div>
	</div>
	<div class="clear"></div>
</body>

</html>   
