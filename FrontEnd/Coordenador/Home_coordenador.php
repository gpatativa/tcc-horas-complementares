<?php
session_start();
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'coordenador') {
    header("Location: ../Login/TelaDeLogin.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma do Coordenador</title>
    <link rel="stylesheet" href="PlataformaCoordenador.css">
   <!-- -- <link rel="stylesheet" href="../Aluno/Alunos.css"> -->
    
    <script defer src="Menu.js"></script> 
</head>
<body>
    
    <div id="menu-container"></div>

    <main class="conteudo">
        <div class="tabela-home">
          <h2>Tabela de Atividades</h2>
          <table class="table-home">
            <thead>
              <tr>
                <th>Categoria</th>
                <th>Descrição das atividades</th>
                <th>Limite para cômputo das horas-aula</th>
              </tr>
            </thead>
            <tbody>
              <tr><td rowspan="5">Extensão</td><td>Autoria e execução de projetos</td><td>25</td></tr>
              <tr><td>Execução de trabalho de projeto docente</td><td>15</td></tr>
              <tr><td>Organização e ministrante de cursos</td><td>15</td></tr>
              <tr><td>Ministrante de cursos organizados por docentes</td><td>10</td></tr>
              <tr><td>Autoria de software extracurricular</td><td>50% da carga horária total</td></tr>
      
              <tr><td rowspan="3">Pesquisa</td><td>Autoria e execução de projetos</td><td>25</td></tr>
              <tr><td>Execução de trabalho de projeto docente</td><td>15</td></tr>
              <tr><td>Trabalho acadêmico (1 por disciplina)</td><td>5</td></tr>
      
              <tr><td rowspan="3">Resenhas</td><td>Resenha de livro completo</td><td>10</td></tr>
              <tr><td>Resenha de capítulo</td><td>5</td></tr>
              <tr><td>Resenha de filme</td><td>3</td></tr>
      
              <tr><td rowspan="3">Publicações</td><td>Artigo completo como autor</td><td>15</td></tr>
              <tr><td>Artigo completo como co-autor</td><td>10</td></tr>
              <tr><td>Resumos em Anais</td><td>10</td></tr>
      
              <tr><td rowspan="5">Eventos Científicos</td><td>Organização</td><td>20</td></tr>
              <tr><td>Ouvinte</td><td>5</td></tr>
              <tr><td>Apresentação de trabalho científico</td><td>15</td></tr>
              <tr><td>Mini-cursos ou oficinas</td><td>5</td></tr>
              <tr><td>Ministrante / Palestrante</td><td>15</td></tr>
      
              <tr><td rowspan="2">Palestras, Oficinas e Mini-cursos</td><td>Ouvinte</td><td>5</td></tr>
              <tr><td>Ministrante</td><td>10</td></tr>
      
              <tr><td rowspan="2">Cursos com +30 horas</td><td>Ouvinte</td><td>15</td></tr>
              <tr><td>Ministrante</td><td>25</td></tr>
      
              <tr><td>Representação Discente</td><td>No curso (1 ano)</td><td>10</td></tr>
      
              <tr><td>Atividades Pedagógicas</td><td>Reunião pedagógica</td><td>5</td></tr>
      
              <tr><td>Visitas Técnicas</td><td>Visitas em empresas e instituições</td><td>5</td></tr>
      
              <tr><td rowspan="2">Monitoria</td><td>No curso (por semestre)</td><td>15</td></tr>
              <tr><td>Fora do curso (área educacional)</td><td>50% da carga horária total</td></tr>
      
              <tr><td>Estágio</td><td>Não-obrigatório (extracurricular)</td><td>50% da carga horária total</td></tr>
            </tbody>
          </table>
        </div>
    </main>
</body>
</html>
