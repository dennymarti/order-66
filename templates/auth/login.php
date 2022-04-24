<form action="/auth" class="form login" id="form" method="post">
    <div class="box">
        <h1 class="form-title"><?= $heading; ?></h1>
    </div>

    <div class="box">
        <div class="form-row">
            <div class="form-field">
                <input class="input" id="username" name="username" type="text" required>
                <label class="form-label">Username</label>
                <i class="bx bxs-check-circle hide"></i>
                <i class="bx bxs-x-circle hide"></i>
            </div>

            <div class="error-box hide">
                <p class="error-message"></p>
            </div>
        </div>


        <div class="form-row">
            <div class="form-field">
                <input class="input" id="password" name="password" type="password" required>
                <label class="form-label">Password</label>
                <i class="bx bxs-check-circle hide"></i>
                <i class="bx bxs-x-circle hide"></i>
            </div>

            <div class="error-box hide">
                <p class="error-message"></p>
            </div>
        </div>

        <p class="form-text">
            Not registered yet? <a class="link" href="/user/signup">Signup</a>
        </p>
    </div>

    <div class="form-submit">
        <button class="submit" id="submit" type="submit" disabled>Submit</button>
    </div>
</form>