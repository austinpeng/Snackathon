<?php
session_start();
// This is the Snackathon API for Orders
$mode = $_REQUEST['mode'];
$possible_modes = array('register', 'login_app', 'logout_app', 'get_restaurants', 'get_restaurant_info', 'submit_order');
function register($db, $input)
{
	
}
function login_app($db, $input)
{
	if(!isset($input['username']))
	{
		return array("status" => 1, "error" => "Missing Username");
	}
	if(!isset($input['password']))
	{
		return array("status" => 1, "error" => "Missing Password");
	}
	$res = mysqli_query($db, "CALL login(\"" . $input['username'] . "\", \""  . $input['password'] . "\")"));
	while ($row = $res->fetch_object()){
        $row = $row;
    });
	return array("status" => 0, "result" => $row);
	
}
function logout_app($db, $input)
{
	session_destroy();
	if(!isset($input['username']))
	{
		return array("status" => 1, "error" => "Missing Username");
	}
	if(!isset($input['current_auth']))
	{
		return array("status" => 1, "error" => "Missing Username");
	}
	$res = mysqli_query($db, "CALL clear_user_session(\"" . $input['username'] . "\", \""  . $input['current_auth'] . "\")"));
	return array("status" => 0, "result" => array());
}
function get_restaurants($db, $input)
{
	$res = mysqli_query($db, "CALL get_restaurants()", MYSQLI_USE_RESULT);
	$rests = array();
	while ($row = $res->fetch_object()){
        $rests[] = $row;
    });
	$result->close();
    $db->next_result();
	return array("status" => 0, "result" => $rests);
	
}
function get_restaurant_info($db, $input)
{
	if(!isset($input['rest_id']))
	{
		return array("status" => 1, "error" => "Missing Restaurant ID");
	}
	$res = mysqli_query($db, "CALL get_restaurant_menu_items(\"" . $input['rest_id'] . "\")", MYSQLI_USE_RESULT);
	$menu_items = array();
	while ($row = $res->fetch_object()){
        $menu_items[] = $row;
    });
	$result->close();
    $db->next_result();
	foreach($menu_items as &$item)
	{
		$m_id = $item['menu_item_id'];
		$res = mysqli_query($db, "CALL get_item_mods(\"" . $m_id . "\")", MYSQLI_USE_RESULT);
		$item_mods = array();
		while ($row = $res->fetch_object()){
			$item_mods[] = $row;
		});
		$item['mods'] = $item_mods;
	}
	return array("status" => 0, "result" => $menu_items);
	
}
function submit_order($db, $input)
{
	
}
if(in_array($mode, $possible_modes))
{
	// Process Request
	$link = mysqli_connect("127.0.0.1", "root", "rooter", "snackathon_1");

	if (!$link) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	
	$result = $mode($link, $_REQUEST);
	echo 1;
}
else
{
	// Fail Request
	echo 0;
}
?>