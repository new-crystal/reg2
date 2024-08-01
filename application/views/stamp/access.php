<script src="https://cdn.tailwindcss.com"></script>
<script type="text/javascript" src="/assets/js/admin/lecture_history.js"></script>
<style>
    .qr-info-table {
        margin-top: 1rem;
        border: 2px solid #eee;
        border-collapse: collapse;
        width: 40%;
    }

    .qr-info-table th {
        background-color: #1d3557;
        border-color: #1d3557;
        color: #fff !important;
        font-size: 1.7rem;
        line-height: 2.5rem;
        font-weight: 600;
    }

    .qr-info-table>tr,
    .qr-info-table th {
        border: 2px solid #eee;
        text-align: center;
        font-size: 1.25rem;
        line-height: 2.5rem;
    }

    .qr-info-table td {
        border: 1px solid #eee;
        text-align: left;
        font-size: 1.5rem;
        line-height: 2.5rem;
        padding-left: 4rem;
        /* display: flex; */
        align-items: center;
        /* height: 4rem; */
        font-weight: bold;
    }

    .qr-info-table tr {
        height: 4rem;
        padding: 4px;
    }

    #open {
        background-color: #1d3557;
        float: right;
    }

    .notice {
        width: 500px;
        padding: 4px;
        background-color: #ffbe0b;
    }

    .memoHeader {
        background-color: #fb8500 !important;
    }
</style>

