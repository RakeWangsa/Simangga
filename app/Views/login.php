<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <p>login</p>
    <form method="post" action="<?= base_url('login/cek') ?>">
        <input type="text" name="nama" placeholder="nama">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</body>
</html>
