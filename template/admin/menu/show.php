<?php require_once(BASE_PATH . "/template/admin/layout/header.php"); ?>

<section class="pt-3 pb-1 mb-2 border-bottom d-flex justify-content-between">
    
    <h1 class="h5 ">Show Menu</h1>

    <a href="<?= url("admin/Menu") ?>" class="btn btn-sm btn-yellow text-white">Back</a>
    
</section>

<section class="row my-3 ">
    <section class="col-12 ">
        <h1 class="h4 border-bottom ">name : <?= $menu["name"] ?></h1>
        <p class="h4 border-bottom ">url : <?= $menu["url"] ?></p>
        <p class="h4 border-bottom ">parent ID : <?= $menu["menu_name"] ?></p>
    </section>
</section>

<?php require_once(BASE_PATH . "/template/admin/layout/footer.php"); ?>