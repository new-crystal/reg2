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
        <!-- <div class="page-header">
            <div class="page-header-content">
                <div class="page-title flex items-center justify-between">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">QR code 등록</span>
                    </h4>
                </div>
            </div>
        </div> -->
        <div class="content">
            <div class="panel panel-flat">
                <div>
                    <button class="w-[150px] h-[40px] bg-slate-300 mt-20 hover:bg-slate-400 active:bg-slate-500" type="button" id="open">새창</button>
                </div>
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
                    <div class="w-full bg-white flex items-left justify-around">
                        <table class="qr-info-table mb-80 w-2/5" id="qrTable">
                            <colgroup>
                                <col width="30%" />
                                <col />
                            </colgroup>
                            <tr>
                                <th>등록번호</th>
                                <td id="number" class="qr_text">
                                    <?php if (isset($user['registration_no'])) echo $user['registration_no'] ?>
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
                                <td id="attendance_type" class="qr_text">
                                    <?php if (isset($user['email'])) echo $user['email']; ?>
                                </td>
                            </tr>

                        </table>
                        <table class="qr-info-table mb-80 w-2/5" id="qrTable">
                            <colgroup>
                                <col width="30%" />
                                <col />
                            </colgroup>
                            <tr>
                                <th class="memoHeader">Total Count</th>
                                <td id="total_count" class="qr_text">
                                    <?php if (isset($user['total_count'])) echo $user['total_count'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="memoHeader">Diamond</th>
                                <td id="diamond_count" class="qr_text">
                                    <?php if (isset($user['diamond_count'])) echo $user['diamond_count'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="memoHeader">Platinum</th>
                                <td id="platinum_count" class="qr_text">
                                    <?php if (isset($user['platinum_count'])) echo $user['platinum_count'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="memoHeader">Gold</th>
                                <td id="gold_count" class="qr_text">
                                    <?php if (isset($user['gold_count'])) echo $user['gold_count'] ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="memoHeader">Silver</th>
                                <td id="silver_count" class="qr_text">
                                    <?php if (isset($user['silver_count'])) echo $user['silver_count'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="memoHeader">Bronze</th>
                                <td id="bronze_count" class="qr_text">
                                    <?php if (isset($user['bronze_count'])) echo $user['bronze_count'] ?>
                                </td>
                            </tr>
                            
                        </table>
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