<?php

require_once __DIR__ . '/../vendor/autoload.php';


$date_ago = new \Smirik\PHPDateTimeAgo\DateTimeAgo();

echo $date_ago->get(new \DateTime('-24 hours')); // 1 day ago

$italian_date_ago = new \Smirik\PHPDateTimeAgo\DateTimeAgo(new \Smirik\PHPDateTimeAgo\TextTranslator\ItalianTextTranslator());

echo $italian_date_ago->get(new \DateTime('-24 hours')); // 1 giorno fa
