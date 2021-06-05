# Teaching-HEIGVD-RES-2021-Labo-HTTPInfra

Auteurs : Christian Gomes & Johann Werkle

Date : 05.06.2021

## Objectives

The first objective of this lab is to get familiar with software tools that will allow us to build a **complete web infrastructure**. By that, we mean that we will build an environment that will allow us to serve **static and dynamic content** to web browsers. To do that, we will see that the **apache httpd server** can act both as a **HTTP server** and as a **reverse proxy**. We will also see that **express.js** is a JavaScript framework that makes it very easy to write dynamic web apps.

The second objective is to implement a simple, yet complete, **dynamic web application**. We will create **HTML**, **CSS** and **JavaScript** assets that will be served to the browsers and presented to the users. The JavaScript code executed in the browser will issue asynchronous HTTP requests to our web infrastructure (**AJAX requests**) and fetch content generated dynamically.

The third objective is to practice our usage of **Docker**. All the components of the web infrastructure will be packaged in custom Docker images (we will create at least 3 different images).

## General instructions

* This is a **BIG** lab and you will need a lot of time to complete it. 
* We have prepared webcasts for a big portion of the lab (**what can get you the "base" grade of 4.5**).
* Be aware that the webcasts have been recorded in 2016. There is no change in the list of tasks to be done, but of course **there are some differences in the details**. For instance, the Docker images that we use to implement the solution have changed a bit and you will need to do **some adjustments to the scripts**. This is part of the work and we ask you to document what the required adaptations in your report.
* The webcasts present one solution. Feeling adventurous and want to propose another one (for instance, by using nginx instead apache httpd, or django instead of express.js)? Go ahead, we **LOVE** that. Make sure to document your choices in the report. If you are not sure if your choice is compatible with the list of acceptance criteria? Not sure about what needs to be done to get the extra points? Reach out to the teaching team. **Learning to discuss requirements with a "customer"** (even if this one pays you with a grade and not with money) is part of the process!
* To get **additional points**, you will need to do research in the documentation by yourself (we are here to help, but we will not give you step-by-step instructions!). To get the extra points, you will also need to be creative (do not expect complete guidelines).
* The lab can be done in **groups of 2 students**. You will learn very important skills and tools, which you will need to next year's courses. You cannot afford to skip this content if you want to survive next year. Essentially, this means that it's a pretty bad idea to only have one person in the group doing the job...
* Read carefully all the **acceptance criteria**.
* We will request demos as needed. When you do your **demo**, be prepared to that you can go through the procedure quickly (there are a lot of solutions to evaluate!)
* **You have to write a report. Please do that directly in the repo, in one or more markdown files. Start in the README.md file at the root of your directory.**
* The report must contain the procedure that you have followed to prove that your configuration is correct (what you would do if you were doing a demo).
* Check out the **due dates** on the main repo for the course.

## Etape 1: Static HTTP server with apache httpd

Cette étape consiste à la création d'un serveur HTTP statique. Le but est de dockériser une image apache, où nous avons décidé d'utiliser la version 8.0. Nous sommes partis d'une image php trouvé sur le site 

[dockerhub]: https://hub.docker.com/_/php	"dockerhub"

Le dossier **Static_HTTP_Server** contient les fichiers nécessaires à cette partie. 

Le dossier **src** contient les fichiers necéssaires pour la page html qui sera copié dans le répertoire /var/www/html du container.

Deux scripts sont présents afin de lancer l'image : 

build_image_docker.sh permet de build avec un tag défini. 

```bash
docker build --tag  res/static_http_server .
```

run_docker.sh permet de démarrer en background le container. 

```bash
docker run -d --name apache_static res/static_http_server
```

Pour la partie 1 et afin de faciliter l'accès à la page HTML que nous avons modifié pour la démonstration, on peut lancer le script de cette manière et accèder en 

[localhost]: http://localhost:8080/

sur le port 8080. 

```bash
docker run -d -p 8080:80 --name apache_static res/static_http_server
```

**Exemple :** 

![](img/static_demo.PNG)

## Etape 2: Dynamic HTTP server with express.js

Cette étape consiste à la création d'un serveur HTTP dynamique avec l'utilisation du framework express.js qui est utile à la construction d'application web basées sur node.js. L'objectif est de retourner une liste aleatoire d'objets en json utiles aux prochaines étapes. Nous utilisons dans le Dockerfile la dernière image de node avec node:latest.

Nous avons utilisé **dummy-json** pour cela. Plus d'informations sur ce 

[github]: https://github.com/webroo/dummy-json

. 

On génére simplement 5 personnes avec les données "Firstname,Lastname,Age,Company,Email,Street,City et Country" en json. 

Le dossier **Dynamic_HTTP_Server** contient les fichiers nécessaires à cette partie. 

