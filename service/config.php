<?php
date_default_timezone_set("Europe/Moscow");

const HOST = 'https://onboarding.xredday.ru/';
const DBUSER = 'root';
const DBPASS = '';
const DBHOST = 'localhost';
const DB = 'database';
const MAILHOST = 'host@mail.send';
const MAILADDR = 'user@mail.send';
const MAILUNME = 'UserName UserLastName';
const MAILPSWD = 'passwordformail';

$sql = new mysqli(DBHOST, DBUSER, DBPASS, DB) or die("Не удалось установить соединение с базой данных...");
$sql->set_charset('utf-8');
