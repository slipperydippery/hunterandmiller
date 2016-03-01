<?php
$errors = [];
$missing = [];
$mailSent = false;
// check if the form has been submitted
if (isset($_POST['submit']))
{
	// process email script:
	$to = 'zorgbemiddeling@vivazorggroep.nl';
	$subject = 'ViVa! WoonWijzer Contact Formulier';
	// list expected fields
	$expected = ['naam', 'email', 'telefoon', 'bericht'];
	// list required fields
	$required = ['naam', 'email'];
	$headers = "From: Zorgbemiddeling<zorgbemiddeling@vivazorggroep.nl>\r\n";
	$headers .= 'Content-Type: text/plain; charset=utf-8';
	require 'processmail.php';
	if ($mailSent)
	{
		// header('Location: bedankt.php');
		// exit;
	}
}
?>