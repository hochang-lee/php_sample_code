<?php

interface OauthStrategy{
    function requestLogin();
    function exchangeToToken();
}

class Oauth2{
    private ?OauthStrategy $auth = null;

    public function setAuth($_auth): void {
        if($this->auth==null){
            $this->auth = $_auth;
        }
    }

    public function requestLogin(){
        $this->auth->requestLogin();
    }

    public function exchangeToToken(){
        $this->auth->exchangeToToken();
    }

}
