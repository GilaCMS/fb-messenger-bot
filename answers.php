<?php

/*
You can change this file with answers. Regex expressions are used.
May help https://www.rexegg.com/
*/

$bot->listen('hi', function(){
  return "Hi!";
});

$bot->listen('my name is (.*?)', function($name){
  return "Nice to meet you $name!";
});

$bot->listen('what is my user id', function(){
  global $bot;
  return json_encode($bot->sender, JSON_PRETTY_PRINT);
});
