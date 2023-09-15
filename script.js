const imagem = document.querySelector(".imagem");
      const barraPesquisa = document.getElementById("barra-pesquisa");

      document.addEventListener("click", (e) => {
        if (e.target !== imagem) {
          barraPesquisa.classList.remove("mostrar-barra");
          imagem.classList.remove("animacao-rodar");
        }
      });
      imagem.addEventListener("click", () => {
        barraPesquisa.classList.toggle("mostrar-barra");
        imagem.classList.add("animacao-rodar");
        document.getElementById("pesquisa").focus();
        document.getElementById("pesquisa").addEventListener("blur", () => {
          barraPesquisa.classList.remove("mostrar-barra");
          imagem.classList.remove("animacao-rodar");
        });
      });