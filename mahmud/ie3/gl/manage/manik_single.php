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
$page_security = 'SA_SALESTYPES';
$path_to_root = "../..";


//page(_($help_context = "Manik Single"));

include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/sales/includes/db/sales_types_db.inc");
include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/manufacturing.inc");
include_once($path_to_root . "/includes/data_checks.inc");

$js = "";
if ($use_popup_windows)
    $js .= get_js_open_window(800, 500);
if ($use_date_picker)
    $js .= get_js_date_picker();
page(_($help_context = "Manik Single Page"), false, false, "", $js);

check_db_has_purchasable_items(_("There are no purchasable inventory items defined in the system."));
check_db_has_suppliers(_("There are no suppliers defined in the system."));

simple_page_mode(true);
//-----------------------------------------------------------------------------------

if ($Mode == 'ADD_ITEM') {
    $ddd = implode(',', $_POST['hobbi']);

    add_form_type($_POST['name'], $_POST['address'], $_POST['date'], $ddd, $_POST['first_num'], $_POST['second_num']);
    display_notification(_('New data type has been added'));
    $Mode = 'RESET';
}

/* ------------------------------------------------------------ */
if ($Mode == 'Delete') {
    delete_form_type($selected_id);
    display_notification(_('Selected sales type has been deleted'));

    $Mode = 'RESET';
}

/* ------------------------------------------- */

if ($Mode == 'UPDATE_ITEM') {
    //display_error($_POST['date']);
    $ddd = implode(',', $_POST['hobbi']);
    //display_error(print_r($ddd,1));
    //exit();
    update_form_type($selected_id, $_POST['name'], $_POST['address'], $_POST['date'], $ddd);
    display_notification(_('Selected Value has been updated'));
    $Mode = 'RESET';
}

start_form();
start_table(TABLESTYLE, "width='30%'");

$th = array(_('Name'), _('Address'), _('Date'), _('Hobbey'), _('firstvalue'),_('secondvalue'),_('finalvalue'), '', '');
inactive_control_column($th);
table_header($th);
$k = 0;
//$base_sales = get_base_sales_type();
$result = get_all_form_types();
while ($myrow = db_fetch($result)) {
//	if ($myrow["id"] == $base_sales)
//	    start_row("class='overduebg'");
//	else
//	    alt_table_row_color($k);

    $ff = get_hobb_name($myrow["hobbbbbbi"]);
    //display_error(print_r($ff,1));
    
    //$amount = $myrow["firstnum"];
    $amount=$myrow["secondnum"]/100*$myrow["firstnum"];
    label_cell($myrow["name"]);
    label_cell($myrow["address"]);
    label_cell($myrow["ad_date"]);
    label_cell($ff);
    label_cell($myrow["firstnum"]);
    label_cell($myrow["secondnum"]);
    label_cell($amount);

    //inactive_control_cell($myrow["id"], $myrow["inactive"], 'and', 'id');
    edit_button_cell("Edit" . $myrow['id'], _("Edit"));
    delete_button_cell("Delete" . $myrow['id'], _("Delete"));
    end_row();
}

end_table();

//display_note(_("Marked sales type is the company base pricelist for prices calculations."), 0, 0, "class='overduefg'");
//===================================================================================//

start_table(TABLESTYLE2);

if ($selected_id != -1) {

    if ($Mode == 'Edit') {
        $myrow = get_form_type($selected_id);
//        $sql = "SELECT * FROM " . TB_PREF . "hobbies"; 
//        $query = db_query($sql);


        $_POST['name'] = $myrow["name"];
        $_POST['address'] = $myrow["address"];
        $_POST['date'] = ($myrow["ad_date"]);
        //multiple value trim then checkbox checked when click edit button
        $ab = explode(',', $myrow["hobbbbbbi"]);
    }
    hidden('selected_id', $selected_id);
} else {
    //$_POST['factor']  = number_format2(1,4);
}
br(3);

text_row_ex(_("Name") . ':', 'name', 20);
textarea_row(_("Address") . ':', 'address', $Post['address'], 30, 3);
date_row("Date: ", 'date', 'calender');
per_form_list_cells(_("Name List:"), 'as_name', $_POST['as_name'], true);
//$sql = "SELECT id, name FROM and"; 
label_row("Hobby :");

//$category_name = data_retrieve('stock_category', 'category_id', $item_id);
//label_row($category_name['description'], '<input type="checkbox" name="mach_ID[' . $item_id . ']" value=' . db_escape($item_id) . '>', "class='tableheader2'", "class='tableheader'");


