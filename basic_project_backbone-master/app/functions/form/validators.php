<?php

function validate_email($field_input, &$field) {
    $modelUser = new App\Users\Model();

    $users = $modelUser->get(['email' => $field_input]);
    if ($users) {
        $field['error'] = 'This email already exists';

        return false;
    }
    
    return true;
}

function validate_login($filtered_input, &$form) {
    $modelUsers = new \App\Users\Model();
    $user = $modelUsers->get([
        'email' => $filtered_input['email'],
        'password' => $filtered_input['password']
    ]);

    if (empty($user)) {
        $form['fields']['password']['error'] = 'Loggin failed!';

        return false;
    }

    return true;
}

function validate_match($filtered_input, &$form, $validator) {
    $first_pass = $filtered_input['password'];
    foreach ($validator as $field_to_validate) {
        if ($filtered_input[$field_to_validate] !== $first_pass) {
            $form['fields'][$field_to_validate]['error'] = 'Password did not match...';

            return false;
        }
    }

    return true;
}
