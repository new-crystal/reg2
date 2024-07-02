<?php
defined('BASEPATH') or exit('No direct script access allowed');
require __DIR__ . '/../../vendor/autoload.php';

class Event extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Seoul');
        $this->load->model('stamp');
        $this->load->model('users');
        ini_set('memory_limit', '-1');
    }

    public function index()
    {

        $this->load->view('admin/header');
        if (!isset($this->session->admin_data['logged_in']))
            $this->load->view('admin/login');
        else {
            // 
            $data['primary_menu'] = 'users';
            $data['users'] = $this->users->get_users_order_index();

            $this->load->view('stamp/left_side.php', $data);
            $this->load->view('stamp/users', $data);
        }
        $this->load->view('footer');
    }

    public function user_detail()
    {

        $this->load->view('admin/header');
        if (!isset($this->session->admin_data['logged_in']))
            $this->load->view('admin/login');
        else {
            // 
            $data['primary_menu'] = 'users';
            $data['users'] = $this->users->get_stamp_count();

            $this->load->view('stamp/left_side.php', $data);
            $this->load->view('stamp/user_detail', $data);
        }
        $this->load->view('footer');
    }

    public function access()
    {
        $this->load->view('admin/header');
        if (!isset($this->session->admin_data['logged_in']))
            $this->load->view('admin/login');
        else {
            $qrcode = isset($_GET['qrcode']) ? $_GET['qrcode'] : null;
            $data['primary_menu'] = 'stamp';
            $this->load->view('stamp/left_side.php', $data);

            if ($qrcode) {

                //[sujeong] stamp tour 시간 적어야 할 듯 ?
                $time = date("Y-m-d H:i:s");
                $where = array(
                    'registration_no' => $qrcode
                );

                $zero_number = str_replace('ICOMES2024-','', $qrcode);
                $number = str_replace(0,'',$zero_number);
                //입장시간, 퇴장시간 기록
                // $this->entrance->record($info);

                $data['user'] = $this->stamp->get_access($number);
                $this->load->view('stamp/access', $data);
            } else {
                $this->load->view('stamp/access');
            }
        }
        $this->load->view('footer');
    }
  
}

?>