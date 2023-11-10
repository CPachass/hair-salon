<h1 class="page-name">Olvidé mi contraseña</h1>
<p class="page-description">Resetea tu contraseña usando tu E-Mail</p>

<?php 
include_once __DIR__ . '/../templates/alerts.php'; 
?>

<form action="/forgot-password" class="form" method="POST">
    <div class="field">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email"
            placeholder="Tu Email"
        />
    </div>

    <input type="submit" value="Enviar instrucciones" class="button">
</form>

<div class="actions">
    <a href="/">Ya tienes una cuenta? Inicia sesión aquí</a>
    <a href="/create-account">Todavía no tienes una cuenta? Crea un cuenta aquí</a>
</div>