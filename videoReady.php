<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$metadata = new AMQPTable([
  'x-delayed-type' => 'direct',
]);
$channel->exchange_declare(
  'delayed_exchange',
  'x-delayed-message',
  false,
  false,
  false,
  false,
  false,
  $metadata
);

$channel->queue_declare('timeoutQueue', false, true, false, false);
$channel->queue_declare('subtitledVideos', false, true, false, false);
$channel->queue_bind('timeoutQueue', 'delayed_exchange', 'timeout');
$callback = function ($msg) {
  global $channel, $connection;
  $receivedMsg = $msg->getbody();
  $successMsg = json_decode($receivedMsg, True);

  if ($_SESSION['tempName'] == $successMsg['tempName']) {
    echo $receivedMsg;

    $msg1 = new AMQPMessage(
      $receivedMsg,
      array(
        'delivery_mode' => 2,
        'application_headers' => new AMQPTable([
          'x-delay' => 3600000
        ])
      )
    );
    $channel->basic_publish($msg1, 'delayed_exchange', 'timeout');
    $msg->ack();

    $channel->close();
    $connection->close();
    die();
  }
};
if (isset($_POST["videoNameTemp"])) {
  if ($_POST["videoNameTemp"] == $_SESSION["tempName"]) {
    $msg1 = array('tempName' => $_SESSION["tempName"], 'originalName' => $_SESSION['originalName'], "bug" => "Yup");
    $msg1 = json_encode($msg1);
    $msg1 = new AMQPMessage($msg1);
    $channel->basic_publish($msg1, '', 'timeoutQueue');


    foreach ($_SESSION as $key => $val) {

      if ($key !== 'Username') {

        unset($_SESSION[$key]);
      }
    }
    header("Location: http://videosubtitle/");
    die();
  } else {
    echo "invalid video name!";
  }
} else {
  $channel->basic_consume('subtitledVideos', '', false, false, false, false, $callback);
  $channel->consume();
}
