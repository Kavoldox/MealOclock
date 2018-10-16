<?php $this->layout('admin') ?>

<div class="container">
    <h2>Liste des membres</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($members as $member): ?>
                <tr>
                    <td><?=$member->getId()?></td>
                    <td><?=$member->getName()?></td>
                    <td>
                        <a href="<?=$router->generate( 'admin_member_delete', ['id' => $member->getId()] )?>">
                            <i class="fas fa-times-circle text-danger"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
