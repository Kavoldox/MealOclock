<?php $this->layout( 'layout' ) ?>

<?php $this->insert( 'partials/event', [ 'event' => $event ] ) ?>

<div
    class="map"
    data-address="<?=$event->getAddress()?>"
    <?php if ( $user ): ?>
        data-user-address="<?=$user['address']?>"
    <?php endif;?>
    ></div>
