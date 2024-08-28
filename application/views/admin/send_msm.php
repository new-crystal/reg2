<?php
$phone = $users['phone'] ?? '';
$id = $users['id'] ?? '';
$registration_no = $users['registration_no'] ?? '';
$nick_name = $users['name_kor'] ?? '';
$curl = curl_init();
$error = "";

// if (substr($phone, 0, 2) == "82") {
//     $phone = '0' . substr($phone, 3);
// }
// if (substr($phone, 0, 2) == "10") {
//     $phone = '0' . $phone;
// } else {
//     $phone = $phone;
// }


curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sms.gabia.com/oauth/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "grant_type=client_credentials",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded",
        "Authorization: Basic " . base64_encode("intowebinar:a756c0edd55b504a0c4138411ad41055")
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // echo $response;
    $responseData = json_decode($response, true);
    //print_r($responseData);
    $accessToken = $responseData['access_token'];

    
    //mms 포토문자
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://sms.gabia.com/api/send/mms",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array(
            'phone' =>  $phone, 'callback' => '01030098530',
            'message' =>  '
안녕하십니까,
ICOMES 2024 (International Congress on Obesity and MEtabolic Syndrome 2024) 운영사무국 입니다.
본 학술대회에 등록해 주셔서 감사드리며, 빠르고 원활한 등록 진행을 위한 안내사항을 보내드리오니 사전에 확인 부탁드립니다. 

[ICOMES 2024] 
- 일시: 2024년 9월 5일(목) ~ 7일(토)
- 장소: 콘래드 서울 (서울특별시 영등포구 국제금융로 10)
- 오시는 길: https://icomes.or.kr/main/venue.php
                
[등록 안내]
* 등록데스크에 방문하여 어플 내, 나의 QR 코드를 제시 후 네임택을 수령 부탁드립니다.
- 등록데스크 위치: 3층, 로비 
- 등록데스크 운영시간: 9월 5일(목) 13:00 ~ / 9월 6일(금) - 7일(토) 06:30 ~
  
[기타 안내사항]
* 사전에 ICOMES 2024 어플을 설치하신 후 방문하여 주시기를 요청드립니다.
* 어플리케이션 상세 기능: 명찰 발급, 전체 프로그램 및 실시간 진행 세션 확인, 연사 정보 및 강의노트, 스탬프 투어 이벤트 참여, 초록집(PDF) 다운로드
* 참석에 필요한 모든 정보를 어플리케이션에서 확인하실 수 있습니다.
* ESG 실천을 위하여 인쇄용 초록집은 제공하지 않습니다.

-   앱스토어 또는 구글플레이 검색: ‘ICOMES’
-   애플앱스토어: https://apps.apple.com/kr/app/icomes/id6450940155
-   구글플레이: https://play.google.com/store/apps/details?id=com.intoon.icomes
 
기타 관련하여 궁금하신 사항은 운영사무국으로 연락 부탁드립니다.                 

감사합니다.
ICOMES 2024 운영사무국 드림. 

TEL:82-2-2285-2582 l E-mail: icomes@into-on.com   
', 'refkey' => 'RESTAPITEST1548722798', 'subject' => '[ICOMES 2024] 학술대회 참석 안내'
, 'image_cnt' =>'1', 'images0' => new CURLFILE('assets/images/QR/qrcode_' . $users['registration_no'] . '.jpg')
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . base64_encode("intowebinar:" . $accessToken)
            ),
        ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;

        $error = $err;
        $error = json_decode($err, true);
    } else {
        //echo $response;
        $responseData = json_decode($response, true);
        $code = $responseData['code'];
        // $after = $responseData['data']['AFTER_SMS_QTY'];
    }
}

?>
<script src="https://cdn.tailwindcss.com"></script>
<div class="w-full h-full flex items-center justify-center">
    <?php if ($code == "200" && isset($responseData['data'])) : ?>
        <div class="w-2/4 h-2/4 bg-lime-500 flex flex-col items-center justify-center">
            <h1 class="text-white font-semibold text-3xl">MMS 전송이 성공하였습니다.</h1>
            <p class="text-xl font-semibold mt-5">문자 잔여량 : <?= $responseData['data']['AFTER_SMS_QTY'] ?> </p>
            <button id="closed" class="bg-white text-lime-500 py-3 px-5 translate-y-32 font-semibold rounded">확인</button>
        </div>


    <?php endif; ?>
    <?php if ($code != "200") : ?>
        <div class="w-2/4 h-3/4 bg-orange-500 flex flex-col items-center justify-center">
            <h1 class="text-white font-semibold text-3xl">MMS 전송이 실패하였습니다.</h1>
            <p class="text-xl font-semibold mt-5"><?= $error ? $error : null ?> </p>
            <button class="bg-white bg-orange-500 p-3 font-semibold rounded">확인</button>
        </div>
    <?php endif; ?>
</div>

<script>
    const closed = document.querySelector("#closed");

    closed.addEventListener("click", () => {
        window.close()
    })

    const parentWindow = window.opener;
    const buttons = parentWindow.document.querySelectorAll('.msm_btn');
    const id = window.location.search.split("=")[1]
    const code = <?php echo $code ?>;

    buttons.forEach((button) => {
        if (code == "200") {
            if (button.dataset.id === id) {
                button.classList.remove('btn-non-success');
                button.classList.add('btn-success');
                console.log(button.classList)
            }
        }
    });
</script>