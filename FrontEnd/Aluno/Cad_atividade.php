<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    header('Location: ../Login/TelaDeLogin.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Horas</title>
  <link rel="stylesheet" href="Alunos.css" />
</head>
<body>

  <header>
    <div id="menu-container"></div>
  </header>

  <main class="conteudo">
    <h1>Cadastro de Atividade Complementar</h1>

    <form action="../../BackEnd/Aluno/Cad_atividade.php" method="POST" class="formulario" enctype="multipart/form-data">
      <label for="categoria">Categoria:</label>
      <select id="categoria" name="categoria" required>
        <option value="">Carregando categorias...</option>
      </select>
    
      <label for="descricao">Descrição:</label>
      <select id="descricao" name="descricao" required>
        <option value="">Selecione a categoria primeiro</option>
      </select>
    
      <label for="descricao-texto">Resumo da Atividade:</label>
      <textarea id="descricao-texto" name="descricao_texto" rows="4" required></textarea>
    
      <label for="horas">Quantidade de horas solicitadas:</label>
      <input type="number" id="horas" name="horas" min="1" required />
    
      <label for="comprovante">Anexar comprovante (PDF):</label>
      <input type="file" id="comprovante" name="comprovante" accept="application/pdf" required />
    
      <button type="submit" class="botao-principal">Enviar Atividade</button>
    </form>
    
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const selectCategoria = document.getElementById('categoria');
      const selectDescricao = document.getElementById('descricao');

      // Carrega as categorias do banco
      fetch('../../BackEnd/Aluno/Listar_categorias.php')
        .then(res => res.json())
        .then(data => {
          selectCategoria.innerHTML = '<option value="">Selecione</option>';
          data.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.Id;
            option.textContent = cat.Categoria;
            selectCategoria.appendChild(option);
          });
        })
        .catch(err => {
          alert("Erro ao carregar categorias: " + err.message);
        });

      // Quando muda a categoria, carrega as descrições vinculadas
      selectCategoria.addEventListener('change', () => {
        const categoriaId = selectCategoria.value;

        if (!categoriaId) {
          selectDescricao.innerHTML = '<option value="">Selecione a categoria primeiro</option>';
          return;
        }

        fetch(`../../BackEnd/Aluno/Listar_descricoes_por_categoria.php?categoriaId=${categoriaId}`)
          .then(res => res.json())
          .then(data => {
            selectDescricao.innerHTML = '<option value="">Selecione</option>';
            if (data.length === 0) {
              selectDescricao.innerHTML = '<option value="">Nenhuma descrição encontrada</option>';
              return;
            }

            data.forEach(desc => {
              const option = document.createElement('option');
              option.value = desc.Id;
              option.textContent = desc.Descricao;
              selectDescricao.appendChild(option);
            });
          })
          .catch(err => {
            alert("Erro ao carregar descrições: " + err.message);
          });
      });
    });
  </script>

  <script src="Menu.js"></script>
</body>
</html>
