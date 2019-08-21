<?php
ob_start();
?>
<section class="postsContainer container-fluid mt-5 pt-5">
    <div class="offset-1 col-10 border border-dark">

    </div>
</section>
<?=
$content =  ob_get_contents();


ob_end_clean();