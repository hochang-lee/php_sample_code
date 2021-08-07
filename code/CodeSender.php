<?php
class CodeSender{
    private $serverIp = "";
    private $port = "";
    private $domainName = "";
    private $sshConnection = null;
    private $serverID = "root";
    private $serverPW = "1234";
    private $restrictSource = "RestrictCode.php";
    private $unRestrictSource = "UnRestrictCode.php";

    function __construct($_serverIp,$_port,$_domainName){
        $this->serverIp = $_serverIp;
        $this->port = $_port;
        $this->domainName = $_domainName;
    }

    function setServerID($_serverID){ $this->serverID = $_serverID; }
    function setServerPW($_serverPW){ $this->serverPW = $_serverPW; }

    private function setSshConnection(){
        if($this->sshConnection = ssh2_connect($this->serverIp,$this->port) == false){
            //error
        }
        if(!ssh2_auth_password($this->sshConnection,$this->serverID,$this->serverPW)){
            //error
        }
        ssh2_sftp($this->sshConnection);
    }

    private function send($source) : bool{
        $this->setSshConnection();
        $sftpBase = "ssh2.sftp://";
        $wikiBaseUri = "/BiO/Serve/Httpd/".$this->domainName;
        $wikiRestrictSource = "/Biowiki/restrict/index.php";
        $sftp = $sftpBase.$this->sshConnection;
        $dest = $sftp.$wikiBaseUri.$wikiRestrictSource;
        return copy($source,$dest);
    }

    function sendRestrictCode() : bool{
        return $this->send($this->restrictSource);
    }

    function sendUnRestrictCode() : bool{
        return $this->send($this->unRestrictSource);
    }

}