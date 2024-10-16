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

	public function login()
    {
        $user_id = $this->input->post("user_id");
        $user_pass = $this->input->post("user_pass");

        if ($user_id == RESERVATION_ID && $user_pass == RESERVATION_PASS) {
            $this->session->set_userdata('reservation_data', array(
                'logged_in' => true
            ));
        }
        redirect('reservation');
    }

	public function index()
	{
		if (!isset($this->session->reservation_data['logged_in']))
			$this->load->view('reservation/login');
		else {
			$data['users'] = $this->music->get_reservations();
			$this->load->view('reservation/main.php', $data);
		}
	}

	public function day2()
	{
		if (!isset($this->session->reservation_data['logged_in']))
			$this->load->view('reservation/login');
		else {
			$data['users'] = $this->music->get_reservations2();
			$this->load->view('reservation/main2.php', $data);
		}
	}

	public function day3()
	{
		if (!isset($this->session->reservation_data['logged_in']))
			$this->load->view('reservation/login');
		else {
			$data['users'] = $this->music->get_reservations3();
			$this->load->view('reservation/main3.php', $data);
		}
	}

	public function day4()
	{
		if (!isset($this->session->reservation_data['logged_in']))
			$this->load->view('reservation/login');
		else {
			$data['users'] = $this->music->get_reservations4();
			$this->load->view('reservation/main4.php', $data);
		}
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
				   'day' => 'day1',
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
				   'day' => 'day2',
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
				   'day' => 'day3',
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

	public function post_name4()
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
				   'day' => 'day4',
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

	public function send_msm()
    {
		$timeId = $_GET['n'];
		$location = $_GET['m'];
		$day = $_GET['d'];
		
		$where = array(
			'time_id' => $timeId,
			'location' => $location,
			'day' => $day
		);
		$info = array(
			'chk_msm' =>  'Y'
		);
		$this->music->update_msm_status($info, $where);
		$data['users'] = $this->music->get_user($where);
		$this->load->view('reservation/send_msm', $data);
    }

	public function user1()
	{
		$data['part'] = isset($_GET['n']) ? $_GET['n'] : 1;
		$data['users'] = $this->music->get_reservations();
		$this->load->view('reservation/user1.php', $data);
	}

	public function post_user1()
	{	
	   // UTF-8 인코딩 헤더 설정
	   header('Content-Type: application/json; charset=utf-8');

	   // JSON 데이터를 받음
	   $inputData = file_get_contents('php://input');
	   $decodedData = json_decode($inputData, true);
   
	   if ($decodedData) {
		   $reservations = $decodedData['reservations'];
   
		   // 예약자 정보를 저장할 배열
		   $info = [];
   
		   // 예약 정보를 배열에 추가
		   foreach ($reservations as $reservation) {
			   $info[] = array(
				   'time_id' => $reservation['time_id'],  // 모든 예약 항목에 time_id 추가
				   'day' => 'day1',
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

	public function user2()
	{
		$data['part'] = isset($_GET['n']) ? $_GET['n'] : 1;
		$data['users'] = $this->music->get_reservations();
		$this->load->view('reservation/user2.php', $data);
	}

	public function post_user2()
	{	
	   // UTF-8 인코딩 헤더 설정
	   header('Content-Type: application/json; charset=utf-8');

	   // JSON 데이터를 받음
	   $inputData = file_get_contents('php://input');
	   $decodedData = json_decode($inputData, true);
   
	   if ($decodedData) {
		   $reservations = $decodedData['reservations'];
   
		   // 예약자 정보를 저장할 배열
		   $info = [];
   
		   // 예약 정보를 배열에 추가
		   foreach ($reservations as $reservation) {
			   $info[] = array(
				   'time_id' => $reservation['time_id'],  // 모든 예약 항목에 time_id 추가
				   'day' => 'day2',
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

	public function user3()
	{
		$data['part'] = isset($_GET['n']) ? $_GET['n'] : 1;
		$data['users'] = $this->music->get_reservations();
		$this->load->view('reservation/user3.php', $data);
	}

	public function post_user3()
	{	
	   // UTF-8 인코딩 헤더 설정
	   header('Content-Type: application/json; charset=utf-8');

	   // JSON 데이터를 받음
	   $inputData = file_get_contents('php://input');
	   $decodedData = json_decode($inputData, true);
   
	   if ($decodedData) {
		   $reservations = $decodedData['reservations'];
   
		   // 예약자 정보를 저장할 배열
		   $info = [];
   
		   // 예약 정보를 배열에 추가
		   foreach ($reservations as $reservation) {
			   $info[] = array(
				   'time_id' => $reservation['time_id'],  // 모든 예약 항목에 time_id 추가
				   'day' => 'day3',
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

	public function user4()
	{
		$data['part'] = isset($_GET['n']) ? $_GET['n'] : 1;
		$data['users'] = $this->music->get_reservations();
		$this->load->view('reservation/user4.php', $data);
	}

	public function post_user4()
	{	
	   // UTF-8 인코딩 헤더 설정
	   header('Content-Type: application/json; charset=utf-8');

	   // JSON 데이터를 받음
	   $inputData = file_get_contents('php://input');
	   $decodedData = json_decode($inputData, true);
   
	   if ($decodedData) {
		   $reservations = $decodedData['reservations'];
   
		   // 예약자 정보를 저장할 배열
		   $info = [];
   
		   // 예약 정보를 배열에 추가
		   foreach ($reservations as $reservation) {
			   $info[] = array(
				   'time_id' => $reservation['time_id'],  // 모든 예약 항목에 time_id 추가
				   'day' => 'day4',
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
