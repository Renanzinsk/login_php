# 🔐 Sistema de Login PHP (Vanilla)

Este repositório contém a evolução de um sistema de login simples construído com **PHP, HTML e CSS puro**, focado no entendimento dos fundamentos web sem o uso de frameworks externos.

---

## 🚀 Histórico de Atualizações (Commits)

Aqui está a linha do tempo de desenvolvimento do projeto:

* **🎉 Primeiro commit by Renan**
  * Inicialização do projeto e configuração do repositório no Git.

* **🎨 Segundo commit: Criado o `index.php`**
  * Construção da estrutura HTML e estilização com CSS puro. 
  * Foco apenas no conceito visual da interface de login, ainda sem lógica de validação por trás.

* **⚙️ Terceiro commit: Validação Regex e Mock de Banco de Dados**
  * Implementação de **Expressões Regulares (Regex)** no backend PHP para garantir o formato correto do e-mail.
  * Criação do arquivo `usuarios.json` para simular uma tabela de usuários e testar a busca de credenciais sem precisar de um banco SQL real.

* **🖥️ Quarto commit: Troca de tela aos inputs**
  * Adicionada renderização condicional dinâmica no PHP.
  * O sistema agora altera a tela inteira com base na resposta: tela **Verde** ("Usuário correto") para sucesso e tela **Vermelha** ("Usuário inválido") para falha de autenticação.

* **🛡️ Quinto commit: Ainda sem teste por xampp**
