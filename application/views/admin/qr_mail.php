<style>
@font-face {
    font-family: 'Times New Roman', Times, serif;
    src: url("../../../assets/font/Times_New_Roman.otf");
}


#send_mail {
    background-color: #fff;
    padding: 4px 8px;
    border: 2px solid #ddd;
    cursor: pointer;
    margin-left: 1rem;
    font-weight: 600;
}

#send_mail:hover {
    background-color: #ddd;
}

table {
    font-family: 'Times New Roman', Times, serif;
}
</style>
<div align="center" style="width:750px;margin:0 auto;font-size:0;line-height:0;border:0">
   <div align="center" style="line-height:0;font-size:0;margin:0;padding:0">
        <img src="https://image.webeon.net/icomes2024/qr/img01.png" alt="" border="0" style="width:100%;" />
    </div>
    <div align="center" style="line-height:0;font-size:0;margin:0;padding:0">
        <img src="https://image.webeon.net/icomes2024/qr/img02.png" alt="" border="0" style="width:100%;" />
    </div>
    <div align="center" style="line-height:0;font-size:0;margin:0;padding:0">
        <img src="https://image.webeon.net/icomes2024/qr/img03.png" alt="" border="0" style="width:100%;" />
    </div>
    <div style="line-height:0;font-size:0;margin:0;padding:0;background-color: #FFF;">
        <img width="200px" height="200px"
            src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents(getcwd() . '/assets/images/QR/qrcode_' . $users['registration_no'] . '.jpg')); ?>"
            alt="" />
    </div>
    
			<div align="center" style="line-height:0;font-size:0;margin:0;padding:0">
                <a href="https://icomes.or.kr/main/venue.php" target="_blank">
                    <img src="https://image.webeon.net/icomes2024/qr/img04.png" alt="" border="0" style="width:100%;" />
                </a>
            </div>
	
            <div align="center" style="line-height:0;font-size:0;margin:0;padding:0">
				<img src="https://image.webeon.net/icomes2024/qr/img05.png" alt="" border="0" style="width:100%;" />
            </div>
			
			<div align="center" style="line-height:0;font-size:0;margin:0;padding:0">
				<img src="https://image.webeon.net/icomes2024/qr/img06.png" alt="" border="0" style="width:100%;" />
            </div>

    <div style="width:750px;display:flex; justify-content:center; margin-top:1rem;">
        <input id="email" style="width:350px; height:40px; padding:1rem;" placeholder="받으실 email주소를 작성해주세요." />
        <button id="send_mail" data-registration-no="<?php echo $users['registration_no'] ?>">이메일발송</button>
        <!-- <button style="background-color: #fff; padding: 4px 8px; border:1px solid #ddd; cursor:pointer"> <a
            id="sendMailLink" data-registration-no="<?php echo $users['registration_no'] ?>" href="#"
            style="text-decoration:none">기존 이메일로 발송</a></button> -->


    </div>

    <script>
    // JavaScript 코드
    document.addEventListener("DOMContentLoaded", function() {
        const sendMailLink = document.getElementById("sendMailLink");
        const sendMail = document.querySelector("#send_mail")
        const email = document.querySelector("#email")
        let regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');

        sendMail.addEventListener("click", () => {
            if (!email.value) {
                alert("보내실 이메일을 입력해주세요.")
                email.focus()
                return;
            } else if (!regex.test(email.value)) {
                alert("이메일 형식을 확인해주세요.")
                email.focus()
                return;
            } else {
                const registrationNo = sendMail.getAttribute("data-registration-no");
                const url =
                    `https://reg2.webeon.net/admin/sendemail?n=${registrationNo}&m=${email.value}`;

                fetch(url, {
                        method: 'GET',
                    })
                    .then(response => {
                        // 응답 처리
                        alert("이메일 발송 성공");
                    })
                    .catch(error => {
                        // 에러 처리
                        console.error("GET 요청 실패", error);
                    });
            }
        })



        // sendMailLink.addEventListener("click", function(event) {
        //     event.preventDefault();

        //     const registrationNo = sendMailLink.getAttribute("data-registration-no");
        //     const url = `https://reg2.webeon.net/admin/sendmail?n=${registrationNo}`;

        //     fetch(url, {
        //             method: 'POST',
        //         })
        //         .then(response => {
        //             // 응답 처리
        //             alert("이메일 발송 성공");
        //         })
        //         .catch(error => {
        //             // 에러 처리
        //             console.error("POST 요청 실패", error);
        //         });
        // });
    });
    </script>