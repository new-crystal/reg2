<?php
$curl = curl_init();
$code = "222";
$after = "0";
$success = 0;
$failed = 0;

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
    $responseData = json_decode($response, true);
    $accessToken = $responseData['access_token'];
    foreach ($users as $item) {
        // echo $item['phone'];
        // MMS 포토문자
        // if (substr($item['phone'], 0, 2) == "82") {
        //     $phone = '0' . substr($item['phone'], 3);
        // }
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
                'phone' =>  $item['phone'],
                'callback' => '01065492506',
                'message' =>  '
안녕하십니까,
제59차 대한비만학회 춘계학술대회 운영사무국 입니다. 

금일 고객사 점심 식사는 11시 30분부터 아트홀(4층)에서 준비해 드릴 예정이오니, 등록하신 명찰 지참 하시어 식사장으로 이동해 주시면 감사하겠습니다.

감사합니다.
운영사무국 드림. 
                
', 'refkey' => 'RESTAPITEST1548722798', 'subject' => '고객사 점심 식사 안내'
// , 'image_cnt' =>'1', 'images0' => new CURLFILE('assets/images/QR/qrcode_' . $item['registration_no'] . '.jpg')
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
            // echo $response;
            $responseData = json_decode($response, true);
            $code = $responseData['code'];
            $after = $responseData['data']['AFTER_SMS_QTY'];
            if ($code == "200") {
                $success = $success + 1;
            } else {
                $failed =  $failed + 1;
            }
        }
    }
}

?>
<script src="https://cdn.tailwindcss.com"></script>
<div class="w-full h-full flex items-center justify-center">
    <div class="w-2/4 h-2/4 bg-lime-500 flex flex-col items-center justify-center">
        <h1 class="text-white font-semibold text-3xl">MMS 전송이 성공하였습니다.</h1>
        <p class="text-xl font-semibold mt-5">성공 : <?= $success ?> </p>
        <p class="text-xl font-semibold mt-5">실패 : <?= $failed ?> </p>
        <p class="text-xl font-semibold mt-5">문자 잔여량 : <?= $after ?> </p>
        <a href="/admin/qr_user"><button class="bg-white text-lime-500 p-3 translate-y-32 font-semibold rounded">뒤로
                가기</button></a>
    </div>

</div>