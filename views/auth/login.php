<h1 class="page-name">Login</h1>
<p class="page-description">Login with your data</p>

<form class="form" action="/" method="POST">
    <div class="field">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            placeholder="Your Email"
        />
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            placeholder="Your Password"
        />
    </div>

    <input type="submit" value="Login" class="button">
</form>

<div class="actions">
    <a href="/create-account">Don't have an account yet? Create one here</a>
    <a href="/forgot">Forgot your password? Recover your account here</a>
</div>