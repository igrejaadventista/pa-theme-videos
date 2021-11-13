[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=igrejaadventista_pa-theme-videos&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=igrejaadventista_pa-theme-videos)


# Portal Aventista - [videos.adventistas.org](https://videos.adventistas.org)
Esse tema foi desenvolvido para ser a base do portal de [videos](https://videos.adventistas.org). Ele depende to tema [PA-Theme-Sedes](https://github.com/igrejaadventista/pa-theme-sedes) (Por favor, instale-o junto).

### Instalando dependências globais
Siga as intruções antes começar a desenvolver no tema:

- Instalar [Yarn](https://classic.yarnpkg.com/en/docs/install) em seu ambiente de desenvolvimento
- Instalar [composer](https://getcomposer.org/download/) em seu ambiente de desenvolvimento

### Configurando o tema
Após ter instalado todas as dependências globais em sua máquina, já podemos inicializar o tema utilizando os seguintes comandos

1. Execute o comando a seguir para baixar as dependências:
        
        composer install

2. Execute os comandos:

        yarn install
        yarn build

### Atalhos para os assets do tema
 
      define('THEME_URI', get_stylesheet_directory_uri().'/');
      define('THEME_DIR', get_stylesheet_directory().'/');
      define('THEME_CSS', THEME_URI .'assets/css/');
      define('THEME_JS', THEME_URI .'assets/js/');
      define('THEME_IMGS', THEME_URI .'assets/images/');
