<html>
	<head>
		<title>CATWORK AKADEMI YARIŞMA PLATFORMU'NA HOŞGELDİN!</title>
	</head>
	<body>
		{{ $user['email'] }}
		<br>
		<p>Your Register email with us is : {{ $user['email'] }}</p>
		<p>{{ config('app.name') }}</p>
	</body>
</html>