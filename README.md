# evrima-rcon
PHP libary for The Isle Evrima RCON

##Example Usage
```
    require_once('rcon.php');
    $rcon = new RconClient("your_server_ip", "your_rcon_port", "your_rcon_password");
    if($rcon->connect()){
        $response = $rcon->sendCommand('announce', 'Hello World');
        echo "$response\n";
    }else{
        echo "Could not connect";
    }
```
