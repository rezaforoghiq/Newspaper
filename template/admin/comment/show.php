<?php require_once(BASE_PATH . "/template/admin/layout/header.php") ?>

<section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5 ">Show Comment</h1>
        <a role="button" href="<?= url("admin/Comment/redirect-back") ?>" class="btn btn-sm btn-green">Back</a>
    </section>
<section class="row my-3 ">
    <section class="col-12 ">
        <h1 class="h4 border-bottom "><?= $comment["comment"] ?></h1>
        <p class="text-secondary border-bottom "><?= $comment["id"] ?></p>
        <p class="text-secondary border-bottom "><?= $comment["user_name"] ?></p>
        <p class="text-secondary border-bottom "><?= $comment["post_name"] ?></p>
        <p class="text-secondary border-bottom "><?= $comment["status"] ?></p>
        <p class="text-secondary border-bottom "><?= jdate($comment["created_at"]) ?></p>
                        
<?php
                     if($comment["status"] == "seen"){
?>
                    <a role="button" class="btn btn-sm btn-success text-white" href="<?= url("admin/Comment/status/". $comment["id"]) ?>">click to approved</a>
<?php
                     }elseif($comment["status"] == "approved"){ 
?>
                    <a role="button" class="btn btn-sm btn-warning text-white" href="<?= url("admin/Comment/status/". $comment["id"]) ?>">click not to approved</a>
<?php
                    } 
?>
           
                </section>
                </section>


<?php require_once(BASE_PATH . "/template/admin/layout/footer.php") ?>