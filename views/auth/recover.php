<h1 class="page-name">Restablece tu password</h1>
<p class="page-description">Llena esta formulario para restablecer tu password</p>

<?php 
include_once __DIR__ . '/../templates/alerts.php'; 
?>

<!-- Si el Token es inválido no muestra el resto del formulario -->
<?php if ($error) return; ?>
<form action="" class="form" method="POST">
    <div class="field">
        <label for="password">Contraseña</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            placeholder="Tu nueva contraseña"
        />
    </div>

    <input type="submit" value="Restablece password" class="button">
</form>

<div class="actions">
    <a href="/">Ya tienes una cuenta? Inicia sesión aquí</a>
    <a href="/create-account">Todavía no tienes una cuenta? Crea un cuenta aquí</a>
</div>