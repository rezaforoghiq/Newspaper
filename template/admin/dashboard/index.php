<?php //dd($);
 require_once(BASE_PATH . "/template/admin/layout/header.php") ?>

<div class="row mt-3">

    <div class="col-sm-6 col-lg-3">
        <a href="<?= url("admin/Category") ?>" class="text-decoration-none">
            <div class="card text-white bg-gradiant-green-blue mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>
                        <i
                            class="fas fa-clipboard-list"></i> Categories</span> <?= $categoryC ?> <span
                            class="badge badge-pill right"></span></div>
                <div class="card-body">
                    <section class="font-12 my-0"><i class="fas fa-clipboard-list"></i> GO TO Categories!</section>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= url("admin/User") ?>" class="text-decoration-none">
            <div class="card text-white bg-juicy-orange mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i
                            class="fas fa-users"></i> Users</span> <span class="badge badge-pill right"><?= $userC ?></span></div>
                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class="fas fa-users-cog"></i> Admin <span
                                class="badge badge-pill mx-1"><?= $normalUserC ?></span></span>
                        <span class=""><i class="fas fa-user"></i> All Users <span
                                class="badge badge-pill mx-1"><?= $adminC ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= url("admin/Post") ?>" class="text-decoration-none">
            <div class="card text-white bg-dracula mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i
                            class="fas fa-newspaper"></i> Article</span> <span class="badge badge-pill right"><?= $postC ?></span>
                </div>
                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class="fas fa-bolt"></i> Views <span
                                class="badge badge-pill mx-1"><?= $postsView["SUM(view)"] ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= url("admin/Comment") ?>" class="text-decoration-none">
            <div class="card text-white bg-neon-life mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i
                            class="fas fa-comments"></i> Comment</span> <span class="badge badge-pill right"><?= $commentC ?></span>
                </div>
                <div class="card-body">
                    <!--                        <h5 class="card-title">Info card title</h5>-->
                    <section class="d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class="far fa-eye-slash"></i> Unseen <span
                                class="badge badge-pill mx-1"><?= $unseenC ?></span></span>
                        <span class=""><i class="far fa-check-circle"></i> Approved <span
                                class="badge badge-pill mx-1"><?= $approvedC ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>

</div>


<div class="row mt-2">
    <div class="col-4">
        <h2 class="h6 pb-0 mb-0">
            Most viewed posts
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>view</th>
                    </tr>
                </thead>
                <?php foreach($mostViewedPosts as $mostViewedPost){ ?>
                <tbody>

                    <tr>
                        <td>
                            <a class="text-primary" href="<?= url("admin/Post/show/". $mostViewedPost["id"]) ?>">
                                <?= $mostViewedPost["id"] ?>
                            </a>
                        </td>
                        <td>
                            <?= $mostViewedPost["title"] ?>
                        </td>
                        <td><span class="badge badge-secondary"><?= $mostViewedPost["view"] ?></span></td>
                    </tr>


                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="col-4">
        <h2 class="h6 pb-0 mb-0">
            Most commented posts

        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>comment</th>
                    </tr>
                </thead>
                <?php foreach($mostCommentedPosts as $mostCommentedPost){ ?>
                <tbody>

                    <tr>
                        <td>
                            <a class="text-primary" href="<?= url("admin/Post/show/". $mostCommentedPost["id"]) ?>">
                                <?= $mostCommentedPost["id"] ?>
                            </a>
                        </td>
                        <td>
                            <?= $mostCommentedPost["title"] ?>
                        </td>
                        <td><span class="badge badge-success"><?= $mostCommentedPost["comment_count"] ?></span></td>
                    </tr>


                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="col-4">
        <h2 class="h6 pb-0 mb-0">
            Comments
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>username</th>
                        <th>comment</th>
                        <th>status</th>
                    </tr>
                </thead>
                <?php foreach($comments as $comment){ ?>
                <tbody>

                    <tr>
                        <td>
                            <a class="text-primary" href="<?= url("admin/Comment/show/".$comment["id"]) ?>">
                                <?= $comment["id"] ?>
                            </a>
                        </td>
                        <td>
                            <?= $comment["user_name"] ?>
                        </td>
                        <td>
                            <?= $comment["comment"] ?>
                        </td>
                        <td><span class="badge badge-warning"><?= $comment["status"] ?></span></td>
                    </tr>


                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php require_once(BASE_PATH . "/template/admin/layout/header.php") ?>