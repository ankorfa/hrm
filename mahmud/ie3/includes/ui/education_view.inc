<?php
/**********************************************************************
    Copyright (C) FrontAccounting, LLC.
	Released under the terms of the GNU General Public License, GPL, 
	as published by the Free Software Foundation, either version 3 
	of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
    See the License here <http://www.gnu.org/licenses/gpl-3.0.html>.
***********************************************************************/
include_once($path_to_root. '/includes/ui/simple_crud_class.inc');
include_once($path_to_root . "/includes/db/crm_contacts_db.inc");

/*
	View/Edit class for contacts
*/

class education extends simple_crud {
    

	var $id;
	var $entity;
	var $sub_class;
	var $class;
	
	function education($name, $id, $class, $subclass=null) {
		$fields = array('degree','board','instname','passyear', 'result' 
			 =>array('fld'=>'education'));

		$this->simple_crud($name, $fields);
		$this->class = $class;
		$this->subclass = $subclass;
		$this->entity = $id;
                //display_error($this->entity );
	}


	function list_view() {
		br();
                

			
//				check_value('show_inactive'));
			start_table(TABLESTYLE, "width='80%'");

			$th = array(_('Degree'), _("Board"), _("Institute Name"), _("Passing Year"), _("Result"), 
				  '',
				"&nbsp;");
		//	inactive_control_column($th);

			table_header($th);
			$k = 0;
                        $education = get_education();

			//$myrow = db_fetch($education);
                        //display_error(print_r($myrow));
			while ($myrow = db_fetch($education))
			{
                           
					
				
					alt_table_row_color($k);
					label_cell($myrow["degree"]);
					label_cell($myrow["board"]);
					label_cell($myrow["instituteName"]);
					label_cell($myrow["passingYear"]);
					label_cell($myrow["result"]);
					
			

				 	edit_button_cell("{$this->name}Edit[{$myrow["eduid"]}]", _("Edit"));

			// delete button removes only category unless this is the last contact for this person
					delete_button_cell("{$this->name}Delete[{$myrow["eduid"]}]", _("Delete"));
                                        //delete_button_cell("Delete" . $myrow['eduid'], _("Delete"));
					end_row();
					
				}

				
			

//inactive_control_row($th);
			end_table(1);
	}
	
	function editor_view()
	{
		br();

		start_outer_table(TABLESTYLE);

		table_section(1);
		table_section_title(_("Contact data"));

		text_row(_("Degree:"), 'degree', @$this->data['degree'], 35, 40);
		text_row(_("Board:"), 'board', @$this->data['board'], 35, 40);
		text_row(_("Institute Name:"), 'instname', @$this->data['instituteName'], 35, 40);
                text_row(_("Passing Year:"), 'passyear', @$this->data['passingYear'], 35, 40);
                text_row(_("Result:"), 'result', @$this->data['result'], 35, 40);

//		crm_category_types_list_row(_("Contact active for:"), 'assgn', @$this->data['contacts'],
//			array('subclass' => @$this->subclass,
//				'class' => @$this->class, 
//				'multi' =>true)
//				);

//		text_row(_("Phone:"), 'phone', @$this->data['phone'], 32, 30);
//		text_row(_("Secondary Phone Number:"), 'phone2', @$this->data['phone2'], 32, 30);
//		text_row(_("Fax Number:"), 'fax', @$this->data['fax'], 32, 30);
//		email_row(_("E-mail:"), 'email', @$this->data['email'], 35, 55);

//		table_section(2);
//		table_section_title("&nbsp;");
//		textarea_row(_("Address:"), 'address', @$this->data['address'], 30, 4);
//		languages_list_row( _("Document Language:"), 'lang', @$this->data['lang'], _("Customer default"));
//
//		textarea_row(_("Notes:"), 'notes', @$this->data['notes'], 30, 4);
		end_outer_table(1);
	}

	function db_insert() {
			//$dat = $this->data;
                        //display_error($_POST['degree']);
			  add_edu_val($_POST['degree'],$_POST['board'],$_POST['instname'],$_POST['passyear'],$_POST['result']);
                          display_notification("Education data inserted");
                 return true;       
                        
        }

	function db_update() {
			 update_education($this->selected_id, $_POST['degree'], $_POST['board'], $_POST['instname'], 
				$_POST['passyear'], $_POST['result']);
                         display_notification("Education data has been updated");       
                         return true;
	}

	function insert_check() {
		if (strlen($_POST['degree']) == 0) {
			display_error(_("The degree name cannot be empty."));
			set_focus('degree');
			return false;
		}
		if (strlen($_POST['board']) == 0) {
			display_error(_("Contact board cannot be empty."));
			set_focus('board');
			return false;
		}
		if (count(@$_POST['instname']) == 0) {
			display_error(_("Institute Name can not be empty."));
			set_focus('assgn');
			return false;
		}
		return true; 
	}

	function db_read() {
            
		return get_education_list($this->selected_id);
	}

	function delete_check() {
            
            display_error("A data deleted");
		return true;
	}
	//
	//	Delete all contacts for person in current class/entity
	//
	function db_delete() {
            display_error($this->selected_id);
		if (delete_education($this->selected_id)) {
			// if this is the last relation - delete contact data
//			$rels = get_person_contacts($this->selected_id);
//			if (count($rels)==0) {
//				return delete_crm_person($this->selected_id);
//			}
		}
		return false;
	}
}

?>