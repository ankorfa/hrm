<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <?php
            if ($type == 3) {//edit
                ?>
                <div class="col-md-12" style="margin-top: 10px">
                    <form id="interview_status" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Interview_Candidate/update_interview_status" enctype="multipart/form-data" role="form" >
                        <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Interview Details </h3>
                            </div>
                            <div class="panel-body">

                                <label class=""><u><h4>Candidate Details </h4></u></label>

                                <div class="" style="margin-bottom: 20px;">
                                    <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                        <tbody>
                                            <?php
                                            foreach ($query->result() as $roww) {
                                                $position_id = $this->Common_model->get_name($this, $roww->requisition_id, 'main_opening_position', 'position_id');
                                                ?>
                                            <input type="hidden" value="<?php echo $roww->id; ?>" name="interview_schedule_id" id="interview_schedule_id">
                                            <input type="hidden" value="<?php echo $roww->candidate_name; ?>" name="candidate_id" id="candidate_id">
                                            <tr>
                                                <th>Requisition ID : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $roww->requisition_id, 'main_opening_position', 'requisition_code'); ?></td>
                                                <th>Position : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Candidate Name : </th>
                                                <td><?php echo $this->Common_model->get_name($this, $roww->candidate_name, 'main_cv_management', 'candidate_first_name'); ?></td>
                                                <th>Candidate Details : </th>
                                                <td><a href="<?php echo base_url() . "Con_ScheduledInterviews/view_resume/" . $this->Common_model->get_name($this, $roww->candidate_name, 'main_cv_management', 'upload_resume_path') ?>" >View Details </a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>     
                                        </tbody>
                                    </table>
                                </div>



                                <label class="padding-top-5"><u><h4>Interview Details </h4></u></label>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Interview Status</label>
                                    <div class="col-sm-10">                            
                                        <select name="up_interview_status" id="up_interview_status" onchange="load_candidate_status(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            $interview_status = $this->Common_model->get_array('interview_status');
                                            foreach ($interview_status as $keyy => $vall):
                                                if ($keyy == 0 || $keyy == 3 || $keyy == 4) {
                                                    ?>
                                                    <option value="<?php echo $keyy ?>"><?php echo $vall ?></option>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Candidate Status </label>
                                    <div class="col-sm-10">                            
                                        <select name="up_candidate_status" id="up_candidate_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                           
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Comments</label>
                                    <div class="col-sm-10">                            
                                        <textarea name="description" id="description" class="form-control" rows="2" placeholder="Description"  title="Description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">                        
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Interview_Candidate" ?>">Close</a>
                            <button type="submit" id="submit" class="btn btn-u">Update</button>
                        </div>

                    </form>
                </div>



                <script>

                    $("#up_interview_status").select2({
                        placeholder: "Select Interview Status",
                        allowClear: true,
                    });

                    $("#up_candidate_status").select2({
                        placeholder: "Select Candidate Status",
                        allowClear: true,
                    });

                </script>
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

            var options = $('#interviewer > option:selected');
            if (options.length == 0) {
                alert('No Interviewer selected');
                return false;
            }

            $("#requisition_id").attr('disabled', false);
            $("#candidate_name").attr('disabled', false);
            $("#interview_status").attr('disabled', false);

            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_ScheduledInterviews';
                view_message(data, url, '', 'sky-form11');
                $("#interview_status").attr('disabled', true);

            });
            event.preventDefault();
        });
    });

    $(function () {
        $("#interview_status").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#interview_status").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_ScheduledInterviews';
                view_message(data, url, '', 'interview_status');

            });
            event.preventDefault();
        });
    });

    function load_candidate_name(id) {
        $.ajax({
            url: "<?php echo site_url('Con_ScheduledInterviews/load_candidate_dropdown/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {

                $('#candidate_name').html('');
                $('#candidate_name').empty();

                $('#candidate_name').html(data);
            }
        })
    }


    function load_candidate_status(id) {
        $.ajax({
            url: "<?php echo site_url('Con_ScheduledInterviews/load_candidate_status/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {

                $('#up_candidate_status').html('');
                $('#up_candidate_status').empty();

                $('#up_candidate_status').html(data);
            }
        })
    }

    $('#interview_time, .time_pick').timepicker({
        minuteStep: 5,
        showInputs: false,
        disableFocus: false,
        showSeconds: false,
        defaultTime: ''
    });



</script>
<!--=== End Script ===-->
