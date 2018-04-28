<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_assetstype_div">
        <button class="btn btn-u btn-md" onClick="add_assetstype()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-assetstype" class="table table-striped table-bordered dt-responsive table-hover">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Asset Type</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_assets_type', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $row->asset_type . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $row->description . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_assetstype(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_assetstype(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>

<!-- Modal -->
<div class="modal fade" id="assetstype_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Assets Type</h4>
            </div>
            <form id="assetstype_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="assetstype_id" id="assetstype_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="asset_type" id="asset_type" class="form-control" placeholder="Asset Type" />
                        </div>
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="2" id="description" name="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    
    $(document).ready(function () {
         $('#dataTables-example-assetstype').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 10,
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_assetstype()
    {
        save_method = 'add';
        $('#assetstype_form')[0].reset(); // reset form on modals
        $('#assetstype_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Assets Type'); // Set Title to Bootstrap modal title
    }
   
    
</script>