<?php

namespace Admin;

use database\DataBase;

class Dashboard extends Admin{

    public function index(){
        
        $db = new DataBase();

        $posts = $db->select("SELECT posts.*, users.username AS user_name, categories.name AS cat_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.cat_id = categories.id ORDER BY posts.id DESC")->fetchAll();
        $comments = $db->select("SELECT comments.*, users.username AS user_name, posts.title AS post_name FROM comments  LEFT JOIN users ON comments.user_id = users.id LEFT JOIN posts ON comments.post_id = posts.id")->fetchAll();
        
        require_once(BASE_PATH . "/template/admin/dashboard/index.php");

    }


}