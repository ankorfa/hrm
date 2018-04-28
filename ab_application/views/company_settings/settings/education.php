<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_educationl_div">
        <button class="btn btn-u btn-md" onClick="add_education()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-educationl" class="table table-striped table-bordered dt-responsive table-hover">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Education Level</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->educationlevelcode) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_education(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_education(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="education_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Education</h4>
            </div>
            <form id="education_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="education_id" id="education_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Education Level<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="educationlevelcode" id="educationlevelcode" class="form-control input-sm" placeholder="Education Level" />
                        </div>
                        <label class="col-sm-2 control-label">Degree <span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="degree" id="degree" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                //$degree_array = $this->Common_model->get_array('degree');
                                $degree_array = $this->db->get_where('main_degree', array('isactive' => 1));
                                foreach ($degree_array->result() as $keyy) {
                                    ?>
                                    <option value="<?php echo $keyy->id ?>"><?php echo $keyy->degree; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
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
         $('#dataTables-example-educationl').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 10,
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_education()
    {
        save_method = 'add';
        $('#education_form')[0].reset(); // reset form on modals
        
        $("#degree").select2({
            placeholder: "Select Degree",
            allowClear: true,
        });
        
        $('#education_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Education'); // Set Title to Bootstrap modal title
    }
    
    $("#degree").select2({
        placeholder: "Select Degree",
        allowClear: true,
    });

   
    
</script>