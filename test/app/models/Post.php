<?php
  class Post {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getPosts(){
      $sql = 'SELECT *,
                posts.id AS postId,
                users.id AS userId,
                posts.status AS status
              FROM posts
              LEFT JOIN users
                ON posts.user_id = users.id';
      $this->db->query($sql);

      $results = $this->db->resultSet();

      return $results;
    }

    public function limitPosts($from, $by){
      $sql = "SELECT *,
                posts.id AS postId,
                users.id AS userId,
                posts.status AS status
              FROM posts
              LEFT JOIN users
                ON posts.user_id = users.id
              LIMIT $from, $by";
      $this->db->query($sql);

      $result = $this->db->resultSet();
      return $result;
    }

    public function addPost($data){
      $this->db->query("INSERT INTO posts(email,user_id, username, body) VALUES(:email, :user_id, :username, :body)");
      // Bind values
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':body', $data['body']);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updatePost($data){
      $this->db->query("UPDATE posts SET email = :email, body = :body, status = :status WHERE id = :id");
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':body', $data['body']);
      $this->db->bind(':status', $data['status']);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getPostById($id){
      $this->db->query("SELECT * FROM posts WHERE id = :id");
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

  }