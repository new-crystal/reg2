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
    print_r($responseData);
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
            'phone' =>  $phone, 'callback' => '01065492506',
            'message' =>  '
안녕하세요. 운영사무국 입니다. 청룡의 에너지 가득한 2024년 대만으로 떠나는 Kick off meeting 다가오고 있습니다. 원활한 운영을 위하여 다음과 같은 안내 드리오니, 많은 관심 부탁 드립니다.

가이드북: https://image.webeon.net/takeda/e-guide_book_240321.pdf
인천공항 미팅킷 수령장소: https://image.webeon.net/takeda/meeting_point.pdf

D-3! 모두 설레이는 마음으로 잘 준비하시고 대만에서 만나요.
', 'refkey' => 'RESTAPITEST1548722798', 'subject' => '[ICOMES 2024]'
, 'image_cnt' =>
            '1', '
             images0' => new CURLFILE('assets/images/555.jpg')
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