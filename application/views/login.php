<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qitkif | Admin login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('public/css/login.css') ?>">
</head>
<body>
    <div class="container">
        <div class="wrapper shadow-sm">
            <a href="#" class="logo-link">
                <img src="<?= base_url('public/images/logo.png') ?>" alt="logo" class="logo-img">
            </a>
            <p class="text-center h3">Se connecter</p>

            <form method="post" action="<?= base_url('login') ?>">
                <div class="form-group">
                    <label class="text-muted">Identifiant :</label>
                    <input type="text" name="username" class="form-control" aria-describedby="emailHelp" value="<?= $username ?? null ?>">
                </div>
                <div class="form-group">
                    <label class="text-muted">Mot de passe :</label>
                    <div class="form-password">
                        <span onclick="togglePassword(this)" class="eye" data-show="true"><i class="fa-regular fa-eye-slash"></i></span>
                        <input type="password" name="password" class="form-control" aria-describedby="emailHelp" value="<?= $password ?? null ?>">
                    </div>
                </div>
                <?php if($error) : ?>
                    <p class="login-error">Mauvais identifiant ou mot de passe</p>
                <?php endif; ?>
                <p class="text-right">
                    <a href="#">Mot de passe oublié</a>
                </p>
                <div class="form-group">
                    <button class="btn btn-info btn-block">Connexion</button>
                </div>

                <!-- <p class="text-center">
                    Vous n'avez pas de compte ?<br>
                    <a href="#">S'inscrire</a>
                </p> -->
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url('public/js/main.js') ?>"></script>
</body>
</html>