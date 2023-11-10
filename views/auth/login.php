<h1 class="page-name">Inicia sesión</h1>
<p class="page-description">Inicia sesión con tus datos</p>

<?php 
include_once __DIR__ . '/../templates/alerts.php'; 
?>

<form class="form" action="/" method="POST">
    <div class="field">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            placeholder="Tu E-Mail"
        />
    </div>

    <div class="field">
        <label for="password">Contraseña</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            placeholder="Tu contraseña"
        />
    </div>

    <input type="submit" value="Inicia sesión" class="button">
</form>

<div class="actions">
    <a href="/create-account">Todavía no tienes una cuenta? Crea un cuenta aquí</a>
    <a href="/forgot-password">Olvidaste tu contraseña? Recupera tu cuenta aquí</a>
</div>