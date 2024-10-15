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

	public function day2()
	{
		$data['users'] = $this->music->get_reservations2();
		$this->load->view('reservation/main2.php', $data);
	}

	public function day3()
	{
		$data['users'] = $this->music->get_reservations3();
		$this->load->view('reservation/main3.php', $data);
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

	public function post_name2()
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
		   $this->music->update_name2($info);
   
		   // JSON 응답 전송
		   echo json_encode(array("status" => "success", "message" => "Data updated successfully"), JSON_UNESCAPED_UNICODE);
	   } else {
		   echo json_encode(array("status" => "error", "message" => "Invalid JSON data"), JSON_UNESCAPED_UNICODE);
	   }
	}

	public function post_name3()
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
		   $this->music->update_name3($info);
   
		   // JSON 응답 전송
		   echo json_encode(array("status" => "success", "message" => "Data updated successfully"), JSON_UNESCAPED_UNICODE);
	   } else {
		   echo json_encode(array("status" => "error", "message" => "Invalid JSON data"), JSON_UNESCAPED_UNICODE);
	   }
	}

	public function send_msm()
    {
		$timeId = $_GET['n'];
		$location = $_GET['m'];
		
		$where = array(
			'time_id' => $timeId,
			'location' => $location
		);
		$info = array(
			'chk_msm' =>  'Y'
		);
		$this->music->update_msm_status($info, $where);
		$data['users'] = $this->music->get_user($where);
		$this->load->view('reservation/send_msm', $data);
    }
}
