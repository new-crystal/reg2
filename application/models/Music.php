<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Music extends CI_Model
{
    private $reservation = "reservation";

	public function get_reservations()
	{
		$query = $this->db->query("
                    SELECT 
                       *
                    FROM reservation
	");
		return $query->result_array();
	}

    public function update_name($info)
    {
        foreach ($info as $reservation) {
            // time_id와 location이 동일한 레코드를 찾음
            $this->db->where('time_id', $reservation['time_id']);
            $this->db->where('location', $reservation['location']);
            $query = $this->db->get('reservation');
    
            if ($query->num_rows() > 0) {
                // 동일한 레코드가 있으면 업데이트
                $this->db->where('time_id', $reservation['time_id']);
                $this->db->where('location', $reservation['location']);
                $this->db->where('part', $reservation['part']);
                $this->db->update('reservation', array(
                    'day' => 'day1',
                    'nickname' => $reservation['name'],
                    'phone' => $reservation['phone']
                ));
            } else {
                // 동일한 레코드가 없으면 새로 삽입
                $this->db->insert('reservation', array(
                    'day' => 'day1',
                    'part' => $reservation['part'],
                    'time_id' => $reservation['time_id'],
                    'nickname' => $reservation['name'],
                    'phone' => $reservation['phone'],
                    'location' => $reservation['location']
                ));
            }
        }
    
        return true;  // 작업 완료 후 true 반환
    }

}
