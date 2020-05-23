<?php

class MessengerBot {

  private $answers = [];
  public $sender;
  public $input;
  
  function __construct ()
  {
  }

  function response()
  {
    $hubVerifyToken = Gila::option('fb-messenger-bot.verifyToken');
    $accessToken = Gila::option('fb-messenger-bot.accessToken');

    if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
      echo $_REQUEST['hub_challenge'];
      exit;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    file_put_contents('log/fb/'.date("Y-m-d H:i:s").'.json', json_encode($input, JSON_PRETTY_PRINT));
    $this->input = $input;
    $this->sender = $input['entry'][0]['messaging'][0]['sender'];
    $senderId = $this->sender['id'];
    $messageText = $input['entry'][0]['messaging'][0]['message']['text'];
    $response = null;

    if(Gila::option('fb-messenger-bot.log',0)==1) {
      $logger = new logger('fb-messenges.log');
      $logger->log($senderId, $messageText);
    }

    if($answer = $this->getAnswer($messageText)) {
      if(is_string($answer)) {
        $answer = [ 'text' => $answer ];
      }
      $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => $answer
      ];
      $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
      if(!empty($input)){
      $result = curl_exec($ch);
      }
      curl_close($ch);
    }
  }

  function getAnswer($string)
  {
    foreach ($this->answers as $ans) {
      if (preg_match_all('#^' . $ans['pattern'] . '$#', $string, $matches, PREG_OFFSET_CAPTURE)) {
        $matches = array_slice($matches, 1);
        $vars = array_map(function ($match, $i) use ($matches) {
          if (isset($matches[$i + 1]) && isset($matches[$i + 1][0]) && is_array($matches[$i + 1][0])) {
            return trim(substr($match[0][0], 0, $matches[$i + 1][0][1] - $match[0][1]), '/');
          }
          return isset($match[0][0]) ? trim($match[0][0], '/') : null;
        }, $matches, array_keys($matches));

        if (is_callable($ans['fn'])) {
          return call_user_func_array($ans['fn'], $vars);
        }
      }
    }
  }

  function listen($pattern, $fn) {
    $this->answers[] = ['pattern'=>$pattern, 'fn'=>$fn];
  }

}
