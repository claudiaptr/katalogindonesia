<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    <form action="/admin/auth/cek_login" method="post">
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
