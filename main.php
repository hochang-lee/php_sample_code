<?php

function examCodeSender(){
    $codeSender = new CodeSender("127.0.0.1","3030","Biowiki");
    $codeSender->sendRestrictCode();
    //or
    $codeSender->sendUnRestrictCode();
}


//1. 로그인 요청
function examOauthPart1(){
    $domain = ucfirst(strtolower($_GET['domain']));
    setcookie('domain',$domain, time() + (86400 * 30), "/");
    $test = new Oauth2();
    $test->setAuth(new GoogleOauth());
    $test->requestLogin();
}

//1. 로그인 성공 후
//2. auth code -> access token으로 교환
//3. 구글에서 유저 정보 가져오기
//4. 도메인 내 허용된 유저인지 DB 조회
function examOauthPart2(){
    $oauth2 = new Oauth2();
    $oauth2->setAuth(new GoogleOauth());
    $tokenInfos =  $oauth2->exchangeToToken();
    $accessToken = $tokenInfos->access_token;
    if(!$accessToken){
        //error
    }
    $googleService = new GoogleService();
    $userInfo = $googleService->getUserInfo($accessToken);
    $userEmail = $userInfo->emailAddress;
    if(!$userEmail){
        //error
    }
    $userModel = new User();
    if($userModel->isAllowedUser($_COOKIE["domain"],$userEmail)){
        $_COOKIE["domain"]=null;
        //토큰 발행 + wiki로 redirect
    }else{
        header("HTTP/1.1 403 Forbidden");
    }
}
