<?php $this->layout('admin') ?>

<div class="container">
    <h2>Liste des évènements</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($events as $event): ?>
                <tr>
                    <td><?=$event->getId()?></td>
                    <td><?=$event->getName()?></td>
                    <td>
                        <a href="<?=$router->generate( 'admin_event_delete', ['id' => $event->getId()] )?>">
                            <i class="fas fa-times-circle text-danger"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
