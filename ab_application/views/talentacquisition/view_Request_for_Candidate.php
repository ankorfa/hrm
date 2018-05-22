
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <div class="table-responsive col-md-12 col-centered">
            <form class="form-horizontal" action="<?php echo base_url(). 'Con_Request_for_Candidate/search_Candidate/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Requisition </label>
                                <div class="col-sm-8">
                                    <select name="requisition_idd" id="requisition_idd" class="col-xs-12 myselect2 input-sm">
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
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Qualification </label>
                                <div class="col-sm-8">
                                    <select name="qualification" id="qualification" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($qualification_query->result() as $key) {
                                            $slct = ($search_criteria['qualification'] != "" && $search_criteria['qualification'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->qualification . '" ' . $slct . '>' . $key->qualification . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Skill Set </label>
                                <div class="col-sm-8">
                                   <select name="skill_set" id="skill_set" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($skill_query->result() as $key) {
                                            $slct = ($search_criteria['skill_set'] != "" && $search_criteria['skill_set'] == $key->skill_set) ? 'selected' : '';
                                            echo '<option value="' . $key->skill_set . '" ' . $slct . '>' . $key->skill_set . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Experience </label>
                                <div class="col-sm-8">
                                   <select name="experience" id="experience" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($experience_query->result() as $key) {
                                            $slct = ($search_criteria['experience'] != "" && $search_criteria['experience'] == $key->work_experience) ? 'selected' : '';
                                            echo '<option value="' . $key->work_experience . '" ' . $slct . '>' . $key->work_experience . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-5">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
            <!--<form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php // echo base_url(); ?>Con_Request_for_Candidate/save_Request_for_Candidate" enctype="multipart/form-data" role="form" >-->
                
                <div class="overflow-x" style=" overflow-y: scroll; margin-bottom: 12px; max-height: 600px; ">
                <table id="" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th> <input name='all_check' id='all_check' type='checkbox' ></th>
                            <th>Resume Type</th>
                            <th>Requisition Id</th>
                            <th>Position</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Mobile</th> 
                            <th>Qualification</th>
                            <th>Work Experience</th>
                            <th>Skill Set</th>
                            <th>Status</th>
                            <th>Resume</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $candidate_status = $this->Common_model->get_array('candidate_status');
                        if ($query) {
                            $sl=0;
                            foreach ($query->result() as $row) {
                
                                $position_id=$this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','position_id');
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . "<input name='candidate_id[]' id='candidate_id' type='checkbox' value='$row->id'> <input name='requisition_id' id='requisition_id' type='hidden' value='$row->requisition_id'>". "</td>";
                                print"<td id='catA" . $pdt . "'>" . $resume_type[$row->resume_type] . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_first_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_email."</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->contact_number . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->qualification ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->work_experience ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->skill_set ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $candidate_status[$row->status] ."</td>";
                                print"<td id='catA" . $pdt . "'><a href='" . base_url() . "Con_CV_Bank/download_resume/" . $row->upload_resume_path . "/" . "' > ". $row->upload_resume_path ." </a></td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">                        
                    <!--<a class="btn btn-danger" href="<?php // echo base_url() . "Con_Request_for_Candidate" ?>"> Close </a>-->
                    <!--<button type="submit" id="submit" class="btn btn-u"> Request </button>-->
                    <a class="btn btn-u" onclick="request_candidate();" href="#"> Request </a>
                </div>
                
            <!--</form>-->
                
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>


</div><!--/row-->
</div><!--/container-->



<!-- Modal -->
<div class="modal fade" id="request_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Request</h4>
            </div>
            <form id="request_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" name="candidate_ids" id="candidate_ids"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label ">Requisition </label>
                        <div class="col-sm-6">
                            <select name="requisition_ids" id="requisition_ids" class="col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($opening_position_query->result() as $key) {
                                    echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-u">Request Candidate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    $("#requisition_idd").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    $("#qualification").select2({
        placeholder: "Select qualification",
        allowClear: true
    });
    $("#skill_set").select2({
        placeholder: "Select skill set",
        allowClear: true
    });
    $("#experience").select2({
        placeholder: "Select experience",
        allowClear: true
    });
    $("#requisition_ids").select2({
        placeholder: "Select skill set",
        allowClear: true
    });
    

    $("#all_check").change(function() {
        if($(this).prop('checked') == true) {
            $('input:checkbox').attr('checked','checked');
        } else {
            $('input:checkbox').removeAttr('checked');
        }
    });
    
    var save_method; //for save method string
    var table;
    function request_candidate()
    {
        save_method = 'add';
        $('#request_form')[0].reset(); // reset form on modals

        $("#requisition_ids").select2({
            placeholder: "Select requisition",
            allowClear: true,
        });
        
        $('#candidate_ids').val('');
        
        var multi_members="";
        $("input[name='candidate_id[]']:checked:enabled").each(function() {
            if(multi_members=="")
            {
               multi_members=$(this).val(); 
            }
            else
            {
                multi_members=multi_members+","+$(this).val();
            }
            
        });

        $('#candidate_ids').val(multi_members);

        $('#request_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Request'); // Set Title to Bootstrap modal title
    }
    
    $(function () {
        $("#request_form").submit(function (event) {
            loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Request_for_Candidate/save_Request_for_Candidate') ?>";
            }
            $.ajax({
                url: url,
                data: $("#request_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                var url = '<?php echo base_url() ?>Con_Request_for_Candidate';
                view_message(data, url, 'request_Modal','request_form');
            });
            event.preventDefault();
        });
    });
    
//    $(function () {
//        $("#sky-form11").submit(function (event) {
//            loading_box(base_url);
//            var url = $(this).attr('action');
//            $.ajax({
//                url: url,
//                data: $("#sky-form11").serialize(),
//                type: $(this).attr('method')
//            }).done(function (data) {
//
//                var url = '<?php // echo base_url() ?>Con_Request_for_Candidate';
//                view_message(data, url, '', 'sky-form11');
//
//            });
//            event.preventDefault();
//        });
//    });
//    

</script>
<!--=== End Content ===-->

