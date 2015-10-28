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

var admin = 'admin_path';
var abantecart_url = 'http://[domain]/index.php?s='+admin;
var abantecart_ssl_url = 'https://[domain]/index.php?s='+admin;
var token = '';
var api_key = '';


function login () {

	api_key = $('#api_key').val();

    $('#api_responce').html( '' );
    $.ajax({
        type: 'POST',
        url: abantecart_ssl_url,
        data: {'rt': 'a/index/login', 'username' : $('#username').val(), 'password' : $('#password').val(), 'api_key' : api_key },
		dataType: "json",
        success: function (data) {
            showResponse(this, JSON.stringify(data));
            console.log(data);
			console.log('Token: '+ data.token);
			token = data.token;
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
        data: {'rt': 'a/index/login', 'token' : token, 'api_key' : api_key },
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
        data: {'rt': 'a/index/logout', 'token' : token, 'api_key' : api_key },
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


function getCustomerDetails ()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt': 'a/customer/details',
			'customer_id' : $('#customer_id').val(),
			'token' : token, 
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

function getCustomerOrders ()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt': 'a/customer/orders',
			'customer_id' : $('#customer_id').val(),
			'token' : token, 
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

function getOrderDetails ()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt': 'a/order/details',
			'order_id' : $('#order_id').val(),
			'token' : token, 
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

function seachCustomers()
{
	$.ajax({
		url: abantecart_url,
		type: 'GET',
		data: {
			'rt' : 'a/customer/search',
			'page' : 1,
			'rows' : 10,
			'sidx' : 'lastname',
			'sord' : 'ACS',
			'loginname' : $('#sloginname').val(),
			'firstname' : $('#firstname').val(),
			'lastname' : $('#lastname').val(),
			'email' : $('#email').val(),
			'telephone' : $('#telephone').val(),
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
	</div>

	<div class="main_content">
		<p><b>This is a test script for AbanteCart Admin API. </b><br>Note: This test script need to be located on the same domain as AbanteCart. Can work remotely from other places if cross domain security is lifted </p>
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
				<div class="float_left">Username:</div>
				<div class="float_right"><input type="text" id="username" /></div>
			</div>
			<div class="field clear">
				<div class="float_left">Password:</div>
				<div class="float_right"><input type="text" id="password" /></div>
			</div>
		</div>
		<div class="field clear">
			<a href="javascript:login()" class="btn_standard float_left" id="login"><span title="Login" class="button1" id="done"><span>Admin Login</span></span></a>
			<a href="javascript:validate_login()" class="btn_standard float_left" id="validate_login"><span title="Login" class="button1" id="done"><span>Is logged in?</span></span></span></a>
			<a href="javascript:logout()" class="btn_standard float_left" id="logout"><span title="Logout" class="button1" id="done"><span>Logout</span></span></a>
		</div>
		<div class="clear"></div>
		<hr>
		
		<div id="acc_edit_section">
			Customer Search
			<div class="container">
				<form name="AccountEditFrm" id="AccountEditFrm">
					<div class="field clear">
						<div class="float_left">Login Name</div>
						<div class="float_right"><input type="text" value="" id="sloginname" name="loginname"></div>
					</div>
					<div class="field clear">
						<div class="float_left">First Name</div>
						<div class="float_right"><input type="text" value="" id="firstname" name="firstname"></div>
					</div>
					<div class="field clear">
						<div class="float_left">Last Name: *</div>
						<div class="float_right"><input type="text" value="Last Name" id="lastname" name="lastname"></div>
					</div>
					<div class="field clear">
						<div class="float_left">Email</div>
						<div class="float_right"><input type="text" value="" id="email" name="email"></div>
					</div>
					<div class="field clear">
						<div class="float_left">Phone Number</div>
						<div class="float_right"><input type="text" value="" id="telephone" name="telephone"></div>
					</div>
				</form>
			</div>

			<div class="field clear">
				<a href="javascript:seachCustomers();" class="btn_standard float_left"><span title="Customers Search" class="button1" id="done"><span>Search Customers</span></span></a>
			</div>
		</div>

		<div class="clear"></div>
		<hr>

		
		<div id="customer_section">
			<div class="container">
				<div class="field clear">
					<div class="float_left">Get Customer Details (Customer ID):</div>
					<div class="float_right"><input type="text" id="customer_id" /></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:getCustomerDetails();" class="btn_standard float_left"><span title="Get Customer Details"><span>Get Customer Details</span></span></a>
				<a href="javascript:getCustomerOrders();" class="btn_standard float_left"><span title="Get Customer Orders"><span>Get Customer Orders</span></span></a>
			</div>
		</div>
		<div class="clear"></div>
		<hr>

		<div id="orders_section">
			<div class="container">
				<div class="field clear">
					<div class="float_left">Get Order Details (Order ID):</div>
					<div class="float_right"><input type="text" id="order_id" /></div>
				</div>
			</div>
			<div class="field clear">
				<a href="javascript:getOrderDetails();" class="btn_standard float_left"><span title="Get Order Details"><span>Get Order Details</span></span></a>
			</div>
		</div>
		<div class="clear"></div>
		<hr>

	</div>
	<div class="clear"></div>
</body>

</html>   
