# Skeleton
Se trata de un proyecto de definición de esqueleto DDD con Symfony5 y PHP8. He añadido un Docker-compose para crear 
un contenedor con la versión de php y configurado para que monte el directorio de la app.

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
# TODO:
- CQRS
- phpunit y behat
- coverage
- mas documentacion
