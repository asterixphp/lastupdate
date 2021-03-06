<?php

require_once('base_controller.php');

class channel extends BASE_Controller
{
    var $menuList;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array( 'form_validation', 'email'));
        $this->load->library ( 'upload' );
        $this->load->database();
        $this->load->model('cel_db');

    }
    public function index()
    {
       date_default_timezone_set('America/Los_Angeles');
      if( !isset($_REQUEST['st_date']) )
            $_REQUEST['st_date'] = date("m/d/Y");

      if( !isset($_REQUEST['en_date']) )
           $_REQUEST['en_date'] = date("m/d/Y");

      $st_calc = date("Y-m-d", strtotime($_REQUEST['st_date']));
      $en_calc = date("Y-m-d", strtotime($_REQUEST['en_date']));

        $omList   = $this->cel_db->get_list($st_calc  , $en_calc ); // all user ,
        $B = $this->load->view('channel', array('omList' => $omList , 'st_date'=>$_REQUEST['st_date'] , 'en_date'=>$_REQUEST['en_date']), TRUE );
        $this->_O( $B );
    }
}
?>
