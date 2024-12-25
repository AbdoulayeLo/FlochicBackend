# Étape 1 : Utiliser l'image Node.js pour Angular
FROM node:20 AS build

# Définir le répertoire de travail
WORKDIR /usr/src/app

# Copier les fichiers Angular
COPY . .

# Installer les dépendances Angular
RUN npm install

# Construire l'application Angular
RUN npm run build --prod

# Étape 2 : Utiliser NGINX pour servir l'application Angular
FROM nginx:latest

# Copier les fichiers générés par Angular dans le répertoire de NGINX
COPY --from=build /usr/src/app/dist/flo-chic-frontend /usr/share/nginx/html

# Exposer le port 80 pour accéder à l'application
EXPOSE 80

# Lancer NGINX
CMD ["nginx", "-g", "daemon off;"]
