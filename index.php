<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";
require_once "vk.api.php";

define('VK_TOKEN', $config['token']);
$vk = new VK(VK_TOKEN);

// Получаем список последних 15 сообщений //
$messages = $vk->request('messages.getDialogs', array(
		'count' => '15',
	));

// Ставим статус Online //
if (rand(1, 20) == 10) {
	$setonline = $vk->request('account.setOnline');
}

foreach ((array) $messages['response'] as $key => $value) {
	$uid     = $value['uid'];
	$message = $value['body'];

	$vkprofileinfo = $vk->request('users.get', array(
			'name_case' => 'nom',
			'fields'    => 'sex,photo_50,bdate,city,country',
			'user_ids'  => $uid,
		));

	$photo             = $vkprofileinfo['response'][0]['photo_50'];
	$last_name         = $vkprofileinfo['response'][0]['last_name'];
	$first_name        = $vkprofileinfo['response'][0]['first_name'];
	$read_state_info   = $value['read_state'];
	$message_send_info = $value['out'];
	#$data              = $value['date'];
	$text = $value['body'];

	if ($read_state_info === 0 && $value['out'] !== 1) {
		#echo $uid.' '.$read_state_info.' '.$value['out'].' '.$first_name.' '.$last_name.' '.$text.'</br>';
		if (isset($value['uid'])) {
			$send = $vk->request('messages.send', array(
					'message' => 'Привет,'.$first_name.' '.$last_name,
					'uid'     => $value['uid'],
				));
		}
	} else {

	}
}

?>