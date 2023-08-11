<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div style="margin-bottom:130px;"></div>
<?php if(session()->has('error')) { ?>
    <div class="alert alert-danger mx-auto" style="max-width: 400px;" role="alert">
        <?= session('error') ?>
    </div>
<?php } ?>
<div class="container" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow" style="border-radius: 20px;border: 2px solid #FFA500;">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Register</h4>
                    <form method="post" action="<?= base_url('register/submit') ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" style="border: 2px solid #FFA500;" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" placeholder="NIP" style="border: 2px solid #FFA500;" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #FFA500; border-color: #FFA500;">Register</button>
                    </form>
                    <p class="mt-3 text-center">Sudah punya akun? <a href="<?= base_url('login') ?>" style="color: #FFA500;">Login</a></p>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
