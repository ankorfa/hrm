<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_CVManagement/search_requisition/'; ?>" method="post">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_CVManagement/add_CVManagement" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add New Resume </a></br></br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">  &nbsp;  </label>
                                    <div class="col-sm-8">
                                        <select name="requisition_id" id="requisition_id" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($opening_position_query->result() as $key) {
                                                $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                                $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                
                                                $slct = ($search_criteria['requisition_id'] == $key->id) ? 'selected' : '';
                                                echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                
                <div class="overflow-x">
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requisition Id</th>
                            <th>Position</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Mobile</th> 
                            <th>Skill Set</th>
                            <th>Status</th>
                            <th>Resume</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $candidate_status = $this->Common_model->get_array('candidate_status');
                        if ($query) {
                            $sl=0;
                            foreach ($query->result() as $row) {
                                
                                if ($row->status != 3) {
                                    $action_button = "<a title='Edit' href='" . base_url() . "Con_CVManagement/edit_CVManagement/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a title='Delete' href='#' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a>";
                                } else {
                                    $action_button = "";
                                }

                                $position_id=$this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','position_id');
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_first_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_email."</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->contact_number . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->skill_set ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $candidate_status[$row->status] ."</td>";
                                print"<td id='catA" . $pdt . "'><a href='" . base_url() . "Con_CVManagement/download_resume/" . $row->upload_resume_path . "/" . "' > ". $row->upload_resume_path ." </a></td>";
                                print"<td><div class='action-buttons '>". $action_button ." &nbsp;&nbsp; <a title='Preview' href='" . base_url() . "Con_CVManagement/view_CVManagement/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;</div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                </div>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    $("#requisition_id").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
        
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_CVManagement/delete_CVManagement/" + id;
        else
            return false;
    }


</script>
<!--=== End Content ===-->

