<?php

/** @property CI_Session $session Description */
class LoginModel extends MY_Model {

    protected $table = 'users';
    protected $pK = 'username';
    public $username;
    public $password;

    function rules() {
        return array(
            array('field' => 'username', 'label' => 'Username', 'rules' => 'required'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
        );
    }

    function setUserSession($username) {
        $this->load->library('session');
        $user = $this->getByPrimary($username);
        $this->session->set_userdata('user', $user);
    }

    function clearUserSession() {
        $this->load->library('session');
        $this->session->unset_userdata('user');
    }
    
    function autheticate($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        $result = $query->row();
        $attempt = $this->attempLogin();
        if ($attempt === TRUE) {
            if ($result !== null) {
                if (md5($password) === $result->password){
                    if ($result->activated==0)
                        return 'User telah di-nonaktif-kan'; else
                    if ($result->banned==1)
                        return 'User telah diblokir'; else        
                    return true;
                        
                }
            }
            return 'Login tidak valid !!!';
        }
        return $attempt;
    }
    
    
    /**
     * 
     * @param int $timeWait jumlah waktu tunggu dalam menit jika telah melebihi batas percobaan
     * @param int $timeAttempt maksimal kali percobaan login
     * @return boolean|string
     */
    private function attempLogin($timeWait = 10, $timeAttempt = 10) {
        $this->load->library('session');
        if ($this->session->has_userdata('last_attempt')) {
            $now = time();
            $last_attempt = $this->session->last_attempt;
            $m = ceil(abs($now - $last_attempt) / 60);
            if ($m >= $timeWait) {
                $this->session->unset_userdata('last_attempt');
                $this->session->set_userdata('attempt', 0);
                return true;
            }
            $minute = $timeWait - $m;
            return "<div class='alert alert-danger'>Coba lagi setelah $minute menit</div>";
        }
        if ($this->session->has_userdata('attempt')) {
            $attempt = $this->session->attempt;
            if ($attempt > $timeAttempt) {
                $this->session->set_userdata('last_attempt', time());
                return "<div class='alert alert-danger'>Coba lagi setelah 10 menit !</div>";
            }
            $attempt++;
            $this->session->set_userdata('attempt', $attempt);
            return true;
        }
        $this->session->set_userdata('attempt', 1);
        return true;
    }
	
	function get_pass($nim){
		$query = $this->db->query("Select password from reg_user where username=".$this->db->escape($nim)."");
        $result = $query->row();
		return $result;
	}
	
	function check_username($nim) {
        $this->db->where('username',$nim);       
        return ($this->db->count_all_results('reg_user') > 0);
    }
	
	function update_user($noreg,$data)
	{
		$this->db->where('username', $noreg);
		return $this->db->update('reg_user', $data);
	}
}
