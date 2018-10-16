<div class="row box">
    <div class="col-12 col-md-9 box-content">
        <h2>
            <a href="<?=$router->generate( 'event_read', [ 'id' => $event->getId() ] )?>">
                <?=$event->getName()?>
            </a>
        </h2>
        <small><?=$event->getAddress()?></small>
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
