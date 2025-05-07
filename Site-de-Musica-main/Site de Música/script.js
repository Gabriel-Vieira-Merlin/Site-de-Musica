document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formCadastro");
    const albunsLista = document.getElementById("albunsLista");
  
    form.addEventListener("submit", function (e) {
      e.preventDefault();
  
      // Captura dos campos
      const titulo = document.getElementById("titulo").value;
      const artista = document.getElementById("artista").value;
      const genero = document.getElementById("genero").value;
      const imagemInput = document.getElementById("imagem");
  
      const arquivoImagem = imagemInput.files[0];
  
      if (!arquivoImagem) {
        alert("Selecione uma imagem para o álbum.");
        return;
      }
  
      const leitor = new FileReader();
  
      leitor.onload = function (evento) {
        const imagemURL = evento.target.result;
  
        // Criação do card de álbum
        const card = document.createElement("div");
        card.classList.add("album-card");
  
        card.innerHTML = `
          <img src="${imagemURL}" alt="Capa do álbum ${titulo}" class="album-cover">
          <div class="album-content">
            <h3>${titulo}</h3>
            <div class="album-info">
              <p><strong>Artista:</strong> ${artista}</p>
              <p><strong>Gênero:</strong> ${genero}</p>
            </div>
          </div>
        `;
  
        albunsLista.appendChild(card);
        form.reset();
      };
  
      leitor.readAsDataURL(arquivoImagem);
    });
  });
  