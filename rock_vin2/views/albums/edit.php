<div class="card bg-dark border-orange">
    <div class="card-header bg-dark text-orange border-bottom-orange">
        <h3 class="retro-font"><i class="fas fa-edit"></i> Editar Álbum</h3>
    </div>
    <div class="card-body">
        <form action="index.php?action=editAlbum" method="post">
            <input type="hidden" name="id" value="<?php echo $this->album->id; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Título do Álbum</label>
                <input type="text" class="form-control bg-dark text-light border-orange" id="title" name="title" value="<?php echo htmlspecialchars($this->album->title); ?>" required>
            </div>
            <div class="mb-3">
                <label for="artist" class="form-label">Artista</label>
                <input type="text" class="form-control bg-dark text-light border-orange" id="artist" name="artist" value="<?php echo htmlspecialchars($this->album->artist); ?>" required>
            </div>
            <div class="mb-3">
                <label for="release_year" class="form-label">Ano de Lançamento</label>
                <input type="number" class="form-control bg-dark text-light border-orange" id="release_year" name="release_year" min="1900" max="<?php echo date('Y'); ?>" value="<?php echo htmlspecialchars($this->album->release_year); ?>" required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Gênero Musical</label>
                <input type="text" class="form-control bg-dark text-light border-orange" id="genre" name="genre" value="<?php echo htmlspecialchars($this->album->genre); ?>" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Avaliação (1-5 estrelas)</label>
                <select class="form-select bg-dark text-light border-orange" id="rating" name="rating" required>
                    <option value="1" <?php echo $this->album->rating == 1 ? 'selected' : ''; ?>>★☆☆☆☆ (1)</option>
                    <option value="2" <?php echo $this->album->rating == 2 ? 'selected' : ''; ?>>★★☆☆☆ (2)</option>
                    <option value="3" <?php echo $this->album->rating == 3 ? 'selected' : ''; ?>>★★★☆☆ (3)</option>
                    <option value="4" <?php echo $this->album->rating == 4 ? 'selected' : ''; ?>>★★★★☆ (4)</option>
                    <option value="5" <?php echo $this->album->rating == 5 ? 'selected' : ''; ?>>★★★★★ (5)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="review" class="form-label">Análise (máx. 500 caracteres)</label>
                <textarea class="form-control bg-dark text-light border-orange" id="review" name="review" rows="5" maxlength="500"><?php echo htmlspecialchars($this->album->review); ?></textarea>
                <div class="form-text text-end"><span id="charCount"><?php echo strlen($this->album->review); ?></span>/500</div>
            </div>
            <div class="mb-3">
                <label for="cover_url" class="form-label">URL da Capa do Álbum</label>
                <input type="url" class="form-control bg-dark text-light border-orange" id="cover_url" name="cover_url" value="<?php echo htmlspecialchars($this->album->cover_url); ?>">
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="index.php?action=listAlbums" class="btn btn-secondary me-md-2">Cancelar</a>
                <button type="submit" class="btn-nu btn-lg">Atualizar</button>
            </div>
        </form>
    </div>
</div>