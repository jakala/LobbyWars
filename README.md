# Lobby Wars
Es una aproximación a un problema de conflictos entre dos partes en pleito legal. Cada parte 
contratante (de la primera parte :) ) puede tener una o varias firmas. La forma de resolver el pleito
es analizar dichas firmas, asignarlas una puntuación y ver cual de las dos partes tiene mayor puntuación. Esa
parte será la ganadora del pleito.

Este ejercicio se ha iniciado con un proyecto propio de definición de esqueleto DDD con Symfony5 y PHP8. 
He añadido un Docker-compose para crear un contenedor con la versión de php y configurado para que monte el directorio 
de la app. Se pueden ver más detalles en el projecto [skeleton](https://github.com/jakala/skeleton) 

## Estructura de Carpetas
```
src
├── Application
│   ├── Command
│   ├── Exception
│   ├── Handler
│   ├── Response
│   └── Service
├── Domain
│   ├── Entity
│   ├── Event
│   ├── Exception
│   └── ValueObject
├── Infrastructure
└   └── Controller
```
## Requisitos
- git
- docker y docker-compose
- composer
## Instalación
- clonar el repositorio con `git clone git@github.com:jakala/LobbyWars.git lobbywars`
- entrar en el directorio `cd lobbywars` e instalar vendors: `composer install --ignore-platform-reqs`
- iniciar el contenedor con `docker-compose up -d`
## Uso de la aplicación
- TODO: documentar uso
# TODO:
- CQRS
- behat
- coverage
- más documentación
