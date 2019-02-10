Versões das ferramentas:

Desenvolvido no Linux Mint V. 19
Apache 2.4.29
MySQL V. 5.7.23, para Linux (x86_64) usando  EditLine wrapper
PHP V. 7.0
CodeIgniter V. 3.1.10
Bootstrap V. 4.2.1
Fontawesome V. 5.7.1


Instalação:

Configurar hambiente de desenvolvimento/servidor com Apache, MySQL e PHP nas versões citadas acima;
Puxar o projeto;
Importar o arquivo de banco de dados (testesolusoft.sql somente a estrutura ou testesolusoftpovoado.sql com dados) que esta na pasta "Banco de dados" na raiz do projeto;
Configurar o dataBase.php do Codeigniter com o nome do banco, local, usuario e senha do mysql;
Configurar o config.php com o local onde será rodado o sistema (está localhost como padrão);

Instalar a mPDF por meio do composer:
Instalar o composer;
Abra o terminal na raiz do projeto e de o seguinte comando: composer require mpdf/mpdf;
Dar permissão 755 ou 777 para a pasta e arquivos da vendor na raiz do projeto;

Tudo pronto.


Testado em: 

Linux Mint V. 19: Google Chrome e FireFox;
Windows 10: Google Chrome e FireFox;