<?php echo "LOGIN ADMIN OK"; ?>
<?php if (isset($error)) echo "<p style='color:red'>" . $error . "</p>"; ?>
<?php if (isset($_GET['timeout'])) echo "<p style='color:orange'>Session expirée. Reconnectez-vous.</p>"; ?>

<form method="POST" action="<?= APP_URL ?>/admin/authenticate">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
</form>