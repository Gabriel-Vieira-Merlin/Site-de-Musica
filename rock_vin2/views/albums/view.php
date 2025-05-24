<div class="card bg-dark border-orange">
    <div class="card-header bg-dark text-orange border-bottom-orange d-flex justify-content-between align-items-center">
        <h3 class="mb-0 retro-font">Detalhes do Álbum</h3>
        <a href="index.php?action=listAlbums" class="btn btn-sm btn-orange"><i class="fas fa-arrow-left"></i> Voltar</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <?php if(!empty($this->album->cover_url)): ?>
                    <img src="<?php echo htmlspecialchars($this->album->cover_url); ?>" class="img-fluid rounded border border-orange" alt="Capa do álbum">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-secondary rounded" style="height: 300px;">
                        <i class="fas fa-music fa-7x text-dark"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Título:</div>
                    <div class="col-sm-9"><?php echo htmlspecialchars($this->album->title); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Artista:</div>
                    <div class="col-sm-9"><?php echo htmlspecialchars($this->album->artist); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Ano:</div>
                    <div class="col-sm-9"><?php echo htmlspecialchars($this->album->release_year); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Gênero:</div>
                    <div class="col-sm-9"><span class="badge bg-orange text-dark"><?php echo htmlspecialchars($this->album->genre); ?></span></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Avaliação:</div>
                    <div class="col-sm-9">
                        <?php 
                            $rating = $this->album->rating;
                            echo str_repeat('★', $rating) . str_repeat('☆', 5 - $rating) . " ($rating/5)";
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Análise:</div>
                    <div class="col-sm-9"><?php echo nl2br(htmlspecialchars($this->album->review)); ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3 fw-bold">Adicionado em:</div>
                    <div class="col-sm-9"><?php echo date('d/m/Y H:i', strtotime($this->album->created_at)); ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3 fw-bold">Atualizado em:</div>
                    <div class="col-sm-9"><?php echo date('d/m/Y H:i', strtotime($this->album->updated_at)); ?></div>
                </div>
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="index.php?action=editAlbum&id=<?php echo $this->album->id; ?>" class="btn-nu btn-lg"><i class="fas fa-edit"></i> Editar</a>
                    <a href="index.php?action=deleteAlbum&id=<?php echo $this->album->id; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este álbum?')"><i class="fas fa-trash"></i> Excluir</a>
                </div>
            </div>
        </div>
    </div>
</div>