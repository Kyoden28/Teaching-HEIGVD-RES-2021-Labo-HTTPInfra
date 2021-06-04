FROM node:latest

LABEL maintainer="christian.gomes@heig-vd.ch"

RUN apt-get update && \
	apt-get install -y vim

COPY src /opt/app

EXPOSE 3000

CMD ["node", "/opt/app/index.js"]
