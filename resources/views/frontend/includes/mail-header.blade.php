<style>
.centered {
   display: block;
   margin: auto auto;
}
.title {
	widht: 100%;
	text-align: center;
	height: 5em;
	line-height: 5em;
	background: #3097D1;
	color: white;
	font-family: Helvetica;
	vertical-align: middle;
}
.title h1 a:link {
	text-decoration: none;
	color: white;
}
.title h1 a:visited {
	text-decoration: none;
	color: white;
}
.content {
	widht: 100%;
	text-align: center;
	padding: 3em;
	font-family: Helvetica;
}
.footer {
	widht: 100%;
	text-align: center;
}
.button {
	background: #019934;
	border: none;
	color: white;
	padding: 10px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 12px;
	margin: 4px 2px;
	border-radius: 8px;
	text-transform: uppercase;
}
</style>
<div class="title">
	<a class="centered" href="{{ route('frontend.index') }}"><img class="centered" src="{{ asset('img/frontend/email/header.jpg') }}" alt="HazaTér"></a>
</div>
<div class="content">
	<h3 style="text-align:left">Kedves HazaTér felhasználó!</h3>
	<br>
