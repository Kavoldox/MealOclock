<?php $this->layout( 'admin' ) ?>

<div class="container">
    <h2>Liste des communautés</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Liste des communautés -->
            <?php foreach($communities as $community): ?>
                <tr>
                    <td><?=$community->getId()?></td>
                    <td><?=$community->getName()?></td>
                    <td>
                        <a href="<?=$router->generate( 'admin_community_delete', ['id' => $community->getId()] )?>">
                            <i class="fas fa-times-circle text-danger"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
