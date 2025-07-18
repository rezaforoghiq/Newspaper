<?php require_once(BASE_PATH ."/template/admin/layout/header.php"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Users</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="<?= url("admin/User/create") ?>" class="btn btn-sm btn-success">create</a>
    </div>
</div>

<form>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h5"><i class="fas fa-search">Search</i></h2>

        <div class="form-gruop">
            <input type="text" class="form-control">
        </div>

        <button type="submit" class="btn btn-sm btn-green text-white">Search</button>
    </div>
</form>

<section class="table-responsive">
    <table class="table table-striped table-sm">
        <caption>List of users</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>email</th>
                <th>password</th>
                <th>permission</th>
                <th>created at</th>
                <th>setting</th>
            </tr>
        </thead>
        <?php foreach($users as $user){ ?>
        <tbody>
            <tr>
                <td><?= $user["id"] ?></td>
                <td><?= $user["username"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["password"] ?></td>
                <td><?= $user["permission"] ?></td>
                <td><?= jdate($user["created_at"]) ?></td>
                <td>

                <?php if($user["permission"] == "user"){ ?>
                    <a role="button" class="btn btn-sm btn-success text-white" href="<?= url("admin/User/permission/". $user["id"]); ?>">click to be admin</a>
                <?php }elseif("admin"){ ?>
                    <a role="button" class="btn btn-sm btn-warning text-white" href="<?= url("admin/User/permission/". $user["id"]); ?>">click not to be admin</a>
                <?php } ?>


                    <a role="button" class="btn btn-sm btn-primary text-white" href="<?= url("admin/User/edit/". $user["id"]) ?>">edit</a>
                    <a role="button" class="btn btn-sm btn-danger text-white" href="<?= url("admin/User/delete/". $user["id"]) ?>">delete</a>
                </td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
</section>

<?php require_once(BASE_PATH ."/template/admin/layout/footer.php"); ?>