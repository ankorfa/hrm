
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12" id="policyreview_div">
        <table id="dataTables-example-policyreview" class="table table-striped table-bordered dt-responsive table-hover nowrap">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Policy Name</th>
                    <th>Policy</th>
                    <th>Status</th>                            
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $this->db->get_where('main_emp_company_policies', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query) {
                    $sl = 0;
                    foreach ($query->result() as $row) {
                        $sl++;
                        ?>
                        <tr>
                            <td><?php echo $sl ?></td>
                            <td><?php echo $this->Common_model->get_name($this, $row->policy_id, 'main_company_policies', 'policy_name'); ?></td>
                            <td class="td-cw"><p><?php echo $this->Common_model->get_name($this, $row->policy_id, 'main_company_policies', 'custom_text'); ?></p></td>
                            <td><?php echo ($row->is_aggree = 1 ? 'Agree' : 'Disagree'); ?></td>                            
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->

</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#dataTables-example-policyreview').dataTable({
            "order": [0, "desc"],
            "pageLength": 10,
//            $("table td").removeClass();
        });
    });
</script>