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
echo $response;
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
ServerName="Server name here" // Server name.
MapName=Gateway
MaxPlayerCount=100 // 100+ player servers is not recommended.
bEnableHumans=false // Set to true if you want to run around with a flashlight and kick an animal.
bQueueEnabled=false // Enable queue if server slots are all filled.
QueuePort=1000 // Queue port. This port must be open if Queueing is enabled.
bServerPassword=false // Set to true if you want a server password.
ServerPassword="password here" // Your server password.
bRconEnabled=true // Enable RCON.
RconPassword="password here" // RCON password. Do not give this out.
RconPort=5555
bServerDynamicWeather=true // Temporarily disabled. Changing this will do nothing.
ServerDayLengthMinutes=45 // Set in minutes.
ServerNightLengthMinutes=20 // Set in minutes.
bServerWhitelist=false // Set the server whitelist. If true, will look for whitelistID's in the above category.
bEnableGlobalChat=false // Enabling the Global Chat panel.
bSpawnPlants=true // Enable plant food spawns.
bSpawnAI=true // Enable AI spawns.
AISpawnInterval=40 // Set how frequently AI can spawn in seconds.
bEnableMigration=true // Enable patrol zones, species migrations, and mass migrations.
MaxMigrationTime=5400 // Value is in seconds. This controls how long the migration zones should last.
GrowthMultiplier=1 - Universal multiplier for growth. Putting this number too high will break it. Recommendation is no higher than 20, even for lulz.
bEnableMutations=true // Enable mutations.

[/Script/TheIsle.TIGameStateBase]
AdminsSteamIDs=Admin steam ID here // SteamID64 format
WhitelistIDs=White list steam ID here // SteamID64 format. NOTE: Must be enabled in the game session below. Keep this empty if whitelist is disabled
// List of all enabled classes. Remove a line to remove a class from spawning. - Can also be managed in Admin Panel in real time.
AllowedClasses=Hypsilophodon
AllowedClasses=Pachycephalosaurus
AllowedClasses=Stegosaurus
AllowedClasses=Tenontosaurus
AllowedClasses=Carnotaurus
AllowedClasses=Ceratosaurus
AllowedClasses=Deinosuchus
AllowedClasses=Diabloceratops
AllowedClasses=Omniraptor
AllowedClasses=Pteranodon
AllowedClasses=Troodon
AllowedClasses=Beipiaosaurus
AllowedClasses=Gallimimus
AllowedClasses=Dilophosaurus
AllowedClasses=Herrerasaurus

// List of all enabled mutations and values. Keep commented out to have all mutations enabled. Enabling any mutations means you must include all mutations you would like available on your server. Listed below are all modifiable mutations with default values. Altering these values may produce unstable gameplay.
// EnabledMutations=(MutationName=Hemomania,EffectValue=0.05)
// EnabledMutations=(MutationName=Hematophagy,EffectValue=0.25)
// EnabledMutations=(MutationName=Accelerated Prey Drive,EffectValue=0.1)
// EnabledMutations=(MutationName=Xerocole Adaptation,EffectValue=0.2)
// EnabledMutations=(MutationName=Hypervigilance,EffectValue=0.5)
// EnabledMutations=(MutationName=Truculency,EffectValue=0.2)
// EnabledMutations=(MutationName=Osteophagic,EffectValue=0.15)
// EnabledMutations=(MutationName=Photosynthetic Regeneration,EffectValue=0.1)
// EnabledMutations=(MutationName=Cellular Regeneration,EffectValue=0.15)
// EnabledMutations=(MutationName=Advanced Gestation,EffectValue=0.5)
// EnabledMutations=(MutationName=Sustained Hydration,EffectValue=0.2)
// EnabledMutations=(MutationName=Enlarged meniscus,EffectValue=0.15)
// EnabledMutations=(MutationName=Efficient Digestion,EffectValue=0.2)
// EnabledMutations=(MutationName=Featherweight EffectValue=0.5)
// EnabledMutations=(MutationName=Osteosclerosis,EffectValue=0.2)
// EnabledMutations=(MutationName=Wader,EffectValue=0.25)
// EnabledMutations=(MutationName=Epidermal Fibrosis,EffectValue=0.15)
// EnabledMutations=(MutationName=Congenital Hypoalgesia,EffectValue=0.15)
// EnabledMutations=(MutationName=Photosynthetic Tissue,EffectValue=0.05)
// EnabledMutations=(MutationName=Nocturnal,EffectValue=0.05)
// EnabledMutations=(MutationName=Hydroregenerative,EffectValue=0.25)
// EnabledMutations=(MutationName=Increased Inspiratory Capacity,EffectValue=0.15)
// EnabledMutations=(MutationName=Hydrodynamic,EffectValue=0.15)
// EnabledMutations=(MutationName=Submerged Optical Retention,EffectValue=0.05)
// EnabledMutations=(MutationName=Infrasound Communication,EffectValue=0.5)
// EnabledMutations=(MutationName=Augmented Tapetum,EffectValue=0.5)
// EnabledMutations=(MutationName=Hypermetabolic Inanition,EffectValue=0.15)
// EnabledMutations=(MutationName=Tactile Endurance,EffectValue=0.5)
// EnabledMutations=(MutationName=Gastronomic Regeneration,EffectValue=0.1)
// EnabledMutations=(MutationName=Heightened Ghrelin,EffectValue=0.25)
// EnabledMutations=(MutationName=Prolific Reproduction,EffectValue=0.1)
// EnabledMutations=(MutationName=Enhanced Digestion,EffectValue=0.1)
// EnabledMutations=(MutationName=Reinforced Tendons,EffectValue=0.1)
// EnabledMutations=(MutationName=Multichambered Lungs,EffectValue=0.05)
// EnabledMutations=(MutationName=Reabsorption,EffectValue=1) ****** // Value must be 1 or remove from this list to disable it.
// EnabledMutations=(MutationName=Cannibalistic,EffectValue=1) ******// Value must be 1 or remove from this list to disable it.
// EnabledMutations=(MutationName=Barometric Sensitivity,EffectValue=1) ******// Value must be 1 or remove from this list to disable it.
// EnabledMutations=(MutationName=Social Behavior,EffectValue=1) *****// Value must be 1 or remove from this list to disable it.
// EnabledMutations=(MutationName=Traumatic Thrombosis,EffectValue=1) *****// Value must be 1 or remove from this list to disable it.
// EnabledMutations=(MutationName=Reniculate Kidneys,EffectValue=1) *****// Value must be 1 or remove from this list to disable it.

