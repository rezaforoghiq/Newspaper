<?php

namespace Admin;

use database\DataBase;

class Dashboard extends Admin{

    public function index(){
        
        $db = new DataBase();
        
        // select all filde and all record in database
        $posts = $db->select("SELECT posts.*, users.username AS user_name, categories.name AS cat_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.cat_id = categories.id ORDER BY posts.id DESC")->fetchAll();
        $comments = $db->select("SELECT comments.*, users.username AS user_name, posts.title AS post_name FROM comments  LEFT JOIN users ON comments.user_id = users.id LEFT JOIN posts ON comments.post_id = posts.id ORDER BY created_at DESC LIMIT 0,5")->fetchAll();
        $users = $db->select("SELECT * FROM users")->fetchAll();
        $categories = $db->select("SELECT * FROM categories")->fetchAll();
        $postsView = $db->select("SELECT SUM(view) FROM posts")->fetch();
        
        //select count all filde and all record in database
        $postC = count($posts);
        $commentC = count($comments);
        $userC = count($users);
        $categoryC = count($categories);

        //select count all user and all admin permission in database
        $normalUsers = $db->select("SELECT * FROM users WHERE permission = ?", ["user"])->fetchAll();
        $admins = $db->select("SELECT * FROM users WHERE permission = ?", ["admin"])->fetchAll();

        $normalUserC = count($normalUsers);
        $adminC = count($admins);


        //select count all approved comment and unssen comment
        $approved = $db->select("SELECT * FROM comments WHERE status = ?", ["approved"])->fetchAll();
        $unseen = $db->select("SELECT * FROM comments WHERE status = ?", ["unseen"])->fetchAll();

        $approvedC = count($approved);
        $unseenC = count($unseen);


        // select the 5 most viewed post
        $mostViewedPosts = $db->select("SELECT * FROM `posts` ORDER BY view DESC LIMIT 0,5")->fetchAll();

        $mostCommentedPosts = $db->select("SELECT posts.id, posts.title, COUNT(comments.post_id) AS comment_count FROM posts LEFT JOIN comments ON posts.id = comments.post_id GROUP BY posts.id ORDER BY comment_count DESC LIMIT 0,5")->fetchAll();


        require_once(BASE_PATH . "/template/admin/dashboard/index.php");

    }


}