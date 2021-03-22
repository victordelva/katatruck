# Test


### Pre-requisitos 📋

Docker y Docker Compose en tu maquina instalado en tu maquina

### Instalación 🔧

```
make install 
```

### Puesta en marcha del servicio

```
make up 
```

### Importa los coches a la base de datos.

El fichero de coches se encuentra en la raíz del proyecto, dentro de la carpeta `carsDatabase`.

Puedes ejecutar el siguiente commando para importarlos. 

```
make import-cars
```

### Endpoint `GET localhost:8888/cars`


Dispones de los siguientes parametros. 

Para el filtrado:
- brand
- model
- lessPrice
- morePrice

Para el ordenado: 
- orderBy: posibles valores; brand, model, price

Para el paginado
- page: valor > 1
- per_page: valor > 1


### Endpoint hacer car favorito `PUT localhost:8888/cars/{id}`

Donde {id} es el Id del coche que puedes ver en el listado de cars.

En el body deberas introducir un json con el parametro `fav` = `true` o `false`. Para indicar si quieres que sea favorito o no.
Ejemplo:

```
{
    "fav": true
}
```


## Tests ⚙️

```
make test
```


## Autores ✒️

* **Victor del Valle**
