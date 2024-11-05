<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
</head>
<body>
    <h2>Admin Register</h2>
    <form action="/admin/auth/save_register" method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
