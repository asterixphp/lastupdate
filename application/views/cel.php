<?php
$field_type = array( 'eventtype','eventtime','cid_num','cid_ani','cid_dnid','exten','context','channame','appname','appdata'
                    ,'amaflags','uniqueid','linkedid','peer','extra');

?>  <!--
<script type="text/javascript" src="JQuery/jquery-2.2.3.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>  -->

<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid-theme.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid.min.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('includes/jsgrid-1.5.2/jsgrid.min.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('includes/jsgrid-1.5.2/jsgrid-theme.min.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('includes/jsgrid-1.5.2/jsgrid.min.js'); ?>" />

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('includes/jsgrid-1.5.2/jsgrid-fr.js'); ?>" />


    <!-- Main content -->
    <?php $attributes = array('class' => '', 'id' => 'reg_form', 'name' =>'reg_form', 'method'=>'post', 'role' => 'form');
              echo form_open_multipart('index.php/cel', $attributes); ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header margin" >
              <div class="col-xs-6">
              <h2 id='notify_id'>
              Channel History(<?php echo count($omList);?>)
              </div>
              <div class="col-xs-2">
                 <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name='st_date' id='st_date' class="form-control pull-right" value="<?php echo $st_date;?>"
                    onchange="get_reg_submit();">
                </div>
              </div>
              <div class="col-xs-2">
                 <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name='en_date' id='en_date' class="form-control pull-right" value="<?php echo $en_date;?>"
                    onchange="get_reg_submit();">
                </div>
              </div>
              <div class="form-group margin" align='right'>
            <!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal"
       onclick="onprintexcel();">Download</button></P>  -->
              </div>
            </div>
            <!-- /.box-header -->
             <div id="jsGrid"></div>
            <!-- /.box-body -->
          </div>
          </div>
          </div>
    <!-- /.content -->
    </section>
   <?php echo form_close(); ?>
<script>
<?php
    $fstr = "[";
    for( $i = 0 ; $i < count($field_type ) ; $i++ )
    {
      $fld = $field_type[$i];
      $fstr .= "{name : '$fld', type: 'text'},";
    }
    $fstr .= "]";

?>


(function() {

    var db = {
        loadData: function(filter) {
            return $.grep(this.clients, function(client) {

                return 1
                <?php
                   for( $i = 0 ; $i < count($field_type ) ; $i++ )
                   {
                      echo " && (!filter['$field_type[$i]'] || client['$field_type[$i]'].indexOf(filter['$field_type[$i]']) > -1 )  ";
                   }
                ?>;
                ;
            });
        }

    };

    window.db = db;
    db.clients =<?php echo json_encode($omList); ?>;

}());




   $("#jsGrid").jsGrid({
        width:'100%',
        height:'700px',
        filtering: true,
        sorting: true,
        paging: true,
        autoload:true,

        controller: db,

        fields: <?php echo $fstr; ?>


      });
      </script>

<script type="text/javascript">
$('#st_date').inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
$('#st_date').datepicker({
  autoclose: true
});
$('#en_date').inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
$('#en_date').datepicker({
  autoclose: true
});

function get_reg_submit(){
   document.reg_form.submit();
}

function onprintexcel()
{
<?php
          echo "window.open(\"".base_url('index.php/delivery/delivery_4_unassigned_order_print')."\",'print_win');";
?>

}
</script>
