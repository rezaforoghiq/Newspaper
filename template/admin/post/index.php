<?php require_once(BASE_PATH ."/template/admin/layout/header.php"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Articles</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="<?= url("admin/Post/create"); ?>" class="btn btn-sm btn-success">create</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <caption>List of posts</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>title</th>
                <th>summary</th>
                <th>view</th>
                <th>status</th>
                <th>user ID</th>
                <th>cat ID</th>
                <th>image</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($posts as $post){ ?>    
            <tr>
                <td><?= $post["id"] ?></td>

                <td><?= $post["title"] ?></td>

                <td><?= $post["summary"] ?></td>

                <td>
                <?php if($post["breaking_news"] !== 1){ ?>
                    <span class="badge badge-success">#breaking_news</span>
                <?php }
                    if($post["selected"] !== 1){
                ?>
                    <span class="badge badge-dark">#editor_selected</span>
                <?php } ?>
                </td>

                <td><?= $post["status"] ?></td>

                <td><?= $post["user_name"] ?></td>
                
                <td><?= $post["cat_name"] ?></td>

                <td><img style="width: 80px;" src="<?= asset($post["image"]) ?>" alt=""></td>


                <td style="width: 25rem;">
                    <a role="button" class="btn btn-sm btn-warning btn-dark text-white" href="<?= url("admin/Post/breaking-news/". $post["id"]) ?>">
                        <?= $post["breaking_news"] !== 1?"remove breaking new":"add breaking news" ?>
                    </a>
                    <a role="button" class="btn btn-sm btn-warning btn-dark text-white" href="<?= url("admin/Post/selected/". $post["id"]) ?>">
                        <?= $post["selected"] !== 1?"remove selected":"add selected" ?>
                    </a>
                    <hr class="my-1" />
                    <a role="button" class="btn btn-sm btn-primary text-white" href="<?= url("admin/Post/edit/". $post["id"]); ?>">edit</a>
                    <a role="button" class="btn btn-sm btn-danger text-white" href="<?= url("admin/Post/delete/". $post["id"]); ?>">delete</a>
                    <a role="button" class="btn btn-sm btn-pink text-white" href="<?= url("admin/Post/show/". $post["id"]) ?>">show</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>


<?php require_once(BASE_PATH ."/template/admin/layout/footer.php"); ?>