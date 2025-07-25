<?php require_once(BASE_PATH ."/template/admin/layout/header.php"); ?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Edit User</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("admin/User/update/" . $user["id"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user["username"] ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $user["email"] ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="<?= $user["password"] ?>">
            </div>

            <div class="form-group">
                <label for="permission">permission</label>
                <select name="permission" id="permission" class="form-control" required autofocus>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">update</button>
        </form>

    </section>
</section>

<?php require_once(BASE_PATH ."/template/admin/layout/footer.php"); ?>