Le dossier **src** contient les fichiers necéssaires qui seront copiés sur le container pour la génération de cette page. 

Deux scripts sont présents afin de lancer l'image : 

build_image_docker.sh permet de build avec un tag défini. 

```bash
docker build --tag  res/dynamic_http_server .
```

run_docker.sh permet de démarrer en background le container. 

```bash
docker run -d --name express_dynamic res/dynamic_http_server
```

Pour la partie 2 et afin de faciliter l'accès aux données que nous générons pour la démonstration, on peut lancer le script de cette manière et accèder en 

[localhost]: http://localhost:3000/

sur le port 3000. 

```bash
docker run -d -p 3000:3000 --name express_dynamic res/dynamic_http_server
```

**Exemple :** 

![](img/dynamic_demo.png)


## Step 3: Reverse proxy with apache (static configuration)

Cette étape consiste à la création d'un reverse proxy où le but est d'avoir accès au serveur statique et au serveur dynamique via le reverse proxy. L'objectif par rapport aux deux étapes précédentes sera de ne pas utiliser de port mapping pour l'accès au container mais uniquement via le reverse proxy.

L'accès à l'étape 1 et 2 se fera via le lien labores.demo.ch qui a été configuré pour accèder à la partie : 

Statique via : labores.demo.ch:8080/

Dynamique via : labores.demo.ch:8080/api/people/

Le dossier **Reverse_Proxy** contient les fichiers nécessaires à cette partie. 

Le dossier **conf** contient la configuration nécessaire au proxy notamment avec le fichier 001-reverse-proxy.conf 

**Remarque :**  Les adresses IP sont hardcodées dans le fichier de configuration , il est donc necéssaire de vérifier qu'au lancement des containers, celle-ci correspondent aux fichiers de configuration. 



Un script est présent qui lance les containers dans l'ordre (à lancer dans le dossier docker_images)

> ./lauchReverseProxy_withAll.sh

Pour la démonstration il suffit de lancer ce script.

**Exemple :** 

![](img/reverse_demo.jpg)


## Step 4: AJAX requests with JQuery

Cette étape consiste à l'ajout d'un script js afin que dans la page html, une génération de données soient affichées toutes les 5 secondes. Nous avons affichement simplement nom, prénom , âge et adresse mail de  la personne générée.

Pour cela il a fallu modifier : 

Dans le dossier Static_HTTP_Server/src , le fichier index.html afin d'inclure le script js/people.js.

![](img/include_script.jpg)

Dans le dossier Static_HTTP_Server/src/js , réaliser le script people.js. 

**Exemple :** 

![](img/ajax_demo.jpg)

## Step 5: Dynamic reverse proxy configuration

Cette partie concerne le problème d'adresse IP hardcodé qui n'est pas viable dans un envirronnement de production. Nous voulons changer les adresses IP, sans modifier trop de configurations. Pour cela, nous allons utiliser un système de variable d'envirronnement qui lors du lancement du container nous permet d'indiquer clairement les adresses utiles.

Dans l'étape précédente, la configuration du reverse proxy était le fichier **001-reverse-proxy.conf**. Ici nous allons créer ce fichier de configuration à l'aide d'un script php. 

Ce fichier se trouve dans Revese_Proxy/template/config-template.php. Celui-ci va permettre de récupèrer les variables d'envirronement crée au moment du lancement du container. 



## Additional steps to get extra points on top of the "base" grade

### Load balancing: multiple server nodes (0.5pt)

* You extend the reverse proxy configuration to support **load balancing**. 
* You show that you can have **multiple static server nodes** and **multiple dynamic server nodes**. 
* You prove that the **load balancer** can distribute HTTP requests between these nodes.
* You have **documented** your configuration and your validation procedure in your report.

### Load balancing: round-robin vs sticky sessions (0.5 pt)

* You do a setup to demonstrate the notion of sticky session.
* You prove that your load balancer can distribute HTTP requests in a round-robin fashion to the dynamic server nodes (because there is no state).
* You prove that your load balancer can handle sticky sessions when forwarding HTTP requests to the static server nodes.
* You have documented your configuration and your validation procedure in your report.

### Dynamic cluster management (0.5 pt)

* You develop a solution, where the server nodes (static and dynamic) can appear or disappear at any time.
* You show that the load balancer is dynamically updated to reflect the state of the cluster.
* You describe your approach (are you implementing a discovery protocol based on UDP multicast? are you using a tool such as serf?)
* You have documented your configuration and your validation procedure in your report.

### Management UI (0.5 pt)

* You develop a web app (e.g. with express.js) that administrators can use to monitor and update your web infrastructure.
* You find a way to control your Docker environment (list containers, start/stop containers, etc.) from the web app. For instance, you use the Dockerode npm module (or another Docker client library, in any of the supported languages).
* You have documented your configuration and your validation procedure in your report.