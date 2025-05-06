/*
 * Arquivo JavaScript para o site Música Pro
 * Contém a lógica do player de música e do formulário de cadastro
 */

/*
 * ====================================
 * PLAYER DE MÚSICA (executa apenas na página index.html)
 * ====================================
 */
if (document.querySelector('.player')) {
    // Seleciona elementos do DOM
    const playlist = document.getElementById('playlist');
    const tracks = playlist.querySelectorAll('.track');
    const audioPlayer = document.getElementById('audioPlayer');
    const playPauseBtn = document.getElementById('playPauseBtn');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    // Variáveis de estado
    let currentTrack = 0; // Índice da faixa atual
    let isPlaying = false; // Estado de reprodução

    /**
     * Carrega uma faixa específica no player
     * @param {number} index - Índice da faixa a ser carregada
     */
    function loadTrack(index) {
        // Verifica se o índice é válido
        if (index < 0 || index >= tracks.length) return;
        
        // Remove a classe 'active' de todas as faixas
        tracks.forEach(track => track.classList.remove('active'));
        // Adiciona a classe 'active' na faixa atual
        tracks[index].classList.add('active');
        
        // Define a fonte do áudio como o data-src da faixa selecionada
        audioPlayer.src = tracks[index].dataset.src;
        currentTrack = index; // Atualiza o índice atual
        
        // Se estiver tocando, continua a reprodução
        if (isPlaying) {
            audioPlayer.play();
        }
    }

    /**
     * Alterna entre play e pause
     */
    function togglePlay() {
        if (audioPlayer.paused) {
            audioPlayer.play();
            playPauseBtn.textContent = 'Pause';
            isPlaying = true;
        } else {
            audioPlayer.pause();
            playPauseBtn.textContent = 'Play';
            isPlaying = false;
        }
    }

    // Adiciona eventos de clique para cada faixa
    tracks.forEach((track, index) => {
        track.addEventListener('click', () => {
            loadTrack(index);
            togglePlay();
        });
    });

    // Evento para o botão play/pause
    playPauseBtn.addEventListener('click', togglePlay);
    
    // Evento para o botão de faixa anterior
    prevBtn.addEventListener('click', () => {
        // Calcula o índice da faixa anterior (com loop)
        loadTrack((currentTrack - 1 + tracks.length) % tracks.length);
        if (isPlaying) audioPlayer.play();
    });
    
    // Evento para o botão de próxima faixa
    nextBtn.addEventListener('click', () => {
        // Calcula o índice da próxima faixa (com loop)
        loadTrack((currentTrack + 1) % tracks.length);
        if (isPlaying) audioPlayer.play();
    });
    
    // Quando uma faixa terminar, toca a próxima automaticamente
    audioPlayer.addEventListener('ended', () => {
        nextBtn.click();
    });

    // Carrega a primeira faixa ao iniciar
    loadTrack(0);
}

/*
 * ====================================
 * CADASTRO DE MÚSICAS (executa apenas na página cadastro.html)
 * ====================================
 */
if (document.getElementById('formCadastro')) {
    // Seleciona elementos do DOM
    const form = document.getElementById('formCadastro');
    const musicList = document.getElementById('musicasLista');
    
    /**
     * Obtém a lista de músicas do localStorage
     * @returns {Array} Lista de músicas cadastradas
     */
    function getMusicas() {
        return JSON.parse(localStorage.getItem('musicas')) || [];
    }
    
    /**
     * Salva uma nova música no localStorage
     * @param {Object} musica - Objeto contendo os dados da música
     */
    function saveMusica(musica) {
        const musicas = getMusicas();
        musicas.push(musica);
        localStorage.setItem('musicas', JSON.stringify(musicas));
    }
    
    /**
     * Renderiza a lista de músicas na tela
     */
    function renderMusicas() {
        const musicas = getMusicas();
        musicList.innerHTML = ''; // Limpa a lista
        
        // Para cada música, cria um elemento e adiciona à lista
        musicas.forEach(musica => {
            const item = document.createElement('div');
            item.textContent = `${musica.titulo} - ${musica.artista} (${musica.genero})`;
            musicList.appendChild(item);
        });
    }
    
    // Evento de submit do formulário
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Previne o comportamento padrão do formulário
        
        // Cria objeto com os dados da nova música
        const novaMusica = {
            titulo: document.getElementById('titulo').value,
            artista: document.getElementById('artista').value,
            genero: document.getElementById('genero').value
        };
        
        saveMusica(novaMusica); // Salva no localStorage
        renderMusicas(); // Atualiza a lista na tela
        form.reset(); // Limpa o formulário
    });
    
    // Carrega as músicas ao iniciar a página
    renderMusicas();
}