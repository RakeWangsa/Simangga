<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container" style="margin-top:150px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow" style="border-radius: 20px">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Login</h4>
                    <form method="post" action="<?= base_url('login/cek') ?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <p class="mt-3 text-center">Belum punya akun? <a href="<?= base_url('register') ?>">Register</a></p>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
