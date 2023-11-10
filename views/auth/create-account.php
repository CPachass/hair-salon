<h1 class="page-name">Crear cuenta</h1>
<p class="page-description">Llena esta formulario para crear tu cuenta</p>

<?php 
include_once __DIR__ . '/../templates/alerts.php'; 
?>

<form action="/create-account" class="form" method="POST">
    <div class="field">
        <label for="name">Nombre</label>
        <input 
            type="text" 
            name="name" 
            id="name" 
            placeholder="Tu nombre"
            value="<?php echo sanitizeHTML($user->name)?>"
        />
    </div>

    <div class="field">
        <label for="lastname">Apellido</label>
        <input 
            type="text" 
            name="lastname" 
            id="lastname" 
            placeholder="Tu apellido"
            value="<?php echo sanitizeHTML($user->lastname)?>"
        />
    </div>

    <div class="field">
        <label for="phone">Teléfono</label>
        <input 
            type="tel" 
            name="phone" 
            id="phone" 
            placeholder="Tu teléfono"
            value="<?php echo sanitizeHTML($user->phone)?>"
        />
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            placeholder="Tu E-Mail"
            value="<?php echo sanitizeHTML($user->email)?>"
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

    <input type="submit" value="Crear cuenta" class="button">
</form>

<div class="actions">
    <a href="/">Ya tienes una cuenta? Inicia sesión aquí</a>
    <a href="/forgot-password">Olvidaste tu contraseña? Recupera tu cuenta aquí</a>
</div>