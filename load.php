<?php

gila::route('messenger-bot', function() {
  global $bot;
  include_once(__DIR__."/MessengerBot.php");
  $bot = new MessengerBot();

  include_once(__DIR__.'/answers.php');

  $bot->response();
});