// Add the names of each AI class that should be disabled, one line for each.
// DisallowedAIClasses=Compsognathus
// DisallowedAIClasses=Pterodactylus
// DisallowedAIClasses=Boar
// DisallowedAIClasses=Deer
// DisallowedAIClasses=Goat
// DisallowedAIClasses=Seaturtle
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

If nothing shows in `TheIsle-Shipping.log` file, there is no connection that makes through.

**COMMAND LIST**

- Announce – Announces a message on the server and is displayed to all players.
- Update Playables – Updates the current available playable classes.
- Get Player List – Returns a list of all players as a string.
- Kick Player – Kicks a player by player id.
- Ban player – Bans a player by player id.
- Save – Saves all game data.
- Toggle Whitelist - Turns the server whitelist on/off
- Add Whitelist IDs - Adds player id to the server whitelist
- Remove Whitelist IDs - Removes player ids from the server whitelist
- Direct Message - Send a message as an announcement to a player
- Get server details - Retrieves all the current server settings.
- Update playables - Modifies the playable classes.
- Get player data - Retrieves some info about each player like location,character stats etc..
- Toggle global chat - Turns global chat on/off
- Toggle humans - Turns humans on/off
- Toggle AI - Turns AI spawns on/off
- Disable AI classes - Updates the allowable AI spawn list.
- AI Density - Adjusts the AI spawn density
- Wipe Corpses - Wipes corpses





**DATA FRAMES**
```bash
RCON_AUTH 0x01
RCON_EXECCOMMAND 0x02
RCON_RESPONSE_VALUE 0x03

RCON_ANNOUNCE 0x10
RCON_DIRECTMESSAGE 0x11
RCON_SERVERDETAILS  0x12
RCON_UPDATEPLAYABLES 0x15
RCON_BANPLAYER 0x20
RCON_KICKPLAYER 0x30
RCON_GETPLAYERLIST 0x40
RCON_SAVE 0x50
RCON_GETPLAYERDATA 0x77
RCON_TOGGLEWHITELIST 0x81
RCON_ADDWHITELISTID 0x82
RCON_REMOVEWHITELISTID 0x83
RCON_TOGGLEGLOBALCHAT 0x84
RCON_TOGGLEHUMANS 0x86
RCON_TOGGLEAI 0x90
RCON_DISABLEAICLASSES 0x91
RCON_AIDENSITY 0x92
RCON_WIPECORPSES 0x13
```

[Documentation Link](https://docs.google.com/document/d/1JI_qVdKIZrqcVTY2Tqnm1T_Ws3_1r5nINGxfprbWw7w/edit#heading=h.p9tfb89b07jd)
