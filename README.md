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





__________________________________________________________________



### Documentation for RCON from game developers

**COMMUNICATION PROTOCOL**

The most common use of RCON is to allow server owners to control their game servers without direct access to the machine the server is running on. In order for commands to be accepted, the connection must first be authenticated using the server's RCON password, which can be set using the config Game.ini file.


**CONFIGURATION SETUP**

The configuration for RCON is set through the Game.ini file; here is an example of the available configuration settings. 

```
[/Script/TheIsle.TIGameSession]
ServerName=The Isle Manager
MaxPlayerCount=50
bEnableHumans=false
bServerGlobalChat=false
bServerNesting=true
bServerFallDamage=true
bAllowReplay=false
bServerDynamicTimeOfDay=false
ServerTimeOfDayInSeconds=21600
ServerLengthOfDayInSeconds=3600
bServerDynamicWeather=true
QueueEnabled=true
QueuePort=14042
bRconEnabled=true
RconPassword=password
RconPort=8888
```
- `bRconEnabled` enables/disables the RCON.
- `RconPassword` sets the password used for authentication.
- `RconPort` sets the port RCON will use.

*Server should start up with saying (Found in TheIsle.log file)*:
- `[2023.09.04-19.30.16:995][ 57]LogTemp: RCON server listening at: 0.0.0.0:8888`
- `[2023.09.04-19.30.16:996][ 57]LogTemp: Queue system listening on: 0.0.0.0:10000`

*Wrong Password (but does connect):*
- `[2023.09.04-19.50.45:909][ 57]LogTemp: Warning: Unauthenticated RCON connection tried sending commands from: 0.0.0.0`
  
*Correct login information:*
- `[2023.09.04-19.51.05:470][603]LogTemp: Warning: New RCON Connection Authenticated!`

If nothing shows in TheIsle.log file, there is no connection that makes through.

**COMMAND LIST**

- Announce – Announces a message on the server and is displayed to all players.
- Update Playables – Updates the current available playable classes.
- Get Player List – Returns a list of all players as a string. (Names separated by a comma and Steam Ids separated by a comma. Names and Steam Ids are separated by > escape sequence ‘\n’ )
- Kick Player – Kicks a player by steam id.
- Ban player – Bans a player by steam id.
- Save – Saves all game data.
- togglewhitelist - Turns the server whitelist on/off.
- addwhitelist - Adds steam ids to the server whitelist.
- removewhitelist - Removes steamids from the server whitelist.




**DATA FRAMES**
```bash
RCON_AUTH 0x01
RCON_EXECCOMMAND 0x02
RCON_RESPONSE_VALUE 0x03

RCON_ANNOUNCE 0x10
RCON_UPDATEPLAYABLES 0x15
RCON_BANPLAYER 0x20
RCON_KICKPLAYER 0x30
RCON_GETPLAYERLIST 0x40
RCON_SAVE 0x50
RCON_COMMAND 0x70 (Used internally)
RCON_TOGGLEWHITELIST 0x81
RCON_ADDWHITELISTID 0x82
RCON_REMOVEWHITELISTID 0x83
```

[Documentation Link](https://docs.google.com/document/d/1JI_qVdKIZrqcVTY2Tqnm1T_Ws3_1r5nINGxfprbWw7w/edit#heading=h.p9tfb89b07jd)
