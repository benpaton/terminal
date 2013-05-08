<?php
	//set headers so that the page doesn't get cached
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	//set username and password
	$username = "root";
	$password = "password";
	
	//get server IP
	$serverIP = $_SERVER['SERVER_ADDR'];
	
	//set loggedIn cookie
	if (isset($_POST["password"]) && isset($_POST["username"])) {
		if ($_POST["password"] == $password && $_POST["username"] = $username) {
			setcookie("loggedIn", "true");
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>terminal</title>
    <style type="text/css">
		body {
            margin:0;
            padding:0;
            background-color:#000;
            color:#0F0;
			font-family:"Courier New", Courier, monospace;
			font-size:12px;
			cursor: url(cursor.png), auto;
        }
		ul,
		li {
			margin:0;
			padding:0;
		}
		li {
			list-style-type:none;
		}
		pre {
			margin:0;
            padding:0;
		}
		input,
		label {
			background-color:#000;
			border:none;
			color:#0F0;
			font-size:12px;
			cursor: url(cursor.png), auto;
			width:85%;
		}
		label {
			margin-right:10px;
		}
        #container {
            padding:10px;
        }
		input#password {
			color:#000;
		}
    </style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			//function to delete cookies
			delete_cookie = function(name) {
    			document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
			};
					
			//set initial html in the command ul
			var inputString = '<li><label for="command"><?php echo $username; ?>@<?php echo $serverIP; ?>:~$</label><input id="command" name="command" type="text" value="" autocomplete="off" /></li>';
			$('#input').append(inputString);
			
			<?php if ($_COOKIE["loggedIn"] != true) { ?>
				//set initial focus when logged in to the username input box
				$('#username').focus();
			<?php } else { ?>
				//set initial focus when logged out to the command line input box
				$('#command').focus();
			<?php } ?>
			
			//username keyup function to hide and then show the password field once the user has hit enter and to transfer focus to the password field
			$('#passField').hide();
			$("#username").bind("keypress", function(e) {
            	if (e.keyCode == 13) {
					$('#passField').show();	
					$('#password').focus();
					return false;
            	}
        	});	
				
			//command keyup function
			$('#command').keyup(function(event){
				if(event.keyCode == 13){
					
					//get input value
					var commandValue = $(this).val();
										
					//switch based on commandValue
					switch(commandValue) {
						case 'clear':
							window.location.replace("index.php");
							break;
						case 'exit':
							delete_cookie('loggedIn');
							window.location.replace("index.php");
							break;
						default:
							var command = 'shellexec.php?c=';
							command += commandValue;
							$.get(command, function(data) {
								var response = '<li><label for="command"><?php echo $username; ?>@<?php echo $serverIP; ?>:~$</label><input name="command" type="text" value="'
								response += commandValue;
								response += '" autocomplete="off" /></li>';
								response += '<li><pre>';
								response += data;
								response += '</pre></li>';
								$('#result').append(response);
								$('#command').val("");
								$('#command').focus();
								$('html, body').animate({ scrollTop: $(document).height() }, "slow");
							});
					}
				}
			});
		});	
	</script>
</head>
<body>
    <div id="container">
		<?php if ($_COOKIE["loggedIn"] != true) { ?>
			<form id="form" method="post">
            	<ul>
					<li><label for="username">login as:</label><input id="username" name="username" type="text" value="" autocomplete="off" /></li>
					<li id="passField"><label for="password">root@<?php echo $serverIP; ?>'s password:</label><input id="password" name="password" type="password" value="" /></li>
					<li><input id="submitBtn" name="submit" type="submit" value="" /></li>
				</ul>
            </form>
		<?php } else { ?>
			<ul id="result"></ul>
			<ul id="input"></ul>
		<?php } ?>
    </div><!-- closes container -->
</body>
</html>