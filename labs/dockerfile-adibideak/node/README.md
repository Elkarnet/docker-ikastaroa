docker build -t bulletinboard:1.0 .

docker run -p 8000:8080 -d --name bb bulletinboard:1.0
