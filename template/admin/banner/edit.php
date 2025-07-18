<?php
require_once(BASE_PATH ."/template/admin/layout/header.php");
?>

        <section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Update Banner</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("admin/Banner/update/". $banner["id"]) ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="url" name="url" value="<?= $banner["url"] ?>" required autofocus>
            </div>

           
            <div class="form-group">
                <label for="image">Image</label>
                <img style="width: 80px; margin-top: 30px;" src="<?= asset($banner["image"]); ?>" alt="">
                <div class="form-group" style="display: flex; margin-top: 20px;">
                    <label for="image">Change image(optional)</label>
                    <input style="margin-top: 30px;" type="file" id="image" name="image" class="form-control-file" autofocus>
                </div>
                
            </div>

            <button type="submit" class="btn btn-primary btn-sm">update</button>
        </form>
    </section>
</section>

<?php
require_once(BASE_PATH ."/template/admin/layout/footer.php");
?>