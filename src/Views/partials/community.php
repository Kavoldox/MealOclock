<div class="row box">
    <div class="col-12 col-md-3">
        <img src="<?=$basePath?>/public/images/communities/<?=$community->getPicture()?>" alt="" class="img-fluid">
    </div>
    <div class="col-12 col-md-6 box-content">
        <h2>
            <a href="<?=$router->generate('community_read', [ 'slug' => $community->getSlug() ])?>">
                <?=$community->getName()?>
            </a>
        </h2>
        <p><?=$community->getDescription()?></p>
    </div>
    <div class="col-12 col-md-3 area">
        <h3>La recette</h3>
        <ul>
            <li>lorem</li>
            <li>lorem</li>
            <li>lorem</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
    </div>
</div>
