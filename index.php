<?php
include __DIR__ . '/src/rcon.php';
$rcon = new RconClient('your_server_ip', 'your_rcon_port', 'your_rcon_password');
if($rcon->connect()){
$response = $rcon->sendCommand('announce', 'Hello World');
//$response = $rcon->sendCommand('kick', 'STEAMID64');
echo $response.PHP_EOL;
}else{
echo 'Could not connect';
}
