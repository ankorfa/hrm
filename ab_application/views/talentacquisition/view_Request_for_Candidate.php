
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
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Request_for_Candidate/search_Candidate/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">  &nbsp;  </label>
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
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Request_for_Candidate/save_Request_for_Candidate" enctype="multipart/form-data" role="form" >
                
                <div class="overflow-x" style=" overflow-y: scroll; margin-bottom: 12px; max-height: 600px; ">
                <table id="" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th> <input name='all_check' id='all_check' type='checkbox' ></th>
                            <th>Requisition Id</th>
                            <th>Position</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Mobile</th> 
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
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_first_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_email."</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->contact_number . "</td>";
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
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Request_for_Candidate" ?>"> Close </a>
                    <button type="submit" id="submit" class="btn btn-u"> Request </button>
                </div>
                
            </form>
                
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    $("#requisition_idd").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    

    $("#all_check").change(function() {
        if($(this).prop('checked') == true) {
            $('input:checkbox').attr('checked','checked');
        } else {
            $('input:checkbox').removeAttr('checked');
        }
    });
    
    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Request_for_Candidate';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });
    
</script>
<!--=== End Content ===-->

