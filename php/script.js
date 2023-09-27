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

const mainImg = document.getElementById("zoomImg");
const thumbnails = document.querySelectorAll(".prod2");

thumbnails.forEach((thumbnail) => {
  thumbnail.addEventListener("mouseover", () => {
    // Altera a imagem principal para a imagem da miniatura
    mainImg.src = thumbnail.src;
  });
});