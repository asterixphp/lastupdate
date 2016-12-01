<?php

class Cel_db extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_list($sdate , $edate) // not including resigned and suspended user
    {
        $admin_db= $this->load->database('asteriskcdrdb', TRUE);
        $whr = " between '".$sdate."' and '".$edate."'" ;
        $query = $this->db->query("select * from cel where eventtime $whr");

      //  $query = $this->db->get('cel');
        return $query->result_array();
    }

}
