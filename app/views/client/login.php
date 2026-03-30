<?php echo "LOGIN CLIENT OK"; ?>
<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST" action="<?= APP_URL ?>/client/login">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
</form>