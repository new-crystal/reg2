<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    
    body {
        font-family: 'Roboto', sans-serif;
    }
    
    .container{
        width:100%;
        height:100%;
        padding-left : 5%;
        padding-right : 5%;
    }
    .person{
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 1px solid orangered;    
    }

    .person_input, .phone_input{
        padding: 4px 16px;
        /* border-radius: 8px; */
        border: 1px solid #ddd;
        margin-top: 8px;
    }

    .person_input:focus, .phone_input:focus{
        outline: none;
    }

    .btn_box{
  
    }

    .btn_box > button{
        padding: 8px 16px;
    }

</style>
<div class="container">
    <?php 
        //print_r($users);
        for($i=1; $i<=6; $i++){ 
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
                $part_time = "13:00 - 14:00";
                $detail_time1 = "13:00 - 13:20";
                $detail_time2 = "13:20 - 13:40";
                $detail_time3 = "13:40 - 14:00";
            }
            else if($part == 4){
                $part_time = "14:00 - 15:00";
                $detail_time1 = "14:00 - 14:20";
                $detail_time2 = "14:20 - 14:40";
                $detail_time3 = "14:40 - 15:00";
            }
            else if($part == 5){
                $part_time = "15:00 - 16:00";
                $detail_time1 = "15:00 - 15:20";
                $detail_time2 = "15:20 - 15:40";
                $detail_time3 = "15:40 - 16:00";
            }
            else if($part == 6){
                $part_time = "16:00 - 17:00";
                $detail_time1 = "16:00 - 16:20";
                $detail_time2 = "16:20 - 16:40";
                $detail_time3 = "16:40 - 17:00";
            }       
            ?>
        <form class="flex flex-col items-start justify-center mt-10">
            <div class="font-bold text-4xl underline underline-offset-4">Part <?php echo $part;?> <?php echo $part_time; ?></div>
            
            <div class="flex flex-col items-start">
                <div class="w-5/6 flex items-center justify-start mt-10">
                    <p class="text-xl my-10">• <?php echo $detail_time1; ?></p>
                    <div class="btn_box ml-20">
                        <button class="bg-cyan-400 text-white font-bold reservation" data-id="<?php echo substr($detail_time1, 0, 5); ?>" data-part="<?php echo $part;?>">예약하기</button>
                        <button type="button" class="bg-orange-600 text-white font-bold cancel" data-id="<?php echo substr($detail_time1, 0, 5); ?>" data-part="<?php echo $part;?>">취소하기</button>
                    </div>
                </div>

                <div class="flex items-center justify-center *:mx-10 *:flex *:flex-col *:items-center *:justify-between *:h-52">
                    <?php 
                    // 4개의 input을 생성
                    for ($j = 1; $j <= 4; $j++) {
                        // 기본값 설정
                        $nickname = "";
                        $phone = "";
                        $disabled = "";

                        // $users 배열에서 일치하는 값 찾기
                        foreach ($users as $user) {
                            if ($user['time_id'] == substr($detail_time1, 0, 5) && $user['location'] == $j && $user['part'] == $part) {
                                $nickname = $user['nickname'];
                                $phone = $user['phone'];
                                $disabled = "disabled";  // 일치하는 값이 있으면 input을 disabled 처리
                                break;
                            }
                        }
                    ?>
                    <div>
                        <div class="person"></div>
                        <input class="person_input" placeholder="예약자 성함" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time1, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                        <input class="phone_input" placeholder="예약자 휴대폰 번호" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time1, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                        <button type="button" class="msm_btn bg-green-600 font-bold px-4 py-2 text-white mt-2" data-id="<?php echo $j; ?>" <?php echo $disabled; ?>>문자발송</button>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <!-- 동일한 구조를 detail_time2, detail_time3에도 적용 -->
            <div class="flex flex-col items-start">
                <div class="w-5/6 flex items-center justify-start mt-10">
                    <p class="text-xl my-10">• <?php echo $detail_time2; ?></p>
                    <div class="btn_box ml-20">
                        <button class="bg-cyan-400 text-white font-bold reservation" data-id="<?php echo substr($detail_time2, 0, 5); ?>" data-part="<?php echo $part;?>">예약하기</button>
                        <button type="button" class="bg-orange-600 text-white font-bold cancel" data-id="<?php echo substr($detail_time2, 0, 5); ?>" data-part="<?php echo $part;?>">취소하기</button>
                    </div>
                </div>
                <div class="flex items-center justify-center *:mx-10 *:flex *:flex-col *:items-center *:justify-between *:h-52">
                    <?php 
                    for ($j = 1; $j <= 4; $j++) {
                        $nickname = "";
                        $phone = "";
                        $disabled = "";

                        foreach ($users as $user) {
                            if ($user['time_id'] == substr($detail_time2, 0, 5) && $user['location'] == $j && $user['part'] == $part) {
                                $nickname = $user['nickname'];
                                $phone = $user['phone'];
                                $disabled = "disabled";
                                break;
                            }
                        }
                    ?>
                    <div>
                        <div class="person"></div>
                        <input class="person_input" placeholder="예약자 성함" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time2, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                        <input class="phone_input" placeholder="예약자 휴대폰 번호" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time2, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                        <button type="button" class="msm_btn bg-green-600 font-bold px-4 py-2 text-white mt-2" data-id="<?php echo $j; ?>" <?php echo $disabled; ?>>문자발송</button>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-col items-start mb-10">
                <div class="w-5/6 flex items-center justify-start mt-10">
                    <p class="text-xl my-10">• <?php echo $detail_time3; ?></p>
                    <div class="btn_box ml-20">
                        <button class="bg-cyan-400 text-white font-bold reservation" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time3, 0, 5); ?>" data-part="<?php echo $part;?>">예약하기</button>
                        <button type="button" class="bg-orange-600 text-white font-bold cancel" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time3, 0, 5); ?>" data-part="<?php echo $part;?>">취소하기</button>
                    </div>
                </div>
                <div class="flex items-center justify-center *:mx-10 *:flex *:flex-col *:items-center *:justify-between *:h-52">
                    <?php 
                    for ($j = 1; $j <= 4; $j++) {
                        $nickname = "";
                        $phone = "";
                        $disabled = "";

                        foreach ($users as $user) {
                            if ($user['time_id'] == substr($detail_time3, 0, 5) && $user['location'] == $j && $user['part'] == $part) {
                                $nickname = $user['nickname'];
                                $phone = $user['phone'];
                                $disabled = "disabled";
                                break;
                            }
                        }
                    ?>
                    <div>
                        <div class="person"></div>
                        <input class="person_input" placeholder="예약자 성함" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time3, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                        <input class="phone_input" placeholder="예약자 휴대폰 번호" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time3, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                        <button type="button" class="msm_btn bg-green-600 font-bold px-4 py-2 text-white mt-2" data-id="<?php echo $j; ?>" <?php echo $disabled; ?>>문자발송</button>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </form>
    
    <?php
        }
    ?>  
