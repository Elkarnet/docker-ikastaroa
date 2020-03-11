docker run -d --name "lab-nginx" -p 8080:80 -v $(pwd):/usr/share/nginx/html:ro nginx:latest
