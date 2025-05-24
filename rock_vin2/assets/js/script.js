document.addEventListener('DOMContentLoaded', function() {
    // Contador de caracteres para análises
    const reviewTextarea = document.getElementById('review');
    if (reviewTextarea) {
        const charCount = document.getElementById('charCount');
        
        // Atualizar contador inicial
        charCount.textContent = reviewTextarea.value.length;
        
        // Atualizar contador enquanto digita
        reviewTextarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
            
            // Limitar a 500 caracteres
            if (this.value.length > 500) {
                this.value = this.value.substring(0, 500);
                charCount.textContent = 500;
            }
        });
    }
    
    // Efeito hover nos cards de álbum
    const albumCards = document.querySelectorAll('.album-card');
    albumCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 20px rgba(255, 107, 53, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });
    
    // Máscara para campos numéricos
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(input => {
        input.addEventListener('keydown', function(e) {
            // Permitir: backspace, delete, tab, escape, enter, ponto decimal
            if ([46, 8, 9, 27, 13, 110, 190].includes(e.keyCode) ||
                // Permitir: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (e.keyCode == 65 && e.ctrlKey === true) || 
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 86 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                // Permitir: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
            }
            // Impedir tudo que não for número
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
    
    // Validação de URL da capa do álbum
    const coverUrlInput = document.getElementById('cover_url');
    if (coverUrlInput) {
        coverUrlInput.addEventListener('change', function() {
            if (this.value && !isValidUrl(this.value)) {
                alert('Por favor, insira uma URL válida para a capa do álbum.');
                this.focus();
            }
        });
    }
});

function isValidUrl(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}