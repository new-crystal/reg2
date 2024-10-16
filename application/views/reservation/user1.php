<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>예약 시스템</title>

<style>
     
     body {
        font-family: 'Roboto', sans-serif;
        background-color: #0D0803;
    }

    .reservation_header{
        position: absolute;
        top: 392px;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .reservation_time{
        width: 180px;
        height: 85px;
        background-image: url("/assets/images/reservation_time.png");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 20px;
        font-style: italic;
    }

    .reservation_body{
        width: 1080px;
        height: 1320px;
        background-color: #FFF;
        border-radius: 40px;
        position: absolute;
        top:542px;
        left: 50%;
        transform: translateX(-50%);
        padding: 40px 80px;
    }

    .detail_time{
        font-size: 35px;
        font-style: italic;
        font-weight: bold;
        margin-bottom: 48px;
    }

    .person{
        width:130px;
        height: 100px;
        background-image: url("/assets/images/reservation_headphone.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        font-size: 85px;
        font-weight: bold;
        text-align: center;
        color:#000000;
    }

    .disabled{
        background-image: url("/assets/images/reservation_disabled.png");
        color: #B4B4B4;
    }

    .person_input, .phone_input{
        width:213px;
        height: 40px;
        background-color: #F1F3FF;
        border-radius: 14px;
        padding: 12px 46px 12px 8px;
    }

    .person_input{
        background-image: url("/assets/images/person_input.png");
        background-position: 13px center;
        background-size: 18px 22px;
        background-repeat: no-repeat;
    }
</style>

<div class="w-full h-full bg-[#0D0803]">
    <img src="/assets/images/reservation_header.png" class="mx-auto"/>
    
    <div class="w-[905px] flex items-center justify-between mx-auto reservation_header">
        <div class="reservation_time">
            10:00~11:00        
        </div>
        <div class="reservation_time">
            11:00~12:00     
        </div>
        <div class="reservation_time">
            14:00~15:00        
        </div>
        <div class="reservation_time">
            15:00~16:00
        </div>
        <div class="reservation_time">
            16:00~17:00
        </div>
    </div>

    <div class="reservation_body">
    <?php 
        //print_r($users);
        for($i=1; $i<=5; $i++){ 
            $part = $i;
            $part_time = "";
            $detail_time1 = "";
            $detail_time2 = "";
            $detail_time3 = "";

            if($part == 1){
                $part_time = "10:00 - 11:00";
                $detail_time1 = "10:00 - 10:20";
                $detail_time2 = "10:20 - 10:40";
                $detail_time3 = "10:40 - 11:00";
            }
            else if($part == 2){
                $part_time = "11:00 - 12:00";
                $detail_time1 = "11:00 - 11:20";
                $detail_time2 = "11:20 - 11:40";
                $detail_time3 = "11:40 - 12:00";
            }
            else if($part == 3){
                $part_time = "14:00 - 15:00";
                $detail_time1 = "14:00 - 14:20";
                $detail_time2 = "14:20 - 14:40";
                $detail_time3 = "14:40 - 15:00";
            }
            else if($part == 4){
                $part_time = "15:00 - 16:00";
                $detail_time1 = "15:00 - 15:20";
                $detail_time2 = "15:20 - 15:40";
                $detail_time3 = "15:40 - 16:00";
            }
            else if($part == 5){
                $part_time = "16:00 - 17:00";
                $detail_time1 = "16:00 - 16:20";
                $detail_time2 = "16:20 - 16:40";
                $detail_time3 = "16:40 - 17:00";
            }       
            ?>
             <form class="flex flex-col items-start justify-center">

            <div class="flex flex-col items-start">
                <div class="w-5/6 flex items-center justify-start">
                    <p class="detail_time"><?php echo $detail_time1; ?></p>
                </div>

                <div class="w-[920px] flex items-center justify-between *:flex *:flex-col *:items-center *:justify-between">
                    <?php 
                    // 4개의 input을 생성
                    for ($j = 1; $j <= 4; $j++) {
                        // 기본값 설정
                        $nickname = "";
                        $phone = "";
                        $disabled = "";
                        $checked = "";

                        foreach ($users as $user) {
                            if($user['chk_msm'] == 'Y'){
                                $checked = "bg-rose-600 text-white";
                            }else{
                                $checked = "bg-green-600 text-white";
                            }
                            if ($user['time_id'] == substr($detail_time1, 0, 5) && $user['location'] == $j && $user['part'] == $part && $user['nickname']) {
                                $nickname = $user['nickname'];
                                $phone = $user['phone'];
                                $disabled = "disabled";  // 일치하는 값이 있으면 input을 disabled 처리
                                break;
                            }
                        }
                    ?>
                    <div class="w-[210px] h-[255px]">
                        <div class="person <?php echo $disabled; ?>">
                            <?php echo $j ?>
                        </div>
                        <input class="person_input" placeholder="예약자 성함" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time1, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                        <input class="phone_input" placeholder="예약자 휴대폰 번호" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time1, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-col items-start">
                <div class="w-5/6 flex items-center justify-start mt-10">
                    <p class="detail_time"><?php echo $detail_time2; ?></p>
                </div>
                <div class="flex items-center justify-center *:mx-10 *:flex *:flex-col *:items-center *:justify-between *:h-52">
                    <?php 
                    for ($j = 1; $j <= 4; $j++) {
                        $nickname = "";
                        $phone = "";
                        $disabled = "";
                        $checked = "";

                        foreach ($users as $user) {
                            if($user['chk_msm'] == 'Y'){
                                $checked = "bg-rose-600 text-white";
                            }else{
                                $checked = "bg-green-600 text-white";
                            }

                            if ($user['time_id'] == substr($detail_time2, 0, 5) && $user['location'] == $j && $user['part'] == $part && $user['nickname']) {
                                $nickname = $user['nickname'];
                                $phone = $user['phone'];
                                $disabled = "disabled";
                                break;
                            }
                        }
                    ?>
                    <div>
                        <div class="person <?php echo $disabled; ?>"></div>
                        <input class="person_input" placeholder="예약자 성함" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time2, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                        <input class="phone_input" placeholder="예약자 휴대폰 번호" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time2, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-col items-start mb-10">
                <div class="w-5/6 flex items-center justify-start mt-10">
                    <p class="detail_time"><?php echo $detail_time3; ?></p>
                </div>
                <div class="flex items-center justify-center *:mx-10 *:flex *:flex-col *:items-center *:justify-between *:h-52">
                    <?php 
                    for ($j = 1; $j <= 4; $j++) {
                        $nickname = "";
                        $phone = "";
                        $disabled = "";
                        $checked = "";

                        foreach ($users as $user) {
                            if($user['chk_msm'] == 'Y'){
                                $checked = "bg-rose-600 text-white";
                            }else{
                                $checked = "bg-green-600 text-white";
                            }

                            if ($user['time_id'] == substr($detail_time3, 0, 5) && $user['location'] == $j && $user['part'] == $part && $user['nickname']) {
                                $nickname = $user['nickname'];
                                $phone = $user['phone'];
                                $disabled = "disabled";
                               
                                break;
                            }
                        }
                    ?>
                    <div>
                        <div class="person <?php echo $disabled; ?>"></div>
                        <input class="person_input" placeholder="예약자 성함" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time3, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                        <input class="phone_input" placeholder="예약자 휴대폰 번호" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time3, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </form>
    
    <?php
        }
    ?>  
    </div>


</div>