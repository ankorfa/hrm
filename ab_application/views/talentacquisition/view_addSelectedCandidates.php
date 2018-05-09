<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <!--        <div class="row text-center">
                            <div class="col-md-1 col-md-offset-5" id='lodingbox' style=" position: absolute; z-index: 9999 !important; box-shadow: 5px 5px 5px rgba(0,0,0,.15);"> </div>
                        </div>-->

            <?php
            if ($type == 2) {//edit
                ?>
                <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                    <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_SelectedCandidates/update_SelectedCandidates" enctype="multipart/form-data" role="form" >


                        <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Candidate Details </h3>
                            </div>
                            <div class="panel-body">

                                <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                    <tbody>
                                        <?php
                                        foreach ($query->result() as $roww) {
                                            $position_id = $this->Common_model->get_name($this, $roww->requisition_id, 'main_opening_position', 'position_id');
                                            ?>
                                        <input type="hidden" value="<?php echo $roww->requisition_id; ?>" name="requisition_id" id="requisition_id">
                                        <input type="hidden" value="<?php echo $roww->id; ?>" name="candidate_id" id="candidate_id">
                                        <input type="hidden" value="<?php echo $roww->candidate_email; ?>" name="candidate_email" id="candidate_email">
                                        <tr>
                                            <th>Requisition ID : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $roww->requisition_id, 'main_opening_position', 'requisition_code'); ?></td>
                                            <th>Position : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Candidate Name : </th>
                                            <td><?php echo $roww->candidate_first_name ?></td>
                                            <th>Candidate Details : </th>
                                            <td><a href="<?php echo base_url() . "Con_SelectedCandidates/view_resume/" . $roww->upload_resume_path ?>" >View Details <?php // echo $roww->upload_resume_path;  ?> </a></td>
                                        </tr>
                                        <tr>
                                            <th>Candidate Email : </th>
                                            <td><?php echo $roww->candidate_email ?></td>
                                            <th>Qualification : </th>
                                            <td><?php echo $roww->qualification ?></td>
                                        </tr>
                                        <tr>
                                            <th>Work Experience  : </th>
                                            <td><?php echo $roww->work_experience ?></td>
                                            <th>Skill Set : </th>
                                            <td><?php echo $roww->skill_set ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>     
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Interview details </h3>
                            </div>
                            <div class="panel-body">


                                <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                    <tbody>
                                        <?php
                                        $interview_type = $this->Common_model->get_array('interview_type');
                                        $interview_status = $this->Common_model->get_array('interview_status');
                                        foreach ($interviewquery->result() as $rowi) {
                                            $position_id = $this->Common_model->get_name($this, $rowi->requisition_id, 'main_opening_position', 'position_id');
                                            ?>
                                            <tr>
                                                <th>Requisition ID : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $rowi->requisition_id, 'main_opening_position', 'requisition_code'); ?></td>
                                                <th>Position : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Interviewer : </th>
                                                <td><?php
                                                    //get_selected_value($the, $id_field, $value_field, $table, $select_field)
                                                    $interr = explode(",", $rowi->interviewer);
                                                    $interviewer = '';
                                                    foreach ($interr as $intr) {
                                                        if ($interviewer == '') {
                                                            $interviewer = $this->Common_model->get_selected_value($this, 'employee_id', $intr, 'main_employees', 'first_name');
                                                        } else {
                                                            $interviewer = $interviewer . "," . $this->Common_model->get_selected_value($this, 'employee_id', $intr, 'main_employees', 'first_name');
                                                        }
                                                    }

                                                    echo $interviewer;
                                                    //echo $rowi->interviewer 
                                                    ?>
                                                </td>
                                                <th>Time : </th>
                                                <td><?php echo $rowi->interview_time ?></td>
                                            </tr>
                                            <tr>
                                                <th>Date : </th>
                                                <td><?php echo $rowi->interview_date ?></td>
                                                <th>Mode : </th>
                                                <td><?php echo $interview_type[$rowi->interview_type] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status  : </th>
                                                <td><?php echo $interview_status[$rowi->interview_status] ?></td>
                                                <th>Location : </th>
                                                <td><?php echo $rowi->location ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>     
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Interview Status </h3>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Candidate Status </label>
                                    <div class="col-sm-10">                            
                                        <select name="candidate_status" id="candidate_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            $candidate_status = $this->Common_model->get_array('candidate_status');
                                            foreach ($candidate_status as $key => $val):
                                                if ($key == 3 || $key == 4) {
                                                    ?>
                                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">                        
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_SelectedCandidates" ?>">Close</a>
                            <button type="submit" id="submit" class="btn btn-u">Update</button>
                        </div>
                    </form>
                </div>

    <?php
}
?>

        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_SelectedCandidates';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    $("#candidate_status").select2({
        placeholder: "Select Candidate Status",
        allowClear: true,
    });


</script>
<!--=== End Script ===-->

