<?php
function mostrarTabela($result)
{
  echo "
  <table border='1'>
    <tr>
      <th>Nome</th>
      <th>Email</th>
      <th>Telefone</th>
      <th>Endereço</th>
      <th>Cidade</th>
    </tr>
    ";
  while ($linha = pg_fetch_assoc($result)) {
    echo "
      <tr>
        <td>" . $linha['nome'] . "</td>
        <td>" . $linha['email'] . "</td>
        <td>" . $linha['telefone'] . "</td>
        <td>" . $linha['endereco'] . "</td>
        <td>" . $linha['cidade'] . "</td>
      </tr>
      ";
  }
  echo "
  </table>
  ";
}
