# Laboratorio de Docker

## Instalación

Antes de nada, tenemos que comprobar si tenemos instalado Docker correctamente:

```
$ docker --version
Docker version 19.03.6, build 369ce74a3c
```

En este caso hemos dejado las VM preparadas con Docker.

Si no lo tuvieramos instalado, nenecesitaríamos instalar Docker siguiendo la [guía de instalación oficial](https://docs.docker.com/install/)

## 1 - Ejercicios de introducción

### 1.1 - Hola mundo

```
docker run ubuntu /bin/echo 'Hola mundo'
```

- **docker run** comando para ejecutar un contenedor
- **ubuntu** imagen que queremos utilizar. Primero lo buscará en local, y si no existe después en Docker Hub
- **/bin/echo 'Hola mundo'** comando que queremos ejecutar

### 1.2 - Shell interactivo

```
docker run -i -t --rm ubuntu /bin/sh
```

- **-i** opción para conexión interactiva (STDIN del contenedor)
- **-t** establecer una pseudo-tty o terminal con el contenedor
- **--rm** eliminar el contenedor automáticamente tras la ejecución

### 1.3 - Servicio tipo daemon

```
docker run --name kaixodaemon -d ubuntu /bin/sh -c "while true; do echo kaixo mundua; sleep 1; done"
```

- **--name kaixodaemon** definimos el nombre del contenedor como kaixodaemon. Si no le ponemos un nombre, cogerá uno al azar
- **-d** ejecutará el comando en background

### 1.4 - ¿Qué está pasando?

Veamos que se está ejecutando:

```
docker ps -a
```

- **docker ps** para listar los procesos de contenedores
- **-a** mostraro todos los procesos (también los que están terminados)

```
docker logs -f kaixodaemon
```

- **docker logs** muestra los logs de un contenedor
- **-f** opción para continuar la salida del log (como tail -f)

### 1.5 - Gestionando la ejecución de contenedores

Vamos a parar la ejecución de nuestro contenedor:

```
docker stop kaixodaemon
```

Para asegurarnos que se ha parado:

```
docker ps -a
```

Si queremos, podemos volver a ponerlo en marcha:

```
docker start kaixodaemon
```

Para terminar, vamos a parar y borrar el contenedor:

```
docker stop kaixodaemon
docker rm kaixodaemon
```

## 2 - Variables de entornos, puertos y volúmenes

### 2.1 - Servidor web

Antes de continuar, recomendamos descargar el siguiente [fichero](https://github.com/Elkarnet/docker-ikastaroa/archive/master.zip). Descomprime el fichero y accede al directorio **labs/run-adibideak/nginx**:

```
cd labs/run-adibideak/nginx
```

Vamos a ejecutar el siguiente comando:

```
docker run -d --name "lab-nginx" -p 8080:80 -v $(pwd):/usr/share/nginx/html:ro nginx:latest
```

- **-p** lo utilizamos para definir el mapeo del puerto **HOST PORT:CONTAINER PORT**
- **-v** para definir el mapeo del volumen **HOST DIRECTORY:CONTAINER DIRECTORY**

**Importante**: el comando run solo admite paths absolutos

Ahora vamos a acceder a la siguiente URL, utilizando nuestro navegador:

`http://127.0.0.1:8080`

Si queremos, podemos modificar el fichero **lab/nginx/index.html** y refrescar la página. ¿Vemos que se aplican los cambios?

### 2.2 Inspección de containers

Cómo es el container **lab-nginx**? Vamos a analizarlo:

```
docker inspect lab-nginx
```

### 2.3 Otros ejemplos prácticos



## 3 - Construcción de imágenes

### 3.1 Generando nuestro primer Dockerfile

Para generar una imagen de Docker, tenemos que crear un fichero llamado `Dockerfile`. Se trata de un simple fichero de texto, con instrucciones y variables. Por ejemplo, las instrucciones que vamos a emplear a continuación:

- **FROM** -- establecer imagen base
- **RUN** -- ejecutar un comando dentro del contenedor
- **ENV** -- definir una variable de entorno
- **WORKDIR** -- establecer el directorio de trabajo
- **VOLUME** -- punto de montaje para un volumen
- **CMD** -- comando que va a ejecutar el contenedor

Para más detalles sobre cada instrucción, consultar la [referencia de Dockerfile](https://docs.docker.com/engine/reference/builder/) begiratu.

Vamos a generar nuestra primera imagen. Utilizaremos **curl** para descargar el contenido de una URL a un fichero de texto. Definiremos la URL del sitio web a través de una variable de entorno `SITE_URL`. El resultado lo dejaremos sobre un volumen montado en el directorio actual.

```
FROM ubuntu:latest
RUN apt-get update \
    && apt-get install --no-install-recommends --no-install-suggests -y curl \
    && rm -fr /var/lib/apt/lists/*
ENV SITE_URL http://example.com
WORKDIR /data
VOLUME /data
CMD sh -c "curl -Lk $SITE_URL > /data/results"
```

Para construir la imagen, tenemos que usar `docker build`:

```
docker build . -t lab-curl
```

- **docker build** comando de construcción de una imagen
- **.** utilizar los ficheros (Dockerfile, etc) del directorio actual
- **-t** establecer un nombre para nuestra imagen (lab-curl)

### 3.2 Listando imágenes

```
docker images
```

Obtendremos un listado de imágenes disponibles en local

### 3.3 Utilizando nuestra imagen

Vamos a ejecutar un contenedor basado en la imagen que acabamos de constuir:

```
docker run --rm -v $(pwd):/vol:/data/:rw lab-curl
```

Deberías obtener algún resultado en el fichero **./vol/results**.

### 3.4 Utilizando las variables de entorno

¿Y si quisieramos descargar otro sitio web diferente?

Para ello podemos hacer uso de la variable de entorno que hemos definido antes:

```
docker run --rm -e SITE_URL=https://facebook.com/ -v $(pwd)/vol:/data/:rw lab-curl
```

## 4 - Docker-compose

## Honi buruz

Hurrengo webgune hauetan oinarritua:

- https://github.com/alexellis/HandsOnDocker/blob/master/Labs.md
- https://github.com/alexryabtsev/docker-workshop