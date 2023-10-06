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
function displayCharacters(characters) {
const pesquisa = document.getElementById("varNome");
pesquisa.addEventListener("keyup", (e) => {
  const searchString = e.target.value.toLowerCase();
  const filteredCharacters = characters.filter((character) => {
    return (
      character.name.toLowerCase().includes(searchString) ||
      character.nickname.toLowerCase().includes(searchString)
    );
  });
  displayCharacters(filteredCharacters);
});
}