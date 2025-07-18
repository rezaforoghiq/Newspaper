<?php

namespace Admin;

use database\DataBase;


class Comment extends Admin{


    public function index(){

        $db = new DataBase();
        $comments = $db->select("SELECT comments.*, users.username AS user_name, posts.title AS post_name FROM comments  LEFT JOIN users ON comments.user_id = users.id LEFT JOIN posts ON comments.post_id = posts.id")->fetchAll();

        foreach($comments as $comment){

            if($comment["status"] == "unseen"){
            $db->update("comments", $comment["id"], ["status"], ["status" => "seen"]);
            }

            
        }
        require_once(BASE_PATH . "/template/admin/comment/index.php");

    }

    public function status($id){

        $db = new DataBase();
        $comment = $db->select("SELECT * FROM `comments` WHERE id = ?", [$id])->fetch();
        if(isset($comment["status"])){

            if($comment["status"] == "seen"){

                $db->update("comments", $id, ["status"], ["status" => "approved"]);
                $this->redirectBack();

            }else{

                $db->update("comments", $id, ["status"], ["status" => "seen"]);
                $this->redirectBack();

            }

        }else{
            $this->redirectBack();
        }


    }


    public function show($id){

        $db = new DataBase();
        $comment = $db->select("SELECT comments.*, users.username AS user_name, posts.title AS post_name FROM comments  LEFT JOIN users ON comments.user_id = users.id LEFT JOIN posts ON comments.post_id = posts.id WHERE comments.id = ?", [$id])->fetch();

        require_once(BASE_PATH . "/template/admin/comment/show.php");

    }

    public function rb(){
        $this->redirect("admin/Comment");
    }



}