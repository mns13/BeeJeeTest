<?php
  class Posts extends Controller {

    public function __construct(){
      $this->postModel = $this->model('Post');
      $this->userModel = $this->model('User');
    }

    public function index(){
      $page = 0;
      $limit = 3;
      $posts = $this->postModel->limitPosts($page, $limit);
      $count = count($this->postModel->getPosts());
      
      $data = [
        'posts' => $posts,
        'count' =>$count
      ];

      // Load a view
      $this->view('posts/index', $data);
    }

    public function paginate(){
      $paginate = $this->postModel->countPosts();
      $data = [
        
      ];

      // Load view
      // $this->view('');
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'username' => trim($_POST['username']),
          'email' => trim($_POST['email']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'username_err' => '',
          'email_err' => '',
          'body_err' => ''
        ];

        // Validate username
        if(empty($data['username'])){
          $data['username_err'] = 'Please enter username';
        }

        // Validate email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email';
        }

        // Validate body
        if(empty($data['body'])){
          $data['body_err'] = 'Please enter body';
        }

        // Make sure no errors
        if(empty($data['username_err']) && empty($data['email_err']) && empty($data['body_err'])){
          // Validated
          if($this->postModel->addPost($data)){
            flash('post_message', 'Post Added');
            redirect('posts');
          } else {
            die("something went wrong");
          }
        } else {
          // Load view with errors
          $this->view('posts/add', $data);
        }

      } else {
        $data = [
          'username' => '',
          'email' => '',
          'body' => ''
        ];
  
        // Load a view
        $this->view('posts/add', $data);
      }
      
    }

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'email' => trim($_POST['email']),
          'body' => trim($_POST['body']),
          'status' => trim($_POST['status']),
          'user_id' => $_SESSION['user_id'],
          'email_err' => '',
          'body_err' => ''
        ];

        // Validate email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email';
        }

        // Validate body
        if(empty($data['body'])){
          $data['body_err'] = 'Please enter body';
        }

        // Validate status
        if(empty($data['status'])){
          $data['status_err'] = 'Please enter status';
        }

        // Make sure no errors
        if(empty($data['status_err']) && empty($data['email_err']) && empty($data['body_err'])){
          // Validated
          if($this->postModel->updatePost($data)){
            flash('post_message', 'Post Updated');
            redirect('posts');
          } else {
            die("something went wrong");
          }
        } else {
          // Load view with errors
          $this->view('posts/edit', $data);
        }

      } else {
        // Get existing post from model
        $post = $this->postModel->getPostById($id);


        // Check for owner
        if($_SESSION['user_status'] != 'admin'){
          redirect('posts');
        }
        $data = [
          'id' => $id,
          'status' => $post->status,
          'email' => $post->email,
          'body' => $post->body
        ];
  
        // Load a view
        $this->view('posts/edit', $data);
      }
    }
    
    public function show($id){
      $post = $this->postModel->getPostById($id);
      $user = $this->userModel->getUserById($post->user_id);
      $data = [
        'post' => $post,
        'user' => $user
      ];
      $this->view('posts/show', $data);
    }

  }