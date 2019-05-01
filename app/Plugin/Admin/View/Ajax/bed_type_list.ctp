<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Bed Type List</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
 
        <div class="modal-body">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th># of Rooms</th>
                      
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($bedTypeData)): ?>

                <?php foreach($bedTypeData  as $data):?>
                    <tr>
                        <td><?php echo $data['BedType']['title']; ?></td>
                        <td><?php echo $data['BedTypeHotel']['no_of_rooms']; ?></td>
                       
                        <td>
                            <?php 
                                $id = $data['BedTypeHotel']['id'];
                                $roomId = $data['BedTypeHotel']['room_id'];
                                $actionList = '<a href="javascript:void(0)" data-bed="'.$id.'" data-room="'.$roomId.'" class="text-inverse p-r-10 add_bed_type" data-model="BedTypeHotel" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                                $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="BedTypeHotel" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>&nbsp;&nbsp;&nbsp;'; 
                                echo  $actionList
                            ?>

                        
                        </td>
                    </tr>
                <?php endforeach;?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No Bed Type Available</td>
                        
                    </tr>
                <?php endif;?>
                </tbody>   

            </table>
</div></div></div>
