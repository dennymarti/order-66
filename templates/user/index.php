<div class="form">
    <div class="box">
        <h1 class="form-title"><?= $heading; ?></h1>
    </div>

    <div class="box">
        <div class="form-row">
            <input class="input" value="<?= $user->firstname ?>" readonly>
        </div>

        <div class="form-row">
            <input class="input" value="<?= $user->name ?>" readonly>
        </div>

        <div class="form-row">
            <input class="input" value="<?= $user->username ?>" readonly>
        </div>

        <p class="form-text">
            Don't need account anymore? <a class="link" href="/user/delete?id=<?= $user->id; ?>">Delete</a>
        </p>
    </div>

    <div class="form-submit">
        <button class="submit" type="button" disabled>Edit</button>
    </div>
</div>