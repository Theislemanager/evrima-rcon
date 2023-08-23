<?php


namespace Theislemanager;

class RconClient {
    private $socket;
    private $host;
    private $port;
    private $password;
    private $isAuthorized = false;

    public function __construct($host, $port, $password) {
        $this->host = $host;
        $this->port = $port;
        $this->password = $password;
    }


    public function connect() {
        $this->socket = fsockopen($this->host, $this->port, $errno, $errstr, 1);

        if ($this->socket) {
            stream_set_timeout($this->socket, 3);
            return $this->authorize();
        } else {
            return false;
        }
    }


    private function authorize() {
        if (!$this->isAuthorized) {
            $this->sendPacket("\x01" . $this->password . "\x00");
            $response = $this->readPacket();
            if (strpos($response, 'Password Accepted') === false) {
                return false;
            }
            $this->isAuthorized = true;
            $this->reconnect();
            return true;
        }
    }

    private function disconnect() {
        fclose($this->socket);
    }
    private function reconnect() {
        $this->disconnect();
        $this->connect();
    }

    private function sendPacket($data) {
        fwrite($this->socket, $data);
    }

    private function readPacket() {
        return fread($this->socket, 4096);
    }
    public function sendCommand($commandName, $commandData = '') {
        $commandByteMap = [
            'announce' => 0x10,
            'updateplayables' => 0x15,
            'ban' => 0x20,
            'kick' => 0x30,
            'playerlist' => 0x40,
            'save' => 0x50,
            'custom' => 0x70,
        ];

        if (!isset($commandByteMap[$commandName])) {
            return("Unknown command: $commandName");
        }

        $commandByte = $commandByteMap[$commandName];
        $this->reconnect();

        $commandPacket = "\x02" . chr($commandByte) . $commandData . "\x00";
        $this->sendPacket($commandPacket);
        $response = $this->readPacket();
        $this->disconnect();
        return $this->getResponseForCommand($commandName, $response, $commandData);
    }

    private function getResponseForCommand($commandName, $response, $input = '') {
        switch ($commandName) {
            case 'announce':
                return "Announced: $input";
            case 'updateplayables':
                return $response;
            case 'ban':
                return "Banned: $input";
            case 'kick':
                return "Kicked: $input";
            case 'playerlist':
                return $response;
            case 'save':
                return 'Server has been saved';
            case 'custom':
                return 'Sent Command';
            default:
                return 'Unknown command';
        }
    }
}
