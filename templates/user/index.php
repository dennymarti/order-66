<div class="account-wrapper">
    <p><?= $user->firstname ?></p>
    <p><?= $user->name ?></p>
    <p><?= $user->username ?></p>
    <a title="Löschen" href="/user/delete?id=<?= $user->id; ?>">Löschen</a>
</div>