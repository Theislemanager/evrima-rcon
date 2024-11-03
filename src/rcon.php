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
            stream_set_timeout($this->socket, 2);
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
            return true;
        }
    }

    private function disconnect() {
        fclose($this->socket);
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
            'directmessage' => 0x11,
            'serverdetails' => 0x12,
            'wipecorpses' => 0x13,
            'updateplayables' => 0x15,
            'ban' => 0x20,
            'kick' => 0x30,
            'playerlist' => 0x40,
            'save' => 0x50,
            'getplayerdata' => 0x77,
            'togglewhitelist' => 0x81,
            'addwhitelist' => 0x82,
            'removewhitelist' => 0x83,
            'toggleglobalchat' => 0x84,
            'togglehumans' => 0x86,
            'toggleai' => 0x90,
            'disableaiclasses' => 0x91,
            'aidensity' => 0x92
        ];

        if (!isset($commandByteMap[$commandName])) {
            return("Unknown command: $commandName");
        }

        $commandByte = $commandByteMap[$commandName];

        $commandPacket = "\x02" . chr($commandByte) . $commandData . "\x00";
        $this->sendPacket($commandPacket);
        $response = $this->readPacket();
        $this->disconnect();
        return $response ?? $commandName.' Command Sent';
    }

}