<div class="page-container">
    <div class="page-content">

        <div class="content">
            <div class="panel panel-flat">
                <form action="/event/access" id="qr_form" name="qr_form" class="w-full h-[88vh] flex flex-col items-center justify-center bg-slate-50">

                    <div class="w-2/5 flex flex-col items-center justify-center">
                        <h1 class="text-5xl mt-32 font-semibold ">QR CODE 입력 </h1>
                        <div class="w-[850px] flex justify-between">
                            <input id="qrcode_input" name="qrcode" class="w-[400px] h-[50px] mt-20 p-3 " type="text" autofocus placeholder="영문 확인해주세요!!" />
                            <button class="w-[150px] h-[40px] bg-slate-300 mt-20 mb-20 hover:bg-slate-400 active:bg-slate-500 text-black" type="submit" id="submit">등록</button>
                            <button class="w-[150px] h-[40px] bg-indigo-950 mt-20 mb-20 hover:bg-slate-300 active:bg-slate-300 text-white" type="button" id="memo_btn">메모</button>
                        </div>
                    </div>

                    <!-- <div class="w-3/5 h-[1px] bg-slate-400 translate-y-24"></div> -->
                    <div class="w-full bg-white flex flex-col items-left justify-around">
                        <div class="flex items-center justify-around">
                            <table class="qr-info-table w-2/5" id="qrTable">
                                <colgroup>
                                    <col width="30%" />
                                    <col />
                                </colgroup>
                                <tr>
                                    <th>event 1 수령 유무</th>
                                    <td id="event_1" class="qr_text">
                                        <?php echo isset($event['event_1']) ? $event['event_1'] : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>event 2 수령 유무</th>
                                    <td id="event_2" class="qr_text">
                                        <?php echo isset($event['event_2']) ? $event['event_2'] : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>성함</th>
                                    <td id="en_name" class="qr_text">
                                        <?php echo isset($user['nickname']) ? $user['nickname'] : ''; ?>
                                    </td>
                                </tr>
            
                                <tr>
                                    <th>email</th>
                                    <td id="email" class="qr_text">
                                        <?php if (isset($user['email'])) echo $user['email']; ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Event Memo</th>
                                    <td id="event_memo" class="qr_text">
                                        <?php if (isset($event['event_memo'])) echo $event['event_memo']; ?>
                                    </td>
                                </tr>
                            </table>

                          

                            <table class="qr-info-table w-2/5" id="qrTable">
                                <colgroup>
                                    <col width="30%" />
                                    <col />
                                </colgroup>
                                <tr>
                                    <th class="memoHeader">Total Count(25)</th>
                                    <td id="total_count" class="qr_text">
                                        <?php if (isset($user['total_count'])) echo $user['total_count'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="memoHeader">Jomes(1)</th>
                                    <td id="jomes_count" class="qr_text">
                                        <?php if (isset($user['jomes_count'])) echo $user['jomes_count'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="memoHeader">Diamond(1)</th>
                                    <td id="diamond_count" class="qr_text">
                                        <?php if (isset($user['diamond_count'])) echo $user['diamond_count'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="memoHeader">Platinum(3)</th>
                                    <td id="platinum_count" class="qr_text">
                                        <?php if (isset($user['platinum_count'])) echo $user['platinum_count'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="memoHeader">Gold(6)</th>
                                    <td id="gold_count" class="qr_text">
                                        <?php if (isset($user['gold_count'])) echo $user['gold_count'] ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="memoHeader">Silver(6) + Bronze(9)</th>
                                    <td id="silver_count" class="qr_text">
                                        <?php if (isset($user['silver_count']) ||isset($user['bronze_count']) ) echo $user['silver_count'] + $user['bronze_count']; ?>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <th class="memoHeader"></th>
                                    <td id="bronze_count" class="qr_text">
                                        <?php if (isset($user['bronze_count'])) echo $user['bronze_count'] ?>
                                    </td>
                                </tr> -->
                                
                            </table>
                        </div>
                        <table class="qr-info-table mb-80 w-2/5 mx-auto" >
                                 <colgroup>
                                    <col width="30%" />
                                    <col />
                                </colgroup>
                                <tr>
                                    <th class="memoHeader">
                                        댓글 이벤트 당첨 유무
                                    </th>
                                    <td id="is_prize">
                                    <?php if (isset($user['is_prize']) ||isset($user['is_prize']) ) echo $user['is_prize']; ?>
                                    </td>
                                </tr>
                            </table>
                        <div class="flex items-center justify-around *:w-[250px] *:h-[50px] *:border">
                            <button class="hover:bg-gray-200 event_btn" type="button" data-id="1">Event 1 상품 수령 완료</button>
                            <button class="hover:bg-gray-200 event_btn" type="button" data-id="2">Event 2 상품 수령 완료</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <div class="footer text-muted mt-20">
    © 2023. <a href="#">온라인 학술대회</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">(주)인투온</a>
</div> -->

</div>
<!-- /page content -->

</div>

<script>

    const eventBtnList = document.querySelectorAll('.event_btn');
    const memo_btn = document.querySelector('#memo_btn');

    const event_1 = document.querySelector('#event_1');
    const event_2 = document.querySelector('#event_2');

    const total = document.querySelector('#total_count');
    const diamond = document.querySelector('#diamond_count');
    const platinum = document.querySelector('#platinum_count');
    const jomes = document.querySelector('#jomes_count');
    const silver = document.querySelector('#silver_count');
    const prize = document.querySelector('#is_prize');

    function yellowBackground(target){
        target.style.background = 'yellow';
    }

    eventBtnList.forEach((btn)=>{
        btn.addEventListener("click", (e)=>{
            if(window.location.search !== ""){
                if(window.confirm(`event ${e.target.dataset.id} 상품 수령을 완료로 변경하시겠습니까`)){
                    window.location.href = `/event/update_gift?num=${e.target.dataset.id}&qrcode=${window.location.search.split("=")[1]}`;
                }
            }else{
                alert('QR 코드를 입력해주세요!')
            }
        })
    })

    memo_btn.addEventListener('click', (e)=>{
        if(window.location.search !== ""){
            const registerNum = window.location.search?.split("=")[1];
            const url = `/event/add_memo?n=${registerNum}`;
            if (registerNum) {
                const memoWindow = window.open(url, "Certificate", "width=500, height=300, top=30, left=30");

                window.addEventListener("message", (event) => {
                    if (event.source === memoWindow) {
                        const childInputValue = event.data;
                        memo.innerText = childInputValue;
                    }
                });
            }
        }else{
            alert('QR 코드를 입력해주세요!')
        }
    })

    window.onload = ()=>{
        const eventsList = [event_1, event_2];
        const gradeList = [
            {
                name:total,
                count:25
            },
            {
                name:jomes,
                count:1
            },
            {
                name:diamond,
                count:1
            },
            {
                name:platinum,
                count:3
            },
            {
                name:silver,
                count:5
            }
            ]

        eventsList.map((events)=>{
            events.innerText == "Y" && yellowBackground(events);
        })

        gradeList.map((grade)=>{
            grade.name.innerText == grade.count && yellowBackground(grade.name)
        })
        
        prize.innerText == "Y" && yellowBackground(prize);
    }
</script>