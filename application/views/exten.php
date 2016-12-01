<?php
$field_type = array( 'context','exten','priority','app','appdata');

?>
<script type="text/javascript" src="JQuery/jquery-2.2.3.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid-theme.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid.min.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('includes/jsgrid-1.5.2/jsgrid.min.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('includes/jsgrid-1.5.2/jsgrid-theme.min.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('includes/jsgrid-1.5.2/jsgrid.min.js'); ?>" />

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('includes/jsgrid-1.5.2/jsgrid-fr.js'); ?>" />


    <!-- Main content -->
    <?php $attributes = array('class' => '', 'id' => 'upload', 'name' =>'order_form', 'method'=>'post', 'role' => 'form');
              echo form_open_multipart('index.php/user', $attributes); ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header margin" >
              <h2 id='notify_id'>
              Extension(<?php echo count($omList);?>)
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

function onprintexcel()
{
<?php
          echo "window.open(\"".base_url('index.php/delivery/delivery_4_unassigned_order_print')."\",'print_win');";
?>

}
</script>
