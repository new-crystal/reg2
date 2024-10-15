<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require __DIR__ . '/../../vendor/autoload.php';

class Reservation extends CI_Controller {
	private $sheets;
	private $data;

	public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Seoul');
        $this->load->model('music');
    }

	public function index()
	{
		$data['users'] = $this->music->get_reservations();
		$this->load->view('reservation/main.php', $data);
	}

	public function post_name()
	{	
	   // UTF-8 인코딩 헤더 설정
	   header('Content-Type: application/json; charset=utf-8');

	   // JSON 데이터를 받음
	   $inputData = file_get_contents('php://input');
	   $decodedData = json_decode($inputData, true);
   
	   if ($decodedData) {
		   $timeId = $decodedData['time_id'];
		   $reservations = $decodedData['reservations'];
   
		   // 예약자 정보를 저장할 배열
		   $info = [];
   
		   // 예약 정보를 배열에 추가
		   foreach ($reservations as $reservation) {
			   $info[] = array(
				   'time_id' => $timeId,  // 모든 예약 항목에 time_id 추가
				   'part' => $reservation['part'],
				   'name' => $reservation['name'],
				   'phone' => $reservation['phone'],
				   'location' => $reservation['location']
			   );
		   }
   
		   // DB 업데이트 실행
		   $this->music->update_name($info);
   
		   // JSON 응답 전송
		   echo json_encode(array("status" => "success", "message" => "Data updated successfully"), JSON_UNESCAPED_UNICODE);
	   } else {
		   echo json_encode(array("status" => "error", "message" => "Invalid JSON data"), JSON_UNESCAPED_UNICODE);
	   }
	}


}
