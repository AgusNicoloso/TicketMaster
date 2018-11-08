<?php
	if (!isset($_SESSION))
  {
    session_start();
  }


	require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '295728671040301',
		'app_secret' => '5b73046113c9c6a9a50bc874ece2ca6b',
		'default_graph_version' => 'v3.2'
	]);

	$helper = $FB->getRedirectLoginHelper();
	if (isset($_GET['state']))
	{
		$helper->getPersistentDataHandler()->set('state', $_GET['state']);
	}

	$helper = $FB->getRedirectLoginHelper();
?>
