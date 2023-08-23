# evrima-rcon
PHP libary for The Isle Evrima RCON



## Example Usage
![image](https://github.com/Theislemanager/evrima-rcon/assets/143001364/139adfcb-4946-4d89-8294-15f3b07374a5)
![image](https://github.com/Theislemanager/evrima-rcon/assets/143001364/746d1b50-59ec-4c1e-83e3-e4d23ade28ff)



```php
include __DIR__ . '/src/rcon.php';
$rcon = new RconClient('your_server_ip', 'your_rcon_port', 'your_rcon_password');
if($rcon->connect()){
$response = $rcon->sendCommand('announce', 'Hello World');
//$response = $rcon->sendCommand('kick', 'STEAMID64');
echo $response.PHP_EOL;
}else{
echo 'Could not connect';
}
```


### Documentation for RCON from game developers

https://docs.google.com/document/d/1JI_qVdKIZrqcVTY2Tqnm1T_Ws3_1r5nINGxfprbWw7w/edit#heading=h.p9tfb89b07jd
