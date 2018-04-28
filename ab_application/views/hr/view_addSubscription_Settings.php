<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;">
            <div class="col-md-10 col-md-offset-1">
                <?php
                //print_r($users_query);
                if ($type == 2) {//edit Subscription_Settings
                    ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Subscription_Settings/edit_Subscription_data" enctype="multipart/form-data" role="form" >
                        <?php foreach ($users_query->result() as $row): ?> 
                            <div class="col-md-12 pull-right">
                                <label class="col-sm-12 pull-right"><u><h4>User Information : </h4></u></label>
                            </div>
                            <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">User Name </label>
                                <div class="col-sm-4">
                                    <input type="text" name="name" id="name" value="<?php echo ucwords($row->name) ?>" class="form-control input-sm" placeholder="User Name" />
                                </div>
                                <label class="col-sm-2 control-label">User Email </label>
                                <div class="col-sm-4">
                                    <input type="email" name="email" id="email" value="<?php echo $row->email ?>" class="form-control input-sm" placeholder="User Email" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">User Password </label>
                                <div class="col-sm-4">
                                    <input type="password" name="password" id="password" value="<?php echo $this->Common_model->decrypt($row->password); ?>" class="form-control input-sm" placeholder="User Password" />
                                </div>
                                <label class="col-sm-2 control-label">Confirm Password </label>
                                <div class="col-sm-4">
                                    <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $this->Common_model->decrypt($row->password); ?>" class="form-control input-sm" placeholder="Confirm Password" />
                                </div>
                            </div>
                        <?php endforeach; ?>
                            <br>
                        <?php foreach ($com_query->result() as $row): ?> 
                            <div class="col-md-12 pull-right">
                                <label class="col-sm-12 pull-right"><u><h4>Company Information : </h4></u></label>
                            </div>
                            <input type="hidden" value="<?php echo $row->id ?>" name="com_id"/>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Company Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="company_name" id="company_name" value="<?php echo ucwords($row->company_full_name) ?>" class="form-control input-sm" placeholder="Company Name" />
                                </div> 
                                <label class="control-label col-sm-2">Company Email</label>
                                <div class="col-sm-4">
                                    <input type="email" name="company_email" id="company_email" value="<?php echo $row->email ?>" class="form-control input-sm" placeholder="Company Email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Address 1</label>
                                <div class="col-sm-4">
                                    <textarea name="address_1" id="address_1" class="form-control input-sm" rows="2" placeholder="Address 1" title="Address 1"> <?php echo $row->address_1 ?> </textarea>
                                </div>
                                <label class="control-label col-sm-2">Address 2</label>
                                <div class="col-sm-4">
                                    <textarea name="address_2" id="address_2" class="form-control input-sm" rows="2" placeholder="Address 2" title="Address 2"> <?php echo $row->address_2 ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">City</label>
                                <div class="col-sm-4">
                                    <input type="text" name="city" id="city" value="<?php echo $row->city ?>" class="form-control input-sm" placeholder="City" />
                                </div> 
                                <label class="control-label col-sm-2">State</label>
                                <div class="col-sm-4">
                                    <select name="company_state" id="company_state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $state_query = $this->Common_model->listItem('main_state');
                                        foreach ($state_query->result() as $keyy):
                                            ?>
                                            <option value="<?php echo $keyy->id ?>" <?php if ($row->state == $keyy->id) echo "selected"; ?>><?php echo $keyy->state_abbr ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Zip Code</label>
                                <div class="col-sm-4">
                                    <input type="text" name="zip_code" id="zip_code" value="<?php echo $row->zip_code ?>" class="form-control input-sm" placeholder="Zip Code" />
                                </div> 
                                <label class="control-label col-sm-2">Mobile Phone</label>
                                <div class="col-sm-4">
                                    <input type="text" name="mobile_phone" id="mobile_phone" value="<?php echo $row->mobile_phone ?>" class="form-control input-sm" placeholder="Mobile Phone" />
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <br>
                            <?php 
                            if ($subs_query->num_rows() > 0)
                            {
                                foreach ($subs_query->result() as $row): ?> 
                                <div class="col-md-12 pull-right">
                                    <label class="col-sm-12 pull-right"><u><h4>Select Your Email Opt-in Options : </h4></u></label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="welcome_email" id="welcome_email" <?php if($row->welcome_email==1){ echo "checked";}?> /> Welcome Email
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="newslatter" id="newslatter" <?php if($row->newslatter==1){ echo "checked";}?>/> Newslatter
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="library_promo" id="library_promo" <?php if($row->library_promo==1){ echo "checked";}?> /> Library Promo
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="alerts" id="alerts" <?php if($row->alerts==1){ echo "checked";}?> /> Alerts
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="ebooks" id="ebooks" <?php if($row->ebooks==1){ echo "checked";}?> /> Ebooks , Checklist And Guides
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 pull-right">
                                    <label class="col-sm-12 pull-right"><u><h4>Subscription Settings : </h4></u></label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Start Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="start_date" id="start_date" value="<?php echo $this->Common_model->show_date_formate($row->start_date); ?>" class="form-control dt_pick input-sm" placeholder="Start Date" />
                                    </div> 
                                    <label class="control-label col-sm-2">End Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="end_date" id="end_date" value="<?php echo $this->Common_model->show_date_formate($row->end_date); ?>" class="form-control dt_pick input-sm" placeholder="End Date"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Type </label>
                                    <div class="col-sm-4">
                                        <select name="user_group" id="user_group" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($main_usergroup_query->result() as $key):
                                                ?>
                                                <option value="<?php echo $key->id ?>"<?php if ($row->user_group == $key->id) echo "selected"; ?>><?php echo $key->group_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <?php 
                                endforeach;

                            }
                            else {
                                ?>
                                <div class="col-md-12 pull-right">
                                    <label class="col-sm-12 pull-right"><u><h4>Select Your Email Opt-in Options : </h4></u></label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="welcome_email" id="welcome_email"/> Welcome Email
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="newslatter" id="newslatter"/> Newslatter
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="library_promo" id="library_promo"/> Library Promo
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="alerts" id="alerts"/> Alerts
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="ebooks" id="ebooks"/> Ebooks , Checklist And Guides
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 pull-right">
                                    <label class="col-sm-12 pull-right"><u><h4>Subscription Settings : </h4></u></label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Start Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="start_date" id="start_date"  class="form-control dt_pick input-sm" placeholder="Start Date" />
                                    </div> 
                                    <label class="control-label col-sm-2">End Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="end_date" id="end_date" class="form-control dt_pick input-sm" placeholder="End Date"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Type </label>
                                    <div class="col-sm-4">
                                        <select name="user_group" id="user_group" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($main_usergroup_query->result() as $key):
                                                ?>
                                                <option value="<?php echo $key->id ?>"><?php echo $key->group_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                </div>
                            <?php
                            }
                            ?>
                        
                            <div class="form-group">
                                <div class="modal-footer">
                                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Subscription_Settings" ?>">Close</a>
                                </div>
                            </div>

                    </form>
                    <?php
                }
                ?>
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
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Subscription_Settings';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });



    $("#company_state").select2({
        placeholder: "Select State",
        allowClear: true,
    });
    $("#user_group").select2({
        placeholder: "User Group",
        allowClear: true,
    });

    $(function () {
        $("#zip_code").mask("99999");
        $("#mobile_phone").mask("(999) 999-9999");
    });

</script>
<!--=== End Script ===-->

