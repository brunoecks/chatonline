<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">

	<title>Chat</title>

	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Acme|Lato|Raleway|Signika&display=swap" rel="stylesheet"> 

	<script
	src="https://code.jquery.com/jquery-3.4.1.js"
	integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	crossorigin="anonymous"></script>


	

</head>
<body>
	<?php
	session_start();
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$_SESSION['username'] = $username;
	?>

	<div id="wrapper">

		<center><h2 id="welcome">Bem vindo ao bate papo, <?php session_start(); echo $_SESSION['username']; ?>.</h2> <a href="index.html">Sair da sala</a></center>	


		
		<div class="chat_wrapper">
			
			<div id="abc"></div>
			<div id="chat"></div>

			<form method="POST" id="frmMensagem">
				<textarea id="txtMensagem" name="message" cols="30" rows="2" class="textarea" placeholder="Digite uma mensagem..." autofocus required></textarea>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="$('form').submit();">Enviar</button>
			</form>

		</div>


	</div>


	<script>

		LoadChat();


		setInterval(function(){

			LoadChat();

		}, 1000);


		function LoadChat()
		{
			$.post('inc/messages.php?action=getMessages', function(response){
				
				var scrollpos = $('#chat').scrollTop();
				var scrollpos = parseInt(scrollpos) + 520;
				var scrollHeight = $('#chat').prop('scrollHeight');

				$('#chat').html(response);

				if( scrollpos < scrollHeight ){
					
				}else{
					$('#chat').scrollTop( $('#chat').prop('scrollHeight') );
				}

			});
		}
		
		
		
		$('.textarea').keyup(function(e){
			if( e.which == 13 ){
				$('form').submit();
			}
		});

		
		
		$('form').submit(function(){

			var message = $('.textarea').val();

			$.post('inc/messages.php?action=sendMessage&message='+message, function(response){

				console.log('log 1.01');
				console.log('response', response);

				//document.getElementById('frmMensagem').reset();
				$('#frmMensagem').trigger("reset");

				if ( response==1 ){
					console.log('log 2.01');
					//LoadChat();
					//document.getElementById('frmMensagem').reset();
				}
				
			});
			return false;
		});


	</script>


</body>
</html>