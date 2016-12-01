<?php
 	  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
      header("Content-type:   application/x-msexcel; charset=utf-8");
      header("Content-Disposition: attachment; filename=abc.xls"); 
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: private",false);
 ?>
      <table border='1'>
					<thead>
						<tr>
							<th>no</th>
							<th>Order no</th>
							<th>Tracking no</th>
							<th>Name</th>
							<th>State</th>
							<th>Product Cost</th>
							<th>Order date</th>
							<th>upload date</th>
						</tr>
					</thead>
					<tbody>
<?php
      for($i = 0; $i < count($omList) ; $i++)
      {
?>           
                 <tr id='$i'>
                 <td><?php echo $i;?></td> 
                 <td><?php echo $omList[$i]['Order no'];?></td>
                 <td><?php echo $omList[$i]['Tracking No'];?></td>
                 <td><?php echo $omList[$i]['Name'];?></td>
                 <td><?php echo $omList[$i]['State'];?></td>
                 <td><?php echo $omList[$i]['Product Cost'];?></td>
                 <td><?php echo $omList[$i]['OrderDate'];?></td>
                 <td><?php echo $omList[$i]['delivery_date'];?></td>
                 </tr>
 <?php           
      }
 ?>
 </tbody>
 </table>    
