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
se trata de una "competición" entre partes en pleito. Cada parte indica un código de tres caracteres que representa las firmas
que tiene. Estos caracteres son:

- K: (K)ing. 5 puntos
- N: (N)notary. 2 puntos
- V: (V)alidator. 1 punto (no valido si hay un (k))
- E: (E)mpty (desconocido) 0 puntos.
- D: (D)rop (interno, para indicar que se pierde siempre)
- W: (W)in (interno, para indicar que se gana siempre)

> Utilizamos (E) como valor desconocido, para evitar problemas con la URL, puesto que el simbolo # se utiliza
> para links internos de una web.

Tenemos dos endpoints con los que tratar este tipo de pleitos. Analizamos cada caso:
### parte 1: quien gana 
disponemos del endpoint siguiente:
```
/which-one-wins/{plaintiff}/vs/{defendant}
```
se entiende que el primer parametro es la acusacion, y el segundo parametro la defensa. En este caso, cada uno
de los parametros debe tener los 3 caracteres de firma validos, y no se admite (E). Un ejemplo de ejecución seria:

```
http://localhost:8000/which-one-wins/KNV/vs/KVV
```
y una respuesta a esta petición seria un json como el siguiente:

```
{
    "plaintiff":"KNV",
    "defendant":"KVV",
    "winner":"plaintiff"
}
```

### parte 2: codigo necesario para ganar
en este caso disponemos del siguiente endpoint:
```
/how-to-win/{defendant}/vs/{plaintiff}
```
entendemos los parametros al reves, puesto que queremos saber como ganar nosotros (defendant) a la acusacion (plaintiff).
Aqui Si podemos disponer del caracter (E)mpty, para representar la unica firma que nos falta para poder ganar. Entendemos que
el objetivo es ganar, por lo que este calculo se hace con intencion de ganar. Se pueden dar
tres casos principales:
- `always win`: es un posible caso de combinacion en el que, cualquier valor que añadamos en las firmas nos hace ganar.
- `{winnerKey}`: nos indicará que tipo de firma necesitamos para poder ganar el pleito
- `cannot win`: es imposible, con lo que tenemos hasta ahora, obtener un valor para ganar 

un ejemplo de llamada al endpoint seria:
```
http://localhost:8000/how-to-win/NEV/vs/KKK
```
podemos ver que defendant tiene N y V, y un valor desconocido. En cambio plaintiff tiene 3K. No existe posibilidad
de ganar con ninguna combinacion, por lo que tendremos una respuesta perdedora, como:
```
{
    "defendant":"NEV",
    "plaintiff":"KKK",
    "winnerKey":"Always drop"
}
```

para el caso contrario, una llamada ganadora absoluta: 
```
http://localhost:8000/how-to-win/KKE/vs/VVN
```
La respuesta es:
```
{
    "defendant":"KKE",
    "plaintiff":"VVN",
    "winnerKey":"Always win"
}
```

Para un caso genérico en el que hay posiblidad de ganar, `winnerKey` nos indicará que letra necesitamos. Para un
ejemplo como:
```
http://localhost:8000/how-to-win/NEV/vs/NVV
```
La respuesta es:
```
{
    "defendant":"NEV",
    "plaintiff":"NVV",
    "winnerKey":"N"
}
```

### Decisiones personales:
Dado que el problema está abierto a interpretación, he tomado las siguientes decisiones personales:

- Entre los codigos aceptados, estan K, N, V, E. Este ultimo debido a que una url puede interpretar # como ancla de html, 
e introduce problemas. Para evitarlo y no analizar una correccion, he decidido cambiarlo por (E)mpty.

- la response de la parte dos internamente utiliza, ademas de K, N, V, los valores (D)rop y (W)in:
  - D: (D)rop (interno, para indicar que se pierde siempre)
  - W: (W)in (interno, para indicar que se gana siempre)


- TODO: documentar uso
# TODO:
- CQRS
- behat
- coverage
- más documentación
