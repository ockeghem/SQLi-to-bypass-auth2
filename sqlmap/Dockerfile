FROM python:alpine3.18
WORKDIR /app
RUN apk add --no-cache bash git && \
    git clone --depth 1 https://github.com/sqlmapproject/sqlmap.git
WORKDIR /app/sqlmap
