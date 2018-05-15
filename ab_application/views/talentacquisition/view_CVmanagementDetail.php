<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <div class="col-md-12" style="margin-top: 10px">
                <div id="employee_review_div">   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-u">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-tasks"></i> CV Management Information </h3>
                                </div>
                                <div class="panel-body">
                                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ScheduledInterviews/save_ScheduledInterviews" enctype="multipart/form-data" role="form" >
                                        <?php
                                        $candidate_status = $this->Common_model->get_array('candidate_status');
                                        foreach ($query->result() as $row) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <th>Requisition Id : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code') ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Position : </th>
                                                            <td>
                                                                <?php
                                                                $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
                                                                echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                                ?> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Fast Name : </th>
                                                            <td><?php echo $row->candidate_first_name ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Last Name : </th>
                                                            <td><?php echo $row->candidate_last_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email : </th>
                                                            <td><?php echo $row->candidate_email ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact Number : </th>
                                                            <td><?php echo $row->contact_number ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Qualification : </th>
                                                            <td><?php echo $row->qualification ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Experience : </th>
                                                            <td><?php echo $row->work_experience ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Skill : </th>
                                                            <td><?php echo $row->skill_set ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Education : </th>
                                                            <td><?php echo $row->education_summary ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>State : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->state, 'main_state', 'state_name') ?></td>
                                                        </tr>
                                                        <tr>    
                                                            <th>Resume : </th>
                                                            <td><?php echo "<a href=" . base_url() . "Con_CVManagement/download_resume/" . $row->upload_resume_path . " > " . $row->upload_resume_path . " </a>" ?></td>    
                                                        </tr>                                                    
                                                        <tr>
                                                            <th>Status : </th>
                                                            <td><?php echo $candidate_status[$row->status] ?></td>
                                                        </tr>                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            <?php /* if ($row->status == 0) { ?>
                                                <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
                                                    <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                                                        <input type="hidden" id="requisition_id" name="requisition_id" value="<?php echo $row->requisition_id ?>">
                                                        <input type="hidden" id="candidate_name" name="candidate_name" value="<?php echo $row->id ?>">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Interview Status </label>
                                                            <div class="col-sm-4">                            
                                                                <select name="interview_status" id="interview_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                                    <?php
                                                                    $interview_status = $this->Common_model->get_array('interview_status');
                                                                    foreach ($interview_status as $key => $val):
                                                                        ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select> 
                                                            </div>
                                                            <label class="col-sm-2 control-label">Interviewer<span class="req"/></label>
                                                            <div class="col-sm-4">                            
                                                                <select name="interviewer[]" id="interviewer" class="col-sm-12 col-xs-12 myselect2 input-sm" title="Interviewer (multiple select)" multiple>
                                                                    <option></option>
                                                                    <?php
                                                                    foreach ($employees_query->result() as $key):
                                                                        ?>
                                                                        <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name ?></option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="candidate_email" class="col-sm-2 control-label">Location<span class="req"/> </label>
                                                            <div class="col-sm-4">                            
                                                                <input type="text" name="location" id="location" class="form-control input-sm" placeholder="Location" />
                                                            </div>
                                                            <label class="col-sm-2 control-label">Interview Type<span class="req"/> </label>
                                                            <div class="col-sm-4"> 
                                                                <select name="interview_type" id="interview_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                                    <option></option>
                                                                    <?php
                                                                    $interview_type = $this->Common_model->get_array('interview_type');
                                                                    foreach ($interview_type as $key => $val):
                                                                        ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Interview Date<span class="req"/> </label>
                                                            <div class="col-sm-4">                            
                                                                <input type="text" name="interview_date" id="interview_date" class="form-control dt_pick input-sm" placeholder="Interview Date" autocomplete="off" />
                                                            </div>
                                                            <label class="col-sm-2 control-label">Interview Time </label>
                                                            <div class="col-sm-4">  
                                                                <input type="text" name="interview_time" id="interview_time" class="form-control time_pick input-sm" placeholder="Interview Time" autocomplete="off" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?> 
                                            <div class="modal-footer">
                                                <?php if ($row->status == 0) { ?>
                                                    <button type="submit" id="submit" class="btn btn-u"> Schedule </button>
                                                <?php } ?>
                                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_CVManagement" ?>">Close</a>
                                            </div>
                                            
                                            <?php */ ?>

                                        <?php } ?>
                                            
                                        

                                    </form>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_CVManagement" ?>">Close</a>
                            </div>
                        </div>        
                    </div>
                </div> 

            </div>

        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {

            var options = $('#interviewer > option:selected');
            if (options.length == 0) {
                alert('No Interviewer selected');
                return false;
            }

            //$("#requisition_id").attr('disabled',false);
            //$("#candidate_name").attr('disabled',false);
            $("#interview_status").attr('disabled', false);

            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_CVManagement';
                view_message(data, url, '', 'sky-form11');
                $("#interview_status").attr('disabled', true);

            });
            event.preventDefault();
        });
    });


    $("#interview_status").select2({
        placeholder: "Select Interview Status",
        allowClear: true,
    });

    $("#interviewer").select2({
        placeholder: " Interviewer (multiple select) ",
        allowClear: true,
    });

    $("#interview_type").select2({
        placeholder: "Select Interview Type",
        allowClear: true,
    });

    $(document).ready(function () {
        $("#interview_status").attr('disabled', true);
    });


</script>
<!--=== End Script ===-->

