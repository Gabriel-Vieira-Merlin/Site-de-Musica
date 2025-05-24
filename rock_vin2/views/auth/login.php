<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card bg-dark border-orange">
            <div class="card-header bg-dark text-orange border-bottom-orange">
                <h3 class="text-center retro-font">Login</h3>
            </div>
            <div class="card-body">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="index.php?action=login" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control bg-dark text-light border-orange" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control bg-dark text-light border-orange" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn-nu btn-lg">Entrar</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    <p>Não tem uma conta? <a href="index.php?action=register" class="text-orange">Registre-se</a></p>
                </div>
            </div>
        </div>
    </div>
</div>