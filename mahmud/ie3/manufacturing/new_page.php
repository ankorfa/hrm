<?php
$page_security = 'SA_MANUFTRANSVIEW';
$path_to_root = "..";
include($path_to_root . "/includes/db_pager.inc");
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/manufacturing/includes/manufacturing_ui.inc");
$js = "";
if ($use_popup_windows)
	$js .= get_js_open_window(800, 500);
if (isset($_GET['outstanding_only']) && ($_GET['outstanding_only'] == true))
{
// curently outstanding simply means not closed
	$outstanding_only = 1;
	page(_($help_context = "Search Outstanding Work Orders"), false, false, "", $js);
}
else
{
	$outstanding_only = 0;
	page(_($help_context = "Search Work Orders"), false, false, "", $js);
}
//-----------------------------------------------------------------------------------
// Ajax updates
//
if (get_post('SearchOrders')) 
{
	$Ajax->activate('orders_tbl');
} elseif (get_post('_OrderNumber_changed')) 
{
	$disable = get_post('OrderNumber') !== '';

	$Ajax->addDisable(true, 'StockLocation', $disable);
	$Ajax->addDisable(true, 'OverdueOnly', $disable);
	$Ajax->addDisable(true, 'OpenOnly', $disable);
	$Ajax->addDisable(true, 'SelectedStockItem', $disable);

	if ($disable) {
		set_focus('OrderNumber');
	} else
		set_focus('StockLocation');

	$Ajax->activate('orders_tbl');
}

//--------------------------------------------------------------------------------------

if (isset($_GET["stock_id"]))
	$_POST['SelectedStockItem'] = $_GET["stock_id"];

//--------------------------------------------------------------------------------------

start_form(false, false, $_SERVER['PHP_SELF'] ."?outstanding_only=$outstanding_only");

start_table(TABLESTYLE_NOBORDER);
start_row();
ref_cells(_("#:"), 'OrderId', '',null, '', true);
ref_cells(_("Reference:"), 'OrderNumber', '',null, '', true);

locations_list_cells(_("at Location:"), 'StockLocation', null, true);

end_row();
end_table();
start_table(TABLESTYLE_NOBORDER);
start_row();

check_cells( _("Only Overdue:"), 'OverdueOnly', null);

if ($outstanding_only==0)
	check_cells( _("Only Open:"), 'OpenOnly', null);

stock_manufactured_items_list_cells(_("for item:"), 'SelectedStockItem', null, true);

submit_cells('SearchOrders', _("Search"),'',_('Select documents'),  'default');
end_row();
end_table();




$sql ="SELECT emp_id, emp_name, age, gender, basic_salary, h_rent, medical, coveyance, food_allowance, gross_salary FROM 0_crud_emp";

$cols = array(
	_("#") => array( 'ord'=>''), 
	_("Reference"),
	_("Type") => array(''),
	_("Location"), 
	_("Item") => array('ord'=>''),
	_("Required") => array( 'align'=>'right'),
);

$table =& new_db_pager('orders_tbl', $sql, $cols,null,null,3);
$table->width = "90%";
display_db_pager($table);

end_form();
end_page();
?>
