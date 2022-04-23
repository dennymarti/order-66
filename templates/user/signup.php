<form action="/user/create" class="form" method="post">
    <div class="box">
        <h1 class="form-title"><?= $heading; ?></h1>
    </div>

    <div class="box">
        <div class="form-field">
            <input class="input" name="firstname" type="text" required>
            <label class="form-label">Firstname</label>
        </div>

        <div class="form-field">
            <input class="input" name="name" type="text" required>
            <label class="form-label">Name</label>
        </div>

        <div class="form-field">
            <input class="input" name="password" type="password" required>
            <label class="form-label">Password</label>
        </div>

        <div class="form-field">
            <input class="input" type="password" required>
            <label class="form-label">Confirm password</label>
        </div>

        <p class="form-text">
            Have an account? <a class="link" href="/auth/login">Login</a>
        </p>
    </div>

    <div class="form-submit">
        <button class="submit" type="submit" disabled>Submit</button>
    </div>
</form>