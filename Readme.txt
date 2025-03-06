TCC

Plataforma de registro e contabilização de horas complementares
Sistema Web para anexar certificados e contabilizar horas complementares

Usuários:
Aluno
	Realiza um cadastro contendo:
	Nome
	RA
	Curso

Professor (ADM)
	Realiza cadastro simples contendo:
	Nome
	CPF OU ID
	Curso que ministra a aula

Plataforma do aluno:
	Entra com login e senha ou cria o login
	Anexa o certificado
	Cadastra colocando a categoria dele (Tipo: (curso, palestra, trabalho) Carga horária:(5h,10h,15h...)  
	Opção de enviar, editar, excluir e adicionar

Plataforma do professor:
	Entra com login e senha
	Vai ter um filtro para verificara listagem do curso e o período 
	Esta listagem será exibida de forma alfabética com o nome do aluno
	Clicando no nome do aluno irá exibir todos os certificados já cadastrados por ele 
	Em cada certificado o professor adiciona a quantidade de horas que equivale e o sistema calcula a quantidade de horas totais que o aluno obteve 

	
Tabelas

	Coordenador:
		Id
		Nome
		RA
		Curso

	Aluno:
		Id
		Nome
		RA
		Curso
		Período



------------------------------------------------------------------------------------ TCC (Tabelas)------------------------------------------------------------------------------------------

Tabelas

Coordenador:
Id (PK)
Nome
RA
Curso

Aluno:
Id (PK)
Nome
RA
Curso
Período

CategoriaAtividade:
Id (PK)
Descricao
CargaHorariaMaxima

AtividadeComplementar:
Id (PK)
AlunoId (FK -> Aluno.Id)
CategoriaAtividadeId (FK -> CategoriaAtividade.Id)
Descricao
Data
CargaHoraria
ArquivoComprovante
Status (Pendente, Aprovado, Rejeitado)
ObservacaoCoordenador

AvaliacaoAtividade:
Id (PK)
AtividadeComplementarId (FK -> AtividadeComplementar.Id)
CoordenadorId (FK -> Coordenador.Id)
DataAvaliacao
Status (Aprovado, Rejeitado)
Observacao

Relacionamentos:

Um Aluno pode submeter diversas AtividadesComplementares.

Uma AtividadeComplementar pertence a uma CategoriaAtividade.

Um Coordenador pode avaliar diversas AtividadesComplementares.

Uma AvaliacaoAtividade está vinculada a uma AtividadeComplementar e um Coordenador.

Notas Adicionais:

O campo ArquivoComprovante pode ser uma URL ou caminho do arquivo no servidor.

Status em AtividadeComplementar e AvaliacaoAtividade podem ser ENUM para facilitar validações.

O relacionamento entre AtividadeComplementar e AvaliacaoAtividade é 1:1, pois cada atividade é avaliada apenas uma vez.



TCC-HORAS-COMPLEMENTARES/
│
├── BackEnd/
│   ├── Aluno/
│   ├── Coordenador/
│   ├── Login/
│   │   ├── login.php
│   │   ├── conexao.php
│   ├── Data/
│
├── FrontEnd/
│   ├── Aluno/
│   ├── Coordenador/
│   ├── Login/
│   │   ├── TelaDeLogin.css
│   │   ├── TelaDeLogin.html
│   │   ├── TelaDeLogin.js
│
└── Readme.txt

----------------------------------------------------------------------------------------TCC (Telas)-----------------------------------------------------------------------------------------

Telas da Plataforma

Login:

Campos: RA, Senha

Botões: Entrar

Opções: Esqueci minha senha



Dashboard Aluno:

Exibição das AtividadesComplementares submetidas

Status das AtividadesComplementares

Botão para Submeter Nova Atividade

Submissão de Atividade:

Campos: Categoria, Descrição, Data, Carga Horária, Upload do Comprovante

Botões: Enviar, Cancelar



Dashboard Coordenador:

Lista de AtividadesComplementares pendentes

Opção para Avaliar Atividade



Avaliação de Atividade:

Exibição dos detalhes da AtividadeComplementar

Campos: Status (Aprovado/Rejeitado), Observação

Botões: Enviar Avaliação, Cancelar




Perfil do Usuário:

Exibição dos dados do Aluno ou Coordenador

Opção para Alterar Senha




Recuperação de Senha:

Campo: RA

Botão: Enviar Instruções


----------------------------------------------------------------------------------------TCC (GitHub)-----------------------------------------------------------------------------------------
		


Dicas para o uso do git:

Fork do Repositório:

1 - Vá até o repositório original do projeto de "tcc-horas-complementares".
2 - Clique no botão Fork no canto superior direito da página.
3 - Isso criará uma cópia do repositório no seu perfil do GitHub, permitindo que você faça alterações sem afetar o projeto original.



Clone o Repositório Forkado para a Sua Máquina:

1 - No seu perfil do GitHub, acesse o repositório "tcc-horas-complementares" que você acabou de forkar.
2 - Clique no botão Code e copie o link HTTPS ou SSH para clonar o repositório.
3 - Abra o terminal ou Git Bash na sua máquina e execute o comando para clonar o repositório:

git clone https://github.com/gpatativa/tcc-horas-complementares.git

4 - Isso criará uma pasta chamada "tcc-horas-complementares" com o conteúdo do projeto.



Crie uma Nova Branch para Fazer Suas Alterações

1 - Para manter seu trabalho organizado, crie uma nova branch para suas mudanças:

git checkout -b melhorias-na-interface (Apenas um exemplo!)

2 - Isso cria uma nova branch e muda para ela automaticamente.



Faça as Alterações Necessárias no Projeto

1 - Abra o projeto em um editor de código de sua preferência e faça as alterações desejadas (por exemplo, ajuste de design, correção de bugs ou melhorias de funcionalidade).
2 - Salve todas as alterações no seu editor.



Adicione as Alterações ao Stage e Faça um Commit

1 - Depois de fazer as alterações, adicione-as ao "stage" (área de preparação para commit):

git add .

2 - Em seguida, faça um commit com uma mensagem explicativa:

git commit -m "Melhorias na interface" (Apenas um exemplo!)



Envie Suas Alterações para o Seu Repositório no GitHub

1 - Agora, você precisa "empurrar" (push) as alterações para o repositório remoto (o fork no seu GitHub):

git push origin melhorias-na-interface (Apenas um exemplo!)



Crie uma Pull Request no Repositório Original

1 - Após o push, vá ao repositório "tcc-horas-complementares" no seu perfil do GitHub.
2 - Você verá uma mensagem sugerindo a criação de uma pull request (PR). Clique em Compare & pull request.
3 - Na página da pull request, adicione uma descrição clara do que foi alterado e por que.
4 - Clique em Create pull request para submeter a PR para revisão.
