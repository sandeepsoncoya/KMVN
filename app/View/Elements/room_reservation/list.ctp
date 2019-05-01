<table id='empTable' class='display dataTable'>

  <thead>
    <tr>
        <th>Sr</th>
        <th>Booking No.</th>
        <th>Booking Date</th>
        <th>Hotel Name</th>
        <th>Check In</th>
        <th>Action</th>
    </tr>
  </thead>

</table>



<script type="text/javascript">
    $(document).ready(function(){
       $('#empTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
              'url':'<?php echo Router::url(array("controller" => "Ajax", "action" => "bookingList")); ?>'
          },
          'columns': [
             { data: 'sr' },
             { data: 'booking_id' },
             { data: 'created' },
             { data: 'title' },
             { data: 'check_in' },
             { data: 'action' },
          ]
       });
    });

   
</script>