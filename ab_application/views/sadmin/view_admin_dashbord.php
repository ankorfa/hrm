<div class="col-md-12 main-content-div">
    <div class="main-content">

        <!--=== Content Part ===-->
        <div class="container content">
                <div class="col-md-10 col-md-offset-1" >

                    <?php /* foreach ($query->result() as $row) { 
                        
                        if ($row->company_logo == "") {
                            $logo = base_url() . "uploads/blank.png";
                        } else {
                            $logo = base_url() . "uploads/companylogo/" . $row->company_logo;
                        }
                                
                        ?>
                        <!-- Clients Block-->
                        <div class="row clients-page">
                            <div class="col-md-2 ">
                                <img src="<?php echo $logo; ?>" class="img-responsive hover-effect  center-align" alt="" height="100" width="90"/>
                            </div>
                            <div class="col-md-10">
                                
                                <h3><a title="Change Company" href="<?php echo base_url() . 'Con_ChangeCompany/change_Companybyadmin/' . $row->id; ?>"><?php echo $row->company_full_name; ?></a></h3>
                                <ul class="list-inline">
                                    <li><i class="fa fa-map-marker color-green"></i> <?php echo $this->Common_model->get_name($this,$row->county_id,'main_county','county_name'); ?></li>
                                    <li><i class="fa fa-map-marker color-green"></i> <?php echo $row->address_1; ?></li>
                                    <li><i class="fa fa-globe color-green"></i> <a class="linked" href="#"><?php echo $row->email; ?></a></li>
                                    <li><i class="fa fa-mobile color-green" aria-hidden="true"> </i> <a class="linked" href="#"><?php echo $row->mobile_phone; ?></a></li>
                                    <li><i class="fa fa-briefcase color-green"></i> <?php echo $corporation_type[$row->corporation_type]; ?> </li>
                                </ul>
                                <!--<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati</p>-->
                            </div>
                        </div>
                        <hr>
                        <!-- End Clients Block-->
                    <?php } */ ?>

                </div><!--/col-md-9-->
                
            <div class="table-responsive col-md-12 col-centered">
                    
                    <form class="form-horizontal" action="<?php echo base_url(). 'Con_Admin_Dashbord/search_company/'; ?>" method="post">
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <?php if ($this->user_type != 2 && $this->user_group != 12) { ?>
                                            <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_configaration/add_company_setting" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add </a></br></br>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Company </label>
                                    <div class="col-sm-8">
                                        <select name="company_idd" id="company_idd" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($com_query->result() as $row) {
                                                $slct = ($search_criteria['company_idd'] == $row->id) ? 'selected' : '';
                                                echo '<option value="' . $row->id . '" ' . $slct . '>' . $row->company_full_name . '</option>';
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
                    
                <table id="dataTables-example" class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Billing</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if ($this->user_group == 11 || $this->user_group == 12) {
                            if (!empty($search_ids)) {
                                $this->db->where_in('id', $search_ids);
                            }
                            $query = $this->db->get_where('main_company', array('id' => $this->company_id));
                        } else {
                            if (!empty($search_ids)) {
                                $this->db->where_in('id', $search_ids);
                            }
                            $query = $this->db->get_where('main_company', array('user_id' => $this->user_id));
                        }
                        //echo $this->db->last_query();

                        $billing_cycle_arr = $this->Common_model->get_array('billing_cycle');
                        $billing_type_arr = $this->Common_model->get_array('billing_type');
                        $status_arr = $this->Common_model->get_array('status');
                        
                        $total_emp=0;
                        if ($query) {
                            foreach ($query->result() as $row) {
                                
                                $this->db->where('company_id', $row->id);
                                $total_emp=$this->db->count_all_results('main_employees');
                                
                                if ($row->company_logo == "") {
                                    $logo = base_url() . "uploads/blank.png";
                                } else {
                                    $logo = base_url() . "uploads/companylogo/" . $row->company_logo;
                                }
                                ?>
                        <!--onclick="edit_row('<?php // echo $row->id; ?>');" style="cursor: pointer;"-->
                                <tr>
                                    <td style="">
                                        <div class="testimonial-info">
                                            <a href="<?php echo base_url() . 'Con_ChangeCompany/change_Companybyadmin/' . $row->id; ?>">
                                            <img class="rounded-x" src="<?php echo $logo; ?>" alt="No Image" height="55" width="55">
                                            </a>
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Legal Name :
                                                <a href="<?php echo base_url() . 'Con_ChangeCompany/change_Companybyadmin/' . $row->id; ?>">
                                                <?php echo ucwords($row->company_full_name); ?> 
                                                </a>
                                            </div>
                                            <div class="row">DBA Name : <?php echo ucwords($row->company_short_name) ?></div>
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Zip Code : <?php echo $row->zip_code ?></div>
                                            <div class="row">Phon : <?php echo $row->phone_1 ?></div>
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Email : <?php echo $row->email ?></div>
                                            <div class="row">Mobile Phone : <?php echo $row->mobile_phone ?></div>
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">No of Employee : <?php echo $total_emp; ?></div>
                                            <div class="row" >Status : <span style="color: #0000ff; "><?php echo $status_arr[$row->isactive] ?></span></div>
                                        </div>
                                    </td>
                                    <td>
                                        &nbsp;<a title="Edit Company" href="<?php echo base_url() . 'Con_configaration/edit_company_setting/' . $row->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        &nbsp;<a title="Download Report" href="<?php echo base_url() . 'Con_configaration/download_company_info/' . $row->id; ?>"><i class="fa fa-lg fa-download"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div><!--/container-->
        <!--=== End Content Part ===-->

    </div>
</div>

</div><!--/end row-->
</div><!--/end container-->


<script type="text/javascript">
    
    $(function () {
        $("#company_idd").select2({
            placeholder: "Select company",
            allowClear: true
        });
       
    });
    
    function edit_row(id)
    {
        window.location = base_url + "Con_configaration/edit_company_setting/" + id;
    }
  
</script>
