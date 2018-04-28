
<style>
    .obrevtbl > thead > tr {
        background-color: #dff0d8;
        color: #3c763d;
    }
</style>
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div id="employee_review_div">   
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-u">
                        <div class="panel-heading">
                            Alert Information
                        </div>
                        <div class="panel-body col-lg-8" style="margin-left: 200px"> 

                            <?php
                            if ($this->user_group == 11 || $this->user_group == 12) {
                                $query = $this->db->get_where('main_alert_policy', array('company_id' => $this->company_id, 'isactive' => 1, 'alert_item' => 1))->row();
                            } else {
                                $query = $this->db->get_where('main_alert_policy', array('isactive' => 1, 'alert_item' => 1))->row();
                            }
                            
                            if ($query) {
                                ?>

                                <div class="table-responsive">
                                    <p class="control-label" style="margin-top: 10px;"><b>Birthday Alert:</b></p>
                                    <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL </th>
                                                <th>Employee Name</th>
                                                <th>Date</th>
                                                <th>Send Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $alert_day = $query->alert_after_days;
                                            $c_date = date("Y-m-d").'<br>';
                                            $a_date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + $alert_day, date('Y')));
                                            
                                            $this->db->where('birthdate >=', $c_date);
                                            $this->db->where('birthdate <=', $a_date);
                                            $this->db->order_by("birthdate", "desc");
                                            $birth_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
                                            //echo $this->db->last_query();
                                            $i = 0;
                                            foreach ($birth_query->result() as $row) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td> <?php echo $i ?> </td>
                                                    <td ><?php echo $row->first_name ?></td>
                                                    <td ><?php echo $this->Common_model->show_date_formate($row->birthdate) ?></td>
                                                    <td ><div class="action-buttons "><a title="Send Message" href="#" onclick="alert_mail_fnc(<?php echo $row->employee_id; ?>,<?php echo 1; ?>)" ><i class="fa fa-envelope" aria-hidden="true"></i></a></div></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div> 
                            <?php
                            }


                            if ($this->user_group == 11 || $this->user_group == 12) {
                                $query = $this->db->get_where('main_alert_policy', array('company_id' => $this->company_id, 'isactive' => 1, 'alert_item' => 2))->row();
                            } else {
                                $query = $this->db->get_where('main_alert_policy', array('isactive' => 1, 'alert_item' => 2))->row();
                            }
                            if ($query) {
                                ?>

                            <div class="table-responsive">
                                    <p class="control-label" style="margin-top: 10px;"><b>Work Anniversaries:</b></p>
                                    <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL </th>
                                                <th>Employee Name</th>
                                                <th>Date</th>
                                                <th>Send Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $yr_mon_part = date("m", strtotime(date("Y-m-d")));
                                            $sql = "SELECT employee_id,first_name,position,hire_date FROM main_employees WHERE isactive='1' and company_id=" . $this->company_id . "  and hire_date like '" . "%-" . $yr_mon_part . "-%" . "' order by hire_date desc";
                                            $birth_query = $this->db->query($sql);
                                            $i = 0;
                                            foreach ($birth_query->result() as $row) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td> <?php echo $i ?> </td>
                                                    <td ><?php echo $row->first_name ?></td>
                                                    <td ><?php echo $this->Common_model->show_date_formate($row->hire_date) ?></td>
                                                    <td ><div class="action-buttons "><a title="Send Message" onclick="alert_mail_fnc(<?php echo $row->employee_id; ?>,<?php echo 2; ?>)"  href="#"><i class="fa fa-envelope" aria-hidden="true"></i> </a></div></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>                             
                            <?php
                            }

                            if ($this->user_group == 11 || $this->user_group == 12) {
                                $query = $this->db->get_where('main_alert_policy', array('company_id' => $this->company_id, 'isactive' => 1, 'alert_item' => 3))->row();
                            } else {
                                $query = $this->db->get_where('main_alert_policy', array('isactive' => 1, 'alert_item' => 3))->row();
                            }
                            if ($query) {
                                ?>

                            <div class="table-responsive">
                                    <p class="control-label" style="margin-top: 10px;"><b>Social Security Tax Remains:</b></p>                                
                                    <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl">
                                        <thead>
                                            <tr>
                                                <th>SL </th>
                                                <th>Employee Name</th>
                                                <th>Date</th>
                                                <th>Send Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $yr_mon_part = date("m", strtotime(date("Y-m-d")));
                                            $tsql = "SELECT employee_id,expiration_date FROM main_emp_license WHERE isactive='1' and company_id=" . $this->company_id . "  and expiration_date like '" . "%-" . $yr_mon_part . "-%" . "' order by expiration_date desc";
                                            $t_query = $this->db->query($tsql);
                                            $i = 0;
                                            foreach ($t_query->result() as $row) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td> <?php echo $i ?> </td>
                                                    <td ><?php echo $this->Common_model->get_selected_value($this,"employee_id",$row->employee_id,"main_employees","first_name") ?></td>
                                                    <td ><?php echo $this->Common_model->show_date_formate($row->expiration_date) ?></td>
                                                    <td ><div class="action-buttons "><a title="Send Message" onclick="alert_mail_fnc(<?php echo $row->employee_id; ?>,<?php echo 3; ?>)" href="#"><i class="fa fa-envelope" aria-hidden="true"></i> </a></div></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>                             
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script>

    function alert_mail_fnc(id,alertitem)
    { 
        var data=id + '_' +alertitem;
        
        loading_box(base_url);
        $.ajax({
            url: "<?php echo site_url('Con_Alert_Information/add_send_message/') ?>/" + data,
            async: false,
            type: "POST",
            success: function (data) {
                var url='<?php echo base_url() ?>Con_Alert_Information';
                view_message(data,url,'','');
            }
        })
    }

</script>

