<?php

$page_security = 'SA_CUSTOMER'; // Page Security Key
$path_to_root = "..";

include_once($path_to_root . "/includes/db_pager.inc");
include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/includes/ui/ui_input.inc");
include_once($path_to_root . "/includes/db/common_db_crud.inc");
include_once($path_to_root . "/crud/crud_js.php");

page(_($help_context = "Page Header"));

$tbl_fields = 'emp_id, emp_name, age, gender, basic_salary, h_rent, medical, coveyance, food_allowance, gross_salary';
$sql = db_tbl_fetch('crud_emp', $tbl_fields);
$cols = array(
    'emp_id' => 'skip',
    _("Employee Name"),
    _("Age"),
    _("Gender") => array('fun' => 'check_gender'),
    _("Basic Salary"),
    _("House Rent"),
    _("Medical"),
    _("Conveyance"),
    _("Food Allowance"),
    _("Gross Salary")
);

start_form();
$table = & new_db_pager('employee_tbl', $sql, $cols, null, null, 4);
$table->width = "70%";
display_db_pager($table);
end_form();

end_page();
