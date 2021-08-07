<?php


class GoogleOauth implements OauthStrategy{
    private $clientId = "client_id";
    private $clientSecret = "client_secret";
    private $redirectUri = "redirect_url";

    function requestLogin(){
        $location = "https://accounts.google.com/o/oauth2/v2/auth?";
        $scope = "https://mail.google.com/";
        $accessType = "offline";
        $includeGrantedScopes = true;
        $responseType = "code";
        $state = "OK";
        header("Location:$location
            scope=$scope&
            access_type=$accessType&
            include_granted_scopes=$includeGrantedScopes&
            response_type=$responseType&
            state=$state&
            redirect_uri=".urlencode($this->redirectUri)."&
            client_id=$this->clientId"
        );
    }

    function exchangeToToken(){
        $authCode = $_GET["code"];
        if($authCode){
            $host = "oauth2.googleapis.com";
            $contentType = "application/x-www-form-urlencoded";
            $grantType = "authorization_code";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                [
                    "POST /token HTTP/1.1",
                    "Host: $host",
                    "Content-Type: $contentType"
                ]
            );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                "code=$authCode&"
                ."client_id=$this->clientId&"
                ."client_secret=$this->clientSecret&"
                ."redirect_uri=".urlencode($this->redirectUri)."&"
                ."grant_type=$grantType"
            );
            $result = json_decode(curl_exec($ch));
            if(curl_error($ch)){
                curl_error($ch);
            }
            curl_close($ch);
            return $result;
        }else{
            //error
        }
    }

}