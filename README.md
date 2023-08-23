# evrima-rcon
PHP libary for The Isle Evrima RCON



Example Usage
![image](https://github.com/Theislemanager/evrima-rcon/assets/143001364/139adfcb-4946-4d89-8294-15f3b07374a5)


```
    require_once('src/rcon.php');
    $rcon = new RconClient("your_server_ip", "your_rcon_port", "your_rcon_password");
    if($rcon->connect()){
        $response = $rcon->sendCommand('announce', 'Hello World');
        echo "$response\n";
    }else{
        echo "Could not connect";
    }
```
