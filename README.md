# Ejemplos de construccion de imágenes y contenedores

Este Proyecto contiene pequeños ejemplos de construcciones de **contenedores e imágenes** usados como apoyo para la sesión explicativa de docker

Cada directorio es un ambiente independiente de dockerización
En las transparencias utilizadas para el curso, se irán referenciando de forma explícita.


## 1_bash

Creamos un docker para ejectutar un shell
```shell
docker compose up
docker compose run bash
```

## 2_red
Se crean dos contenedores a partir del mismo Dockerfile
Para arrancarlos hay un pequeño script que lanza cada contenedor en una ventana independinete **gnome-terminal -x**
Para ejecutarlo, si estás en linux puedes hacer simplemente
```shell
sh ./execute
```
Te abrirá dos terminales y pudes probar  a ver qué ip tiene asiganda cada una y realizar ping
```shell
➜ ./execute 
root@equipo2:/# ifconfig
eth0: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 172.23.0.3  netmask 255.255.0.0  broadcast 172.23.255.255
.....
root@equipo1:/# ping 172.23.0.3
PING 172.23.0.3 (172.23.0.3) 56(84) bytes of data.
64 bytes from 172.23.0.3: icmp_seq=1 ttl=64 time=0.074 ms
****
```
Si no, abre dos terminales, en cada uno ejetua el contenedor   
```shell
docker compose exec -ti equipo1 bash
```
En el otro terminal  
```shell
docker compose exec -ti equipo2 bash
```

## 3_web_1
En este caso creamos una imagen con el *Dockerfile*, donde se instala apache2 php y se establece el la hora peninsular.

No es la forma de trabajar y este ejemplo se queda pero lo normal sería utilziar una imagen oficial que implmente el apache como se ve en el siguiente ejemplo
Este caso deja visible lo complicado que puede ser dejar el servicio en ejecución.
Para conseguir esto, se crea un proceso que no termina nunca, podríamos hacer un bucle infinito en lugar de ello
```shell
while true
do
 sleep 2
done
```
En este caso hacemos un *tail* en el fichero [**execute.sh**](./3_web_1/execute.sh) que pasamos al contenedor, además de arrancar el servicio de apache2

Creamos el servicio 
```shell
docker compose up -d 
```
Y podemos abrir el navegador para ver la aplicación desplegada. La misma la tenemos en la carpeta **[app](./3_web_1/app)**
Comentar también que este contenedor estaría mal creado, ya que no queda claro los procesos que se están ejecutando a quién pertenecen, por lo que cuando paro el contenedor se observa que tarda tiempo den parar.

## 5_env_command
En este caso creamos una variable de entorno, a la que le asignamos un valor con la variable del sistema $USER
Posteriormente le indicamos al servicio creado que visualice la variable
Vemos la ejecución cómo se visualiza

```shell
 5_env_command > docker compose up
[+] Running 1/0
 ⠿ Container container_bash  Recreated                                                                       0.0s
Attaching to container_bash
container_bash  | Valor de usuario oem
container_bash exited with code 0
➜  5_env_command git:(main) ✗ 
```


## 6_mysql_phpmyadmin
Esta sí que es una práctica que vamos a usar. Creamos un contenedor para gestionar datos y dejamos los datos mapeados en una carpeta llamada mysql

Por otro lado creamos un servicio para gestionar la base de datos a través de phpmyadmin

Vemos que hay una variables de entorno, que si no las pongo el proceso de generación me las pide

Realizamos el forward del puerto 8800 para acceder al apache que tiene el servicio phpmyadmin que gestiona los datos (phpmyadmin es una app escrita en php para adminsitrar bases de datos de un gestor mysql)