$sql = "SELECT * FROM " . TB_PREF . "hobbies";
$query = db_query($sql);
while ($row = db_fetch($query)) {

    if (in_array($row['id'], $ab)) {
        //when edit button click then check field automatically checked
        label_row($row['hob_name'], '<input type="checkbox"  name="hobbi[' . $row['id'] . ']" value=' . db_escape($row['id']) . ' checked >', "class='tableheader2'", "class='tableheader'");
    } else {
        //when value insert into database then checkbox value manually checked
        label_row($row['hob_name'], '<input type="checkbox"  name="hobbi[' . $row['id'] . ']" value=' . db_escape($row['id']) . '>', "class='tableheader2'", "class='tableheader'");
    }
}
text_row_ex(_("First Number") . ':', 'first_num', $Post['first_num'], 20);
percent_row(_("Second Number") . ':', 'second_num', $Post['second_num'], 20);

//label_cell('<input type="checkbox" name="vehicle[]" value="1">SSC');
//label_cell('<input type="checkbox" name="vehicle[]" value="2">HSC');
//label_cell('<input type="checkbox" name="vehicle[]" value="3">BBA');
//label_cell('<input type="checkbox" name="vehicle[]" value="4">MBA');
//$a=  db_fetch(db_query($sql));
//combo_input(_("Name"), null, $sql, 'name','name');
//combo_input(_('name2'),null,$a);
end_table(1);
//submit_center('ADD_ITEM', _("Add new"));
//button for update or add item
submit_add_or_update_center($selected_id == -1, '', 'both');

//submit_add_or_update_center($selected_id == -1, '', 'both');
//text_row_ex(_("Name").':', 'name', 20);
//text_row_ex(_("Address").':', 'address',  20);
//text_row_ex(_("Date").':', 'ad_date', 20);


function add_form_type($name, $address, $adDate, $hobby, $firtnum, $secondnum) {


    $sql = "INSERT INTO " . TB_PREF . "manik(name,address,ad_date,hobbbbbbi,firstnum,secondnum) VALUES (" . db_escape($name) . ","
            . db_escape($address) . "," . db_escape(date2sql($adDate)) . "," . db_escape($hobby) . "," . db_escape($firtnum) . "," . db_escape($secondnum) . ")";
    db_query($sql, "could not add db page");
}

function update_form_type($id, $name, $address, $adDate, $hobby) {

    $sql = "UPDATE " . TB_PREF . "manik  SET name = " . db_escape($name) . ",
	address =" . db_escape($address) . ", ad_date=" . db_escape(date2sql($adDate)) . ",hobbbbbbi=" . db_escape($hobby) . " WHERE id = " . db_escape($id);

    db_query($sql, "could not update demo page type");
}

function get_all_form_types() {
    $sql = "SELECT * FROM " . TB_PREF . "manik";
//	if (!$all)
//		$sql .= " WHERE !inactive";

    return db_query($sql, "could not get all sales types");
}

/* ============================================================================ */

function per_form_list($name, $selected_id = null, $all_option = false, $submit_on_change = false) {
    global $all_items;

    $sql = "SELECT id,name FROM " . TB_PREF . "manik";
//	$query1 = db_query($sql);
//	$query = db_fetch($query1);
//        display_error(print_r($query,2));       




    return combo_input($name, $selected_id, $sql, 'id', 'name', array(
        'spec_option' => $all_option === true ? _("Select") : $all_option,
        'spec_id' => $all_items,
        'select_submit' => $submit_on_change
            ));
}

function per_form_list_cells($label, $name, $selected_id = null, $all_option = false, $submit_on_change = false) {
    if ($label != null)
        echo "<td>$label</td>\n";
    echo "<td>";
    echo per_form_list($name, $selected_id, $all_option, $submit_on_change);
    echo "</td>\n";
}

function per_name_list_row($label, $name, $selected_id = null, $all_option = false, $submit_on_change = false) {
    echo "<tr><td class='label'>$label</td>";
    per_locations_list_cells(null, $name, $selected_id, $all_option, $submit_on_change);
    echo "</tr>\n";
}

/* ============================combox box value show================================================ */

function get_hobb_name($hobbs) {
    $dd = explode(',', $hobbs);
    $ddd = array();
    foreach ($dd as $det) {
        $ddd[] = get_hb_name($det);
    }
    $kk = implode(',', $ddd);
    return $kk;
}

function get_hb_name($id) {
    $sql = "SELECT hob_name FROM " . TB_PREF . "hobbies WHERE id =" . db_escape($id);
    $res = db_fetch(db_query($sql));
    //display_error(print_r($res,1));
    return $res['hob_name'];
}

/* ----------------------------------------------------------- */

function percantage_calculate() {
    //display_error(555555);
//   $firstnum=$_POST('first_num');    
//   $secondnum=$_POST('first_num');
    $sql="SELECT id, firstnum,secondnum FROM " . TB_PREF . "manik";
   $res = db_fetch(db_query($sql));
    display_error(print_r($res,1));
   $thirdnum=$secondnum/100*$firstnum;
   return $thirdnum; 
}

end_form();

end_page();
?>