</div>


<script>
    const reservationBtnList = document.querySelectorAll(".reservation");
    const cancelBtnList = document.querySelectorAll(".cancle");

//     reservationBtnList.forEach((reBtn) => {
//     reBtn.addEventListener("click", (e) => {
//         let reservations = [];
//         e.preventDefault();
//         // 버튼의 data-id를 기준으로 같은 ID를 가진 입력 필드를 찾음
//         const timeId = e.target.dataset.id;
//         const part = e.target.dataset.part;
//         const personInputs = document.querySelectorAll(`.person_input`);
//         const phoneInputs = document.querySelectorAll(`.phone_input`);
        
//         personInputs.forEach((personInput, index) => {
//         const phoneInput = phoneInputs[index]; // 동일 인덱스의 휴대폰 필드를 매칭

//         if (personInput.value && phoneInput.value) {  // 값이 있는지 확인
//             reservations.push({
//                 part:part,
//                 name: personInput.value, 
//                 phone: phoneInput.value, 
//                 location: personInput.getAttribute('data-id')  // data-id를 location으로 사용
//             });
//         }
//     });

//     const data = {
//         time_id : timeId,
//         reservations: reservations
//     }
   
//      postData(data);

//     });
// });

//     function postData(data) {
//         $.ajax({
//             url: "/reservation/post_name",
//             type: "POST",
//             data: JSON.stringify(data),
//             dataType: "JSON",
//             contentType: "application/json",
//             success: function(res) {
//                 console.log(res.status);
//             },
//             error: function(err) {
//                 console.log(err);
//             }
//         });
//     }

    reservationBtnList.forEach((reBtn) => {
        reBtn.addEventListener("click", (e) => {
            let reservations = [];
            e.preventDefault();
            
            // 버튼의 data-id와 data-part를 가져옴
            const timeId = e.target.dataset.id;
            const part = e.target.dataset.part;

            // 해당 time_id에 해당하는 입력 필드만 가져오기 (data-id가 timeId와 일치하는 입력 필드)
            const personInputs = document.querySelectorAll(`.person_input[data-idx="${timeId}"][data-part="${part}"]`);
            const phoneInputs = document.querySelectorAll(`.phone_input[data-idx="${timeId}"][data-part="${part}"]`);

            personInputs.forEach((personInput, index) => {
                const phoneInput = phoneInputs[index]; // 동일 인덱스의 휴대폰 필드를 매칭

                if (personInput.value && phoneInput.value) {  // 값이 있는지 확인
                    reservations.push({
                        part: part,
                        name: personInput.value, 
                        phone: phoneInput.value, 
                        location: personInput.getAttribute('data-id')  // data-id를 location으로 사용
                    });
                }
            });

            // if (reservations.length === 0) {
            //     alert("빈 필드가 있습니다. 모든 필드를 입력해 주세요.");
            //     return;
            // }

            const data = {
                time_id: timeId,  // 현재 클릭한 버튼의 time_id
                reservations: reservations
            }
        
            postData(data);  // 서버로 데이터 전송
        });
    });

    function postData(data) {
        $.ajax({
            url: "/reservation/post_name",
            type: "POST",
            data: JSON.stringify(data),
            dataType: "JSON",
            contentType: "application/json",
            success: function(res) {
                console.log(res.status);
            },
            error: function(err) {
                console.log(err);
            }
        });
    }
</script>