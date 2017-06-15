<section>
    <form class="text-center" method="post">
        <input type="text" name="name" placeholder="Nom d'utilisateur">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="password" name="confirmPassword" placeholder="Confirmer mot de passe">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="submit" value="Envoyer">
    </form>

    <?php if (isset($error)) : ?>
        <div class="bg-error text-center">
                <p><?= $error ?></p>
        </div>
    <?php endif; ?>

    <?php if (isset($success)) : ?>
        <div class="bg-info text-center">
                <p><?= $success ?></p>
        </div>
    <?php endif; ?>

</section>
