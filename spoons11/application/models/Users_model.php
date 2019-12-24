<?php
class Users_model extends CI_Model
{
    public function user_login($email,$password)
    {
        $sql = "SELECT * FROM users 
                WHERE email='$email' AND password='$password' LIMIT 1 ";
        $result = $this->db->query($sql)->row();        
        return $result; 
    }

    public function get_user($id)
    {
        $sql = "SELECT * FROM users WHERE id='$id' LIMIT 1 ";
        $result = $this->db->query($sql)->row();        
        return $result; 
    }

    public function check_auth($auth_id,$auth_type)
    {
        $sql = "SELECT * FROM users WHERE auth_id='$auth_id' AND log_mode ='$auth_type' LIMIT 1 ";
        $result = $this->db->query($sql)->row();        
        return $result;   
    }

    public function email_count_all_results($email) 
    {
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1 ";
        $result = $this->db->query($sql)->row();        
        return $result; 
    }

    public function password_count_all_results($has_key) 
    {
        $sql = "SELECT id FROM users WHERE reset_hash='$has_key' LIMIT 1 ";
        $result = $this->db->query($sql)->row();        
        return $result; 
    }
}