<?php $errors = !empty($errors) ? json_decode($errors, true) : []; ?>

<div class="container">
    <form class="registration-form" method="post">
        <h2>Register</h2>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <?php if (array_key_exists('name', $errors)): ?>
            <?php foreach ($errors['name'] as $error): ?>
                <div class="error_message"><?php echo $error; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <?php if (array_key_exists('email', $errors)): ?>
            <?php foreach ($errors['email'] as $error): ?>
                <div class="error_message"><?php echo $error; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <?php if (array_key_exists('password', $errors)): ?>
            <?php foreach ($errors['password'] as $error): ?>
                <div class="error_message"><?php echo $error; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <?php if (array_key_exists('confirm_password', $errors)): ?>
            <?php foreach ($errors['confirm_password'] as $error): ?>
                <div class="error_message"><?php echo $error; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <button type="submit">Register</button>
    </form>
</div>