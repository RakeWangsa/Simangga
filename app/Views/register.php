<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <p>Register</p>
    <form method="post" action="<?= base_url('register/submit') ?>">
        <input type="text" name="nama" placeholder="nama">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</body>
</html>
