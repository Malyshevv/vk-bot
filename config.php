<?php
ini_set('display_errors', 0);

/* Access token профиля ВКонтакте */
$config['token'] = "ваш токе";

/* Эти значения не меняем */
$config['url'] = 'http://'.$_SERVER['HTTP_HOST'];
$config['key'] = "some very-very long string without any non-latin characters due to different string representations inside of variable programming languages";
