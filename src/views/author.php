<?php
ob_start();
?>
<div class="authorDescription media pt-5">
  <img src="public\images\plume.png" class="feather mr-3" alt="Image de l'auteur">
  <div class="media-body">
    <h2 class="mt-2">A propos de l'auteur</h2>
    <p class="mr-5">
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante 
        sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
        Fusce condimentum nunc ac nisi vulputate fringilla.<br> Donec lacinia congue felis in
        faucibus. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus, 
        iure, enim animi voluptate doloremque quod sunt voluptatem dolor, veniam id provident?
        Mollitia libero laudantium cupiditate accusamus ad repellat deleniti odit. 
        Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>Odit, deleniti dignissimos. Voluptates quos adipisci aperiam? 
        Expedita, dolore quos quidem itaque facere perferendis.
        Maxime atque a quisquam sunt earum. Ducimus, mollitia.
    </p>
  </div>
</div>
<?=
$content =  ob_get_contents();
ob_end_clean();