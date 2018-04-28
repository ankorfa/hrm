<?php

/* * ********************************************************************
  Copyright (C) FrontAccounting, LLC.
  Released under the terms of the GNU General Public License, GPL,
  as published by the Free Software Foundation, either version 3
  of the License, or (at your option) any later version.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
  See the License here <http://www.gnu.org/licenses/gpl-3.0.html>.
 * ********************************************************************* */
$page_security = 'SA_SALESTRANSVIEW';
$path_to_root = "../..";
include_once($path_to_root . "/includes/db_pager.inc");
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/sales/includes/sales_ui.inc");
include_once($path_to_root . "/sales/includes/sales_db.inc");
include_once($path_to_root . "/reporting/includes/reporting.inc");

simple_page_mode(true);

//get employee id from employee table
//print_r($_GET['employee_id']);
//$selected_id = $_GET['employee_id'];



start_outer_table(TABLESTYLE2);
table_section(1);
table_section_title(_("Second Demo of Employee"));

text_row(_("Second Department Name:"), 'depName', $_POST['depName'], 40, 80);
text_row(_("Department Position"), 'depEducation', $_POST['depEducation'], 30, 30);


end_outer_table(1);

div_start('controls');
submit_center('ADD_ITEM', _("Add New Department"), true, '', 'default');

div_end();

if ($Mode == 'ADD_ITEM') {
    //display_error($_POST['employee_id']);
    add_dep_type($_POST['depName'], $_POST['depEducation'], $_POST['employee_id']);
    display_notification(_('New data type has been added'));
    $Mode = 'RESET';
    unset($_POST['depName'], $_POST['depEducation']);
}

//function call for insert department
function add_dep_type($depName, $depEducation, $empid) {

    $sql = "INSERT INTO " . TB_PREF . "department(depName,education,empid) VALUES (" . db_escape($depName) . ","
            . db_escape($depEducation) . "," . db_escape($empid) . ")";
    db_query($sql, "could not add db page");

//    $dd=  db_fetch(db_query($sql));
    //display_error(print_r($dd,1));
}
?>
