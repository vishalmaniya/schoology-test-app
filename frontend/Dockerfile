FROM node:14-slim

WORKDIR /var/www/frontend

ENV PATH /var/www/frontend/node_modules/.bin:$PATH
COPY package*.json ./

RUN npm install

COPY .. .

EXPOSE 3000
