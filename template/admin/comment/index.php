<?php require_once(BASE_PATH . "/template/admin/layout/header.php"); ?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Comments</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
</div>
<section class="table-responsive">
    <table class="table table-striped table-sm">
        <caption>List of comments</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>user ID</th>
                <th>post ID</th>
                <th>comment</th>
                <th>status</th>
                <th>setting</th>
            </tr>
        </thead>
        <?php foreach($comments as $comment){ ?>
        <tbody>
            <tr>
                <td>
                    <a href="<?= url("admin/Comment/show/". $comment["id"]) ?>"><?= $comment["id"] ?></a>
                </td>
                <td>
                    <?= $comment["user_name"] ?>
                </td>
                <td>
                    <?= $comment["post_name"] ?>
                </td>
                <td>
                    <?= $comment["comment"] ?>
                </td>
                <td>
                    <?= $comment["status"] ?>
                </td>
                <td>
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
                </td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
</section>

<?php require_once(BASE_PATH . "/template/admin/layout/footer.php"); ?>