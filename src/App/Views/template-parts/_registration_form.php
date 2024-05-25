<div class="container">
    <form class="registration-form" method="post">
        <h2>Register</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required>

        <button type="submit">Register</button>
    </form>
    <?php var_dump($errors); ?>
</div>