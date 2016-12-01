<?php

class User_db extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all_users() // not including resigned and suspended user
    {
        $query = $this->db->query("select a.* ,if(b.appdata ='','Blocked' ,'Allow') as Allow_Block from sip_buddies as a
                                 left join extensions as b on b.exten = a.name");
       // $query = $this->db->get('sip_buddies');
        return $query->result_array();
    }


    function get_user_by_user_name($user_name)
    {
        $this->db->where('username', $user_name);
        $admin_db= $this->load->database('admin', TRUE);
        return $admin_db->get('userman_users')->result_array();
    }

    function delete_users($uid)
    {
        $this->db->where('phoneno' , $uid);
        $this->db->delete('cs_user');
        $this->db->where('exten' , $uid);
        $this->db->delete('extensions');
        $this->db->where('name' , $uid);
        $this->db->delete('sip_buddies');

    }
    function block_users($uid)
    {
        $query = $this->db->query("update extensions set appdata='' where exten='$uid' ");
      //  $query->result_array();
    }
    function allow_users($uid)
    {
        $query = $this->db->query("update extensions set appdata= CONCAT('SIP/' ,exten ,',60') where exten='$uid' ");
      //  $query->result_array();
    }

}
