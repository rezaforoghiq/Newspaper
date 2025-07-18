<?php require_once(BASE_PATH ."/template/admin/layout/header.php"); ?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Set Web Setting</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("admin/Setting/update/". $setting["id"]) ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $setting["title"] ?>" autofocus>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">
                        <?= $setting["description"] ?>
                </textarea>
            </div>

            <div class="form-group">
                <label for="keywords">Keywords</label>
                <input type="text" class="form-control" id="keywords" name="keywords" value="<?= $setting["keywords"] ?>"
                     autofocus>
            </div>

            <hr />
            <div class="form-group">
                <label for="">Now logo</label>
                <img style="width: 100px; height: 100px;" class="mb-5" src="<?= asset($setting["logo"]) ?>" alt="">
                
                <div class="d-flex">
                <label for="logo">Insert logo</label>
                <input type="file" id="logo" name="logo" class="form-control-file" autofocus>    
                </div>
                
            </div>
            <hr />
            <div class="form-group" style="margin-top: 100px;">
                <hr/>
                <label for="">Now icon</label>
                <img style="width: 100px; height: 100px;" class="mb-5" src="<?= asset($setting["icon"]) ?>" alt="">
                
                    <div class="d-flex">
                    <label for="icon">Inset icon</label>
                    <input type="file" id="icon" name="icon" class="form-control-file" autofocus>
                    </div>
                    
                


            </div>

            <button type="submit" class="btn btn-primary btn-sm">set</button>
        </form>
    </section>
</section>

<?php require_once(BASE_PATH ."/template/admin/layout/footer.php"); ?>