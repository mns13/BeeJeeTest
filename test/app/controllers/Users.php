<?php
  class Users extends Controller {

    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function register(){
      //check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // init data
        $data = [
          'name' => trim($_POST['name']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        } else {
          // Check name
          if($this->userModel->findUserByName($data['name'])){
            $data['name_err'] = 'This name is already taken';
          }
        }
        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        } elseif(strlen($data['password']) < 3){
          $data['password_err'] = 'Password must be at least 6 characters';
        }
        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm password';
        } else{
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Hash password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data)){
            flash('register_success', 'You are registered and can log in');
            redirect('users/login');
          } else {
            die('Something wrong');
          }

        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }

      } else {
        // init data
        $data = [
          'name' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];
          
        //Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      //check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // init data
        $data = [
          'name' => trim($_POST['name']),
          'password' => trim($_POST['password']),
          'name_err' => '',
          'password_err' => ''
        ];

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter Your name';
        }
        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/name
        if($this->userModel->findUserByName($data['name'])){
          // User found
        } else {
          $data['name_err'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['name_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in userModel
          $loggedInUser = $this->userModel->login($data['name'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/login', $data);
          }

        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }
      } else {
        // init data
        $data = [
          'name' => '',
          'password' => '',
          'name_err' => '',
          'password_err' => ''
        ];

        //Load view
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_name'] = $user->name;
      $_SESSION['user_status'] = $user->status;
      redirect('posts');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['name']);
      unset($_SESSION['user_status']);
      session_destroy();
      redirect('users/login');
    }

  }