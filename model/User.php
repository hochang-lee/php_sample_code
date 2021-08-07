<?php


class User
{
    private $connection = null;

    function __construct(){
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "wiki_db";
        $this->connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }


    function isAllowedUser($_domainName, $_userEmail) : bool{
        //DB내에서 해당 도메인 내 접속 가능한 유저 인지 확인
        return true;
    }

}