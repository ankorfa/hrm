<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_SelectedCandidates/add_ScheduledInterviews" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>-->
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requisition Id</th>
                            <th>Position</th>
                            <th>Candidate Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Is User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $candidate_status = $this->Common_model->get_array('candidate_status');
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
                                if ($row->candidate_user_id == 0) {
                                    $is_user = "No";
                                } else {
                                    $is_user = "Yes";
                                }
                                $sl++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_first_name . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_email . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->contact_number . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $candidate_status[$row->status] . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $is_user . "</td>";
                                print"<td><div class='action-buttons '><a onclick='Recall_Rejected_Candidates(" . $row->id . ")'href='#' > Re-Call </a>&nbsp; </div> </td>";
                                //print"<td><div class='action-buttons '><a onclick='delete_data(" . $row->id . ")'href='" . base_url() . "Con_Rejected_Candidates/Recall_Rejected_Candidates/" . $row->id . "' > Re-Call </a>&nbsp; </div> </td>";
//                                if ($row->status == 2) {
//                                    print"<td><div class='action-buttons '><a href='" . base_url() . "Con_SelectedCandidates/edit_SelectedCandidates/" . $row->id . "/" . $row->requisition_id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
//                                    print"<td><div class='action-buttons '><a href='" . base_url() . "Con_SelectedCandidates/edit_SelectedCandidates/" . $row->id . "/" . $row->requisition_id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
//                                } else if ($row->status == 3) {
//                                    print"<td><div class='action-buttons '><a href='#' onclick='add_ob_user(" . $row->id . ")' title=' Request to user for Onboarding '><i class='fa fa-user'>&nbsp;&nbsp;</i></a> <a href='#' onclick='add_ob_info(" . $row->id . ")' title='Onboarding By HR'><i class='fa fa-info-circle'>&nbsp;&nbsp;</i></a> &nbsp;<a href='#' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
//                                } else {
//                                    print"<td><div class='action-buttons '><a href='#' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
//                                }
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    function Recall_Rejected_Candidates(id) {
        var r = confirm("Do you want to Re-Call this?")
        if (r == true)
            window.location = base_url + "Con_Rejected_Candidates/Recall_Rejected_Candidates/" + id;
        else
            return false;
    }

</script>

