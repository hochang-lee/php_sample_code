샘플 코드 타겟 url : https://www.notion.so/cacba48774af4b00b467015717ec4e1b

위의 url에 기재된 기능 구현시 사용되었던 코드의 샘플 버전입니다.

샘플 코드 내 보안상 문제의 여지가 있는 부분에 대해서는 일부 생략 또는 완전 생략하여 구현하였습니다.

부연 설명 : 해당 기능은 JWT을 구축하는 아키텍처를 제대로 이해하지 못하고 잘못 활용해 만든 기능이라고 생각합니다.
그래서 여기서의 토큰은 인증된(유효한) 유저를 구별하는 값 정도로 봐주시면 감사하겠습니다.

예시 코드 : main.php 내에서 확인 할 수 있습니다.

[디렉토리]
code : 특정 도메인에 대한 제한 설정 및 해제시 사용되는 파일을 모아둔 디렉토리입니다.
model : 모델 클래스를 모아둔 디렉토리입니다.
Oauth : Oauth 관련 파일을 모아둔 디렉토리입니다.

[파일]
CodeSender.php : 해당 도메인에 허용된 유저만 접속하도록 설정 or 해제에 필요한 코드를 전송하는 클래스입니다.
RestrictCode.php : 허용된 유저만 접속할 수 있게 인증을 체크하는 코드가 든 파일입니다.
UnRestrictCode.php : 제한 해제시 보낼 코드가 든 파일입니다.

User.php : User 테이블에 접근하는 클래스입니다.

Oauth2.php : Oauth 객체를 생성하는 클래스입니다.
GoogleOauth : GoogleOauth 객체를 생성하는 클래스입니다.
GoogleService : 구글 내에서 액세스 토큰을 가지고 활용할 수 있는 서비스를 담고 있는 클래스입니다.