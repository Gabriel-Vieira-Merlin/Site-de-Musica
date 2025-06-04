<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="retro-font">Meus Álbuns</h1>
    <a href="index.php?action=createAlbum" class="btn btn-orange"><i class="fas fa-plus"></i> Novo Álbum</a>
</div>

<!-- Filtros -->
<div class="card bg-dark border-orange mb-4">
    <div class="card-header bg-dark text-orange border-bottom-orange">
        <h5 class="mb-0"><i class="fas fa-filter"></i> Filtros Avançados</h5>
    </div>
    <div class="card-body">
        <form method="get" action="index.php">
            <input type="hidden" name="action" value="listAlbums">
            <div class="row g-3">
                <!-- Filtro por Título -->
                <div class="col-md-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control bg-dark text-light border-orange" 
                           id="title" name="title" 
                           value="<?php echo isset($_GET['title']) ? htmlspecialchars($_GET['title']) : ''; ?>"
                           placeholder="Buscar álbum">
                </div>
                
                <!-- Filtro por Artista -->
                <div class="col-md-2">
                    <label for="artist" class="form-label">Artista</label>
                    <select class="form-select bg-dark text-light border-orange" id="artist" name="artist">
                        <option value="">Todos</option>
                        <?php while($artist = $artists->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo htmlspecialchars($artist['artist']); ?>"
                                <?php echo (isset($_GET['artist']) && $_GET['artist'] === $artist['artist']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($artist['artist']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <!-- Filtro por Gênero -->
                <div class="col-md-2">
                    <label for="genre" class="form-label">Gênero</label>
                    <select class="form-select bg-dark text-light border-orange" id="genre" name="genre">
                        <option value="">Todos</option>
                        <?php while($genre = $genres->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo htmlspecialchars($genre['genre']); ?>"
                                <?php echo (isset($_GET['genre']) && $_GET['genre'] === $genre['genre']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($genre['genre']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <!-- Filtro por Ano -->
                <div class="col-md-2">
                    <label for="release_year" class="form-label">Ano</label>
                    <select class="form-select bg-dark text-light border-orange" id="release_year" name="release_year">
                        <option value="">Todos</option>
                        <?php while($year = $years->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo htmlspecialchars($year['release_year']); ?>"
                                <?php echo (isset($_GET['release_year']) && $_GET['release_year'] === $year['release_year']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($year['release_year']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <!-- Filtro por Avaliação (Rating) -->
                <div class="col-md-2">
                    <label for="rating" class="form-label">Avaliação</label>
                    <select class="form-select bg-dark text-light border-orange" id="rating" name="rating">
                        <option value="">Todas</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo (isset($_GET['rating']) && $_GET['rating'] == $i) ? 'selected' : ''; ?>>
                                <?php echo str_repeat('★', $i) . str_repeat('☆', 5 - $i) . " ($i)"; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <!-- Botão Filtrar -->
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-nu w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Lista de Álbuns -->
<?php if($stmt->rowCount() > 0): ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="col">
                <div class="card h-100 bg-dark border-orange album-card">
                    <?php if(!empty($row['cover_url'])): ?>
                        <img src="<?php echo htmlspecialchars($row['cover_url']); ?>" class="card-img-top" alt="Capa do álbum" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center bg-secondary" style="height: 200px;">
                            <i class="fas fa-music fa-5x text-dark"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($row['artist']); ?></h6>
                        <div class="mb-2">
                            <?php 
                                $rating = (int)$row['rating'];
                                echo str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                            ?>
                        </div>
                        <p class="card-text text-truncate"><?php echo htmlspecialchars($row['review']); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-orange text-dark"><?php echo htmlspecialchars($row['genre']); ?></span>
                            <small class="text-muted"><?php echo htmlspecialchars($row['release_year']); ?></small>
                        </div>
                    </div>
                    <div class="card-footer bg-dark border-top-orange d-flex justify-content-between">
                        <a href="index.php?action=viewAlbum&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-nu-outline"><i class="fas fa-eye"></i></a>
                        <a href="index.php?action=editAlbum&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-nu-outline"><i class="fas fa-edit"></i></a>
                        <a href="index.php?action=deleteAlbum&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este álbum?')"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="alert alert-dark text-center">
        Nenhum álbum encontrado. <a href="index.php?action=createAlbum" class="text-orange">Adicione seu primeiro álbum!</a>
    </div>
<?php endif; ?>
