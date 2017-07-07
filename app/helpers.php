<?php
// app/helpers.php

function url($uri){

	return sprintf(
	// "%s://%s%s%s",
	"%s://%s/%s%s",
	isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',  // renvoi http ou https
	$_SERVER['SERVER_NAME'],  // renvois le nom de domaine (ex localhost ou mondomaine.com)
	// $_SERVER['SERVER_NAME'] == 'localhost' ? ':8888/Paparazza/paparazza/' : '',
	$_SERVER['SERVER_NAME'] == 'localhost' ? 'paparazza/paparazza/' : '',
	$uri
	);
}

function randString($length) { // cette fonction servira à générer le jetton de session pour éviter les attaques CSRF
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function redirect($url){
	header('location:' . $url);
	exit;
}

function isLogged(){
	return isset($_SESSION['admin']);
}

function checkCsrf(){
	if($_SESSION['csrf_token'] != $_POST['csrf_token']){
		die('Espèce de vilain pirate, je t\'ai eu avec mon token !');
	}
}

function checkExtension($file){
	$acceptedExtensions = array('jpg', 'jpeg', 'gif', 'png');
	$uploadExtension = strtolower(substr(strrchr($file, '.'), 1) );
	return in_array($uploadExtension, $acceptedExtensions);
}

function esc($var)
{
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
}
