FROM node:14-slim

WORKDIR /var/www/html/frontend

ENV PATH /var/www/html/frontend/node_modules/.bin:$PATH
COPY package*.json ./

RUN npm install

COPY . .

EXPOSE 3000

CMD [ "npm", "start" ]