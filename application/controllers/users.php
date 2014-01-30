<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author Syiewa
 */
class Users extends Frontend_Controller {

    //put your code here
    var $template = 'web/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_provinsi');
    }

    public function index() {
        $this->data['content'] = 'web/users/home';
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('users/login', 'refresh');
        } else {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['users'] = $this->ion_auth->users()->result();
            foreach ($this->data['users'] as $k => $user) {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }

            $this->_render_page($this->template, $this->data);
        }
    }

    function login() {
        if ($this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('users/index', 'refresh');
        } else {
            $this->data['meta_title'] = "Login";
            $this->data['content'] = 'web/users/login';
            //validate form input
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == true) {
                //check to see if the user is logging in
                //check for "remember me"
                $remember = (bool) $this->input->post('remember');
                $uri = $this->input->post('uri');

                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    //if the login is successful
                    //redirect them back to the home page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    ($uri == 'booking/guest') ? redirect($uri, 'refresh') : redirect('users', 'refresh');
                } else {
                    //if the login was un-successful
                    //redirect them back to the login page
                    $this->session->set_flashdata('message', 'Gagal Login Kesalahan Email/Password');
                    ($uri == 'booking/guest') ? redirect($uri, 'refresh') : redirect('users/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
                }
            } else {
                //the user is not logging in so display the login page
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['identity'] = array('name' => 'identity',
                    'id' => 'identity',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('identity'),
                );
                $this->data['password'] = array('name' => 'password',
                    'id' => 'password',
                    'type' => 'password',
                );

                $this->_render_page($this->template, $this->data);
            }
        }
    }

    //log the user out
    function logout() {
        $this->data['meta_title'] = "Logout";

        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('users/login', 'refresh');
    }

    public function register() {
        if ($this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('users/index', 'refresh');
        }
        $this->data['meta_title'] = "Register";
        $this->data['content'] = 'web/users/registration';
        $this->data['provinsi'] = $this->m_provinsi->get_provinsi();
        $this->data['prefix_name'] = array(
            'name' => 'prefix_name',
            'id' => 'prefix_name',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prefix_name', empty($user->prefix_name) ? '' : $user->prefix_name),
        );
        $this->data['first_name'] = array(
            'name' => 'first_name',
            'data-validation' => 'required',
            'id' => 'first_name',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', empty($user->first_name) ? '' : $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'data-validation' => 'required',
            'id' => 'last_name',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', empty($user->last_name) ? '' : $user->last_name),
        );
        $this->data['email'] = array(
            'name' => 'email',
            'data-validation' => 'email server',
            'data-validation-url' => site_url('users/cek_email'),
            'id' => 'email',
            'class' => 'form-control',
            'type' => 'email',
            !$this->ion_auth->logged_in() ? ' ' : 'readonly' => 'readonly',
            'value' => $this->form_validation->set_value('email_confirmation', empty($user->email) ? '' : $user->email),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'data-validation' => 'required number',
            'id' => 'phone',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', empty($user->phone) ? '' : $user->phone),
        );
        if ($this->input->post('submit')) {
            $data = $this->m_user->array_from_post(array(
                'idclass', 'prefix_name', 'first_name', 'last_name', 'email', 'phone', 'alamat', 'zip', 'kota', 'provinsi', 'negara'
            ));
            $username = strtolower($data['first_name']) . ' ' . strtolower($data['last_name']);
            $email = strtolower($data['email']);
            $password = $this->input->post('pass');
            $additional_data = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'prefix_name' => $data['prefix_name'],
                'phone' => $data['phone'],
            );
            if ($this->ion_auth->register($username, $password, $email, $additional_data)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->load->library('email');
                $config['protocol'] = 'mail';
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->send();

                redirect('users/register');
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect('users/register');
            }
        }
        $this->load->view($this->template, $this->data);
    }

    public function address() {
        $data = $this->m_user->array_from_post(array(
            'alamat', 'kota', 'provinsi', 'negara', 'user_id', 'zip'
        ));
        if ($this->m_user->get_by(array('user_id' => $data['user_id']))) {
            $this->m_user->update_by(array('user_id' => $data['user_id']), $data);
            $this->session->set_flashdata('success', 'Data Saved');
            redirect('users/edit_user/' . $data['user_id'], 'refresh');
        } else {
            $this->m_user->insert($data);
            $this->session->set_flashdata('success', 'Data Saved');
            redirect('users/edit_user/' . $data['user_id'], 'refresh');
        }
    }

    public function edit_user($id) {
        $this->data['meta_title'] = "Edit Profile";
        $this->data['content'] = 'web/users/edit_user';
        $this->data['provinsi'] = $this->m_provinsi->get_provinsi();
        $this->data['address'] = $this->m_user->get_by(array('user_id' => $id));

        if (!$this->ion_auth->logged_in()) {
            redirect('users', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
        $this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            $data = array(
                'prefix_name' => $this->input->post('prefix_name'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
            );
            //Update the groups user belongs to
            $groupData = $this->input->post('groups');

            if (isset($groupData) && !empty($groupData)) {

                $this->ion_auth->remove_from_group('', $id);

                foreach ($groupData as $grp) {
                    $this->ion_auth->add_to_group($grp, $id);
                }
            }

            //update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

                $data['password'] = $this->input->post('password');
            }

            if ($this->form_validation->run() === TRUE) {
                $this->ion_auth->update($user->id, $data);
                $username = array(
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name']
                );
                $this->session->set_userdata($username);
                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('success', "User Saved");
                redirect("users/edit_user/" . $id, 'refresh');
            }
        }

        //display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;
        $this->data['prefix_name'] = array(
            'name' => 'prefix_name',
            'id' => 'prefix_name',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('prefix_name', $user->prefix_name),
        );
        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'class' => 'form-control',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'class' => 'form-control',
            'type' => 'password'
        );

        $this->_render_page($this->template, $this->data);
    }

    public function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
            $this->ion_auth->logout();
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', 'Activation Succesful Please Login');
            redirect("users/login", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("users/forgot_password", 'refresh');
        }
    }

    public function deactivate($id = NULL) {
        $this->data['content'] = 'admin/users/deactivate_user';
        $id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            $this->_render_page('admin/modal', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('admin/users', 'refresh');
        }
    }

    function forgot_password() {
        if ($this->ion_auth->logged_in()) {
            redirect('users');
        }
        $this->data['meta_title'] = 'Forgot Password';
        $this->data['content'] = 'web/users/forgot_password';
        $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required');
        if ($this->form_validation->run() == false) {
            //setup the input
            $this->data['email'] = array('name' => 'email',
                'id' => 'email', 'class' => 'form-control',
            );

            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            //set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->_render_page($this->template, $this->data);
        } else {
            // get identity for that email
            $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            if (empty($identity)) {
                $this->ion_auth->set_message('forgot_password_email_not_found');
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("users/forgot_password", 'refresh');
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("users/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("users/forgot_password", 'refresh');
            }
        }
    }

    public function reset_password($code = NULL) {
        if ($this->ion_auth->logged_in()) {
            redirect('users');
        }
        $this->data['meta_title'] = 'Reset Password';
        $this->data['content'] = 'web/users/reset_password';
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            //if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                //display the form
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'class' => 'form-control',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'class' => 'form-control',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                //render
                $this->_render_page($this->template, $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        $this->logout();
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('users/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("users/forgot_password", 'refresh');
        }
    }

    public function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    public function _valid_csrf_nonce() {
        return TRUE;
    }

    public function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

    public function list_dropdown() {
        $this->load->model('m_provinsi');
        $id = $this->input->post('tnmnt');
        $cct = $this->input->post('csrf_test_name');
        $this->data['kota'] = $this->m_provinsi->get_kota($id);
        $this->load->view('web/booking/kota', $this->data);
    }

    public function cek_email() {
        $email = $this->input->post('email');
        $response = array(
            'valid' => false,
            'message' => 'Post argument "user" is missing.'
        );
        if (isset($email)) {
            if ($this->ion_auth->email_check($email)) {
                $response = array('valid' => false, 'message' => 'Email already exist');
            } else {
                $response = array('valid' => true);
            }
        }
        echo json_encode($response);
    }

}

?>
