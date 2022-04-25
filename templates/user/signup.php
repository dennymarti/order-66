<form action="/user/create" class="form signup" id="form" name="signup" method="post">
    <div class="box">
        <h1 class="form-title"><?= $heading; ?></h1>
    </div>

    <div class="box">
        <div class="form-row">
            <div class="form-field">
                <input autocomplete="off" class="input" id="firstname" name="firstname" type="text" onchange="validateText(event)" required>
                <label class="form-label">Firstname</label>
                <i class="bx bxs-check-circle hide"></i>
                <i class="bx bxs-x-circle hide"></i>
            </div>

            <div class="error-box hide">
                <p class="error-message"></p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <input autocomplete="off" class="input" id="name" name="name" type="text" onchange="validateText(event)" required>
                <label class="form-label">Name</label>
                <i class="bx bxs-check-circle hide"></i>
                <i class="bx bxs-x-circle hide"></i>
            </div>

            <div class="error-box hide">
                <p class="error-message"></p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <input autocomplete="off" class="input" id="password" name="password" type="password" onchange="validatePassword(event)" required>
                <label class="form-label">Password</label>
                <i class="bx bxs-check-circle hide"></i>
                <i class="bx bxs-x-circle hide"></i>
            </div>

            <div class="error-box hide">
                <p class="error-message"></p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <input autocomplete="off" class="input" id="confirmPassword" name="confirm password" type="password" onchange="validatePassword(event)" required>
                <label class="form-label">Confirm password</label>
                <i class="bx bxs-check-circle hide"></i>
                <i class="bx bxs-x-circle hide"></i>
            </div>

            <div class="error-box hide">
                <p class="error-message"></p>
            </div>
        </div>

        <p class="form-text">
            Have an account? <a class="link" href="/auth/login">Login</a>
        </p>
    </div>

    <div class="form-submit">
        <button class="submit" id="submit" type="submit">Submit</button>
    </div>
</form>