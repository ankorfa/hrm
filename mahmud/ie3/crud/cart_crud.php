<?php

function to_mysql_date($date = "00/00/0000") {
    list($M, $D, $Y) = explode('/', $date);
    return $Y . '-' . $M . '-' . $D;
}

function check_post_data_validity($ARR = array()) {
    $isValid = TRUE;

    if (!empty($ARR)) {
        foreach ($ARR as $key => $error_field_name) {
            if (isset($_POST[$key]) && ($_POST[$key] == '')) {
                $isValid = FALSE;
                display_error('The field *' . $error_field_name . ' is Required!');
            }
        }
    }

    return $isValid;
}

function check_cart_validity() {
    $isValid = TRUE;

    if (isset($_POST['emp_name']) && ($_POST['emp_name'] == '')) {
        $isValid = FALSE;
        display_error('The field *Name is Required!');
    }
    if (isset($_POST['emp_age']) && ($_POST['emp_age'] == '')) {
        $isValid = FALSE;
        display_error('The field *Age is Required!');
    }
    if (isset($_POST['basic_salary']) && ($_POST['basic_salary'] == '')) {
        $isValid = FALSE;
        display_error('The field *Basic is Required!');
    }
    if (isset($_POST['h_rent']) && ($_POST['h_rent'] == '')) {
        $isValid = FALSE;
        display_error('The field *H.Rent is Required!');
    }
    if (isset($_POST['emp_name']) && ($_POST['emp_name'] == '')) {
        $isValid = FALSE;
        display_error('The field *Medical is Required!');
    }
    if (isset($_POST['medical']) && ($_POST['medical'] == '')) {
        $isValid = FALSE;
        display_error('The field *Name is Required!');
    }
    if (isset($_POST['coveyance']) && ($_POST['coveyance'] == '')) {
        $isValid = FALSE;
        display_error('The field *Coveyance is Required!');
    }
    if (isset($_POST['food_allowance']) && ($_POST['food_allowance'] == '')) {
        $isValid = FALSE;
        display_error('The field *Food A. is Required!');
    }
    if (isset($_POST['gross_salary']) && ($_POST['gross_salary'] == '')) {
        $isValid = FALSE;
        display_error('The field *Gross is Required!');
    }

    return $isValid;
}

function save_into_cart($post_data, $cart_key = NULL) {
    $cart_data = array(
        'emp_name' => $post_data['emp_name'],
        'emp_dsgn' => $post_data['dsgn_list'],
        'emp_dept' => $post_data['dept_list'],
        'age' => $post_data['emp_age'],
        'gender' => $post_data['emp_gender'],
        'basic_salary' => $post_data['basic_salary'],
        'h_rent' => $post_data['h_rent'],
        'medical' => $post_data['medical'],
        'coveyance' => $post_data['coveyance'],
        'food_allowance' => $post_data['food_allowance'],
        'gross_salary' => $post_data['gross_salary']
    );

    if (($cart_key != NULL) && (is_numeric($cart_key) && ($cart_key >= 0))) {
        $_SESSION['employee_list'][$cart_key] = $cart_data;
    } else if (empty($_SESSION['employee_list'])) {
        $_SESSION['employee_list'][1] = $cart_data;
    } else {
        $_SESSION['employee_list'][] = $cart_data;
    }
}

function insert_cart_into_db() {
    $Arr = array(
        'branch_name' => $_POST['branch_name'],
        'launching_date' => to_mysql_date($_POST['launch_date']),
        'location' => $_POST['location'],
    );
    $branch_id = db_insert('crud_branch', $Arr);

    if (isset($_SESSION['employee_list']) && (!empty($_SESSION['employee_list']))) {
        foreach ($_SESSION['employee_list'] as $key => $row) {
            $Arr2 = array(
                'branch_id' => $branch_id,
                'emp_name' => $row['emp_name'],
                'emp_dsgn' => $row['emp_dsgn'],
                'emp_dept' => $row['emp_dept'],
                'age' => $row['age'],
                'gender' => $row['gender'],
                'basic_salary' => $row['basic_salary'],
                'h_rent' => $row['h_rent'],
                'medical' => $row['medical'],
                'coveyance' => $row['coveyance'],
                'food_allowance' => $row['food_allowance'],
                'gross_salary' => $row['gross_salary'],
                'is_active' => 1
            );
            db_insert('crud_emp', $Arr2);
        }
    }

    clear_post_fields();
    $_SESSION['employee_list'] = array();
}
