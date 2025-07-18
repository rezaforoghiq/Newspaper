<?php
require_once(BASE_PATH ."/template/admin/layout/header.php");
?>

<section class="pt-3 pb-1 mb-2 border-bottom d-flex justify-content-between">
    <h1 class="h5">Show Article</h1>
    <a role="button" class="btn btn-sm btn-danger text-white" href="<?= url("admin/Post") ?>">Back</a>
</section>
<section class="row my-3">
    <section class="col-12">
        <h1 class="h4 border-bottom"><?= $post["title"] ?></h1>
        <p class="text-secondary border-bottom"><?= $post["summary"] ?></p>
        <section class=""><?= $post["body"] ?></section>
    </section>
</section>


<?php
require_once(BASE_PATH ."/template/admin/layout/footer.php");
?>