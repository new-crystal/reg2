<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>예약 시스템 day 4</title>

<style>
      body {
        font-family: 'Roboto', sans-serif;
        background-color: #000000;
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
        cursor:pointer;
    }

    .selected{
        background-image: url("/assets/images/reservation_time_selected.png");
    }

    .reservation_body{
        width: 1080px;
        height: 1302px;
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
        font-weight: 900;
        margin-right: 12px;
    }

    .person{
        width:120px;
        height: 122px;
        background-image: url("/assets/images/sound-1.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        font-size: 75px;
        font-weight: bold;
        text-align: center;
        color:#FFF;
    }

    .disabled{
        /* background-image: url("/assets/images/reservation_disabled.png"); */
        color: #898989;
    }

    .person_input, .phone_input{
        width:213px;
        height: 40px;
        background-color: #F1F3FF;
        border-radius: 14px;
        padding: 12px 4px 12px 8px;
        font-weight: bold;
    }

    .person_input{
        background-image: url("/assets/images/person_input.png");
        background-position: 13px center;
        background-size: 18px 22px;
        background-repeat: no-repeat;
        text-indent: 30px;
    }


    .phone_input{
        background-image: url("/assets/images/phone_input.png");
        background-position: 14px center;
        background-size: 13px 28px;
        background-repeat: no-repeat;
        text-indent: 30px;
    }

    .person_input:focus, .phone_input:focus{
        outline: none;
    }

    .reservation_btn{
        width: 364px;
        height: 67px;
        background-color: #000000;
        border:1px solid #707070;
        color:#FFF;
        border-radius: 34px;
        /* position: absolute;
        bottom:30px;
        left: 50%;
        transform: translateX(-50%); */
        display: block;
        margin : 0 auto 20px auto;
        font-size:25px;
        font-weight: bold;
    }

    .reservation_btn:hover{
        background-color: #B4B4B4;
    }

    .person_input.disabled, .phone_input.disabled{
        background-color: #eee;
    }

    input::placeholder{
        font-weight: bold;
    }

    .reload{
        width:1000px;
        height: 300px;
        position: absolute;
        top:0;
    }
</style>

<div class="w-[1080px] h-[1920px] mx-auto bg-[#000000] overflow-hidden">
    <img src="/assets/images/reservation_header-2.png" class="mx-auto"/>
    <div class="reload"></div>
    <div class="w-[905px] flex items-center justify-between mx-auto reservation_header">
        <div class="reservation_time" data-id="1">
            10:00~11:00
        </div>
        <div class="reservation_time" data-id="2">
            11:00~12:00     
        </div>
        <div class="reservation_time" data-id="3">
            14:00~15:00        
        </div>
        <div class="reservation_time" data-id="4">
            15:00~16:00
        </div>
        <div class="reservation_time" data-id="5">
            16:00~17:00
        </div>
    </div>

    <div class="reservation_body">
        <div>
            <button class="reservation_btn">예약하기</button>
        </div>  
        <?php 
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
                <div class="w-full flex items-center justify-center mb-[30px]">
                    <p class="detail_time"><?php echo $detail_time1; ?></p>
                    <img src="/assets/images/time_dot.png"/>        
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
                                $nickname = mb_substr($user['nickname'], 0, 1) . '*' .mb_substr($user['nickname'], -1);
                                $phone = substr($user['phone'], 0, 3) . '****'.substr($user['phone'], -4);
                                $disabled = "disabled";  // 일치하는 값이 있으면 input을 disabled 처리
                                break;
                            }
                        }
                    ?>
                     <div class="w-[213px] h-[222px] mb-[78px]">
                        <div class="person <?php echo $disabled; ?>">
                            <?php echo $j ?>
                        </div>
                        <div class="h-[85px] flex flex-col items-center justify-between">
                            <input class="person_input <?php echo $disabled; ?>" placeholder="Your username" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time1, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                            <input class="phone_input <?php echo $disabled; ?>" placeholder="Your phone number" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time1, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-col items-start">
                <div class="w-full flex items-center justify-center mb-[30px]">
                    <p class="detail_time"><?php echo $detail_time2; ?></p>
                    <img src="/assets/images/time_dot.png"/>        
                </div>
                <div class="w-[920px] flex items-center justify-between *:flex *:flex-col *:items-center *:justify-between">
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
                                $nickname = mb_substr($user['nickname'], 0, 1) . '*' .mb_substr($user['nickname'], -1);
                                $phone = substr($user['phone'], 0, 3) . '****'.substr($user['phone'], -4);
                                $disabled = "disabled";
                                break;
                            }
                        }
                    ?>
                      <div class="w-[213px] h-[222px] mb-[78px]">
                        <div class="person <?php echo $disabled; ?>">
                            <?php echo $j ?>
                        </div>
                        <div class="h-[85px] flex flex-col items-center justify-between">
                            <input class="person_input <?php echo $disabled; ?>" placeholder="Your username" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time2, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                            <input class="phone_input <?php echo $disabled; ?>" placeholder="Your phone number" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time2, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-col items-start mb-10">
                <div class="w-full flex items-center justify-center mb-[30px]">
                    <p class="detail_time"><?php echo $detail_time3; ?></p>
                    <img src="/assets/images/time_dot.png"/>        
                </div>
                <div class="w-[920px] flex items-center justify-between *:flex *:flex-col *:items-center *:justify-between">
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
                                $nickname = mb_substr($user['nickname'], 0, 1) . '*' .mb_substr($user['nickname'], -1);
                                $phone = substr($user['phone'], 0, 3) . '****'.substr($user['phone'], -4);
                                $disabled = "disabled";
                               
                                break;
                            }
                        }
                    ?>
                     <div class="w-[213px] h-[222px] mb-[78px]">
                        <div class="person <?php echo $disabled; ?>">
                            <?php echo $j ?>
                        </div>
                        <div class="h-[85px] flex flex-col items-center justify-between">
                            <input class="person_input <?php echo $disabled; ?>" placeholder="Your username" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time3, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $nickname; ?>" <?php echo $disabled; ?>/>
                            <input class="phone_input <?php echo $disabled; ?>" placeholder="Your phone number" data-id="<?php echo $j ?>" data-idx="<?php echo substr($detail_time3, 0, 5); ?>" data-part="<?php echo $part; ?>" value="<?php echo $phone; ?>" <?php echo $disabled; ?>/>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </form> 
    </div>

              
</div>


<script>
    const timeList = document.querySelectorAll(".reservation_time");
    const phoneInputList = document.querySelectorAll(".phone_input");
    const reservationBtn = document.querySelector(".reservation_btn");
    const reloadBtn = document.querySelector(".reload");

    getIndex();

    timeList.forEach((time)=>{
        time.addEventListener("click", (e)=>{
            timeList.forEach(el => el.classList.remove('selected'));
            e.target.classList.add("selected");
            window.location.href = `/reservation/user4?n=${e.target.dataset.id}`
        })
    })

    function getIndex(){
        const part = window.location.search.split("=")[1]?? 1;
        timeList.forEach((el, i) => { 
            if (i + 1 === Number(part)) {
                el.classList.add('selected');
            }}
        );
    }

    phoneInputList.forEach((phone)=>{
        phone.addEventListener("blur", (e)=>{
            const regPhone = /^(01[016789]{1})-?[0-9]{3,4}-?[0-9]{4}$/;
            if(e.target.value){
                if(!regPhone.test(e.target.value)){
                    alert("휴대폰 번호를 확인해주세요.")
                    e.target.value = "";
                }
            }  
        })
    })

    reloadBtn.addEventListener("click", ()=>{
        window.location.reload();
    })

    reservationBtn.addEventListener("click", (e)=>{
        saveData(e)
    })

    function saveData(e){
        let reservations = [];

        const part = window.location.search.split("=")[1]?? 1;

        // 해당 time_id에 해당하는 입력 필드만 가져오기 (data-id가 timeId와 일치하는 입력 필드)
        const personInputs = document.querySelectorAll(`.person_input`);
        const phoneInputs = document.querySelectorAll(`.phone_input`);

        personInputs.forEach((personInput, index) => {
            const phoneInput = phoneInputs[index]; // 동일 인덱스의 휴대폰 필드를 매칭

                reservations.push({
                    time_id:personInput.dataset.idx,
                    part: part,
                    name: personInput.value, 
                    phone: phoneInput.value, 
                    location: personInput.getAttribute('data-id')  // data-id를 location으로 사용
                });
     
        });

        const data = {
            reservations: reservations
        }
    
        postData(data);  // 서버로 데이터 전송
    }

    function postData(data) {
        $.ajax({
            url: "/reservation/post_user4",
            type: "POST",
            data: JSON.stringify(data),
            dataType: "JSON",
            contentType: "application/json",
            success: function(res) {
                //console.log(res.status);
                if(res.status == "success"){
                    window.location.reload();
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    }
</script>