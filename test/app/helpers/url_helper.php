<?php
  function redirect($index){
    header('Location: ' . URLROOT . '/' . $index);
  }
?>