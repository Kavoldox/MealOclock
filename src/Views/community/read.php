<?php $this->layout( 'layout' ) ?>

<?php $this->insert( 'partials/community', [ 'community' => $community ] ); ?>

<?php if ( $user ): ?>
    <div class="text-center mb-5">
        <?php if ( !$isMember ): ?>
            <a
                href="<?=$router->generate('community_join', ['id' => $community->getId()])?>"
                class="btn btn-primary">
                S'abonner à la communauté
            </a>
        <?php else: ?>
            <a
                href="<?=$router->generate('community_leave', ['id' => $community->getId()])?>"
                class="btn btn-danger">
                Se désabonner
            </a>
        <?php endif; ?>
    </div>
<?php endif;?>
