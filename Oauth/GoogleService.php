<?php


class GoogleService
{
    function getUserInfo($_accessToken){
        $userInfoUrl = "https://www.googleapis.com/gmail/v1/users/me/profile?access_token=".$_accessToken;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $userInfoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $result = json_decode(curl_exec($ch));
        if(curl_error($ch)){
            curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
}