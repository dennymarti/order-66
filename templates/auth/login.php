<form action="/auth" class="form login" id="form" method="post">
    <div class="box">
        <h1 class="form-title"><?= $heading; ?></h1>
    </div>

    <div class="box">
        <?php
            if (isset($error)) {
                echo "
<div class='alert-box'>
    <p class='alert-message'>$error</p>
</div>";
            }
        ?>

        <div class="form-row">
            <div class="form-field">
                <input autocomplete="off" class="input" id="username" name="username" type="text" required>
                <label class="form-label">Username</label>
            </div>
        </div>


        <div class="form-row">
            <div class="form-field">
                <input autocomplete="off" class="input" id="password" name="password" type="password" required>
                <label class="form-label">Password</label>
            </div>
        </div>

        <p class="form-text">
            Not registered yet? <a class="link" href="/user/signup">Signup</a>
        </p>
    </div>

    <div class="form-submit">
        <button class="submit" id="submit" type="submit">Submit</button>
    </div>
</form>