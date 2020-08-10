<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Register User
    public function register($data){
      $this->db->query("INSERT INTO users(name, password) VALUES(:name, :password)");
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':password', $data['password']);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function login($name, $password){
      $this->db->query('SELECT * FROM users WHERE name = :name');
      $this->db->bind(':name', $name);
      $row = $this->db->single();
      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Find user by name
    public function findUserByName($name){
      $this->db->query('SELECT * FROM users WHERE name = :name');
      $this->db->bind(':name', $name);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    // Get user by id
    public function getUserById($id){
      $this->db->query('SELECT * FROM users WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }
  }