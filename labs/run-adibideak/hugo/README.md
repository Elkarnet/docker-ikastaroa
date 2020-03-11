

Zerbitzaria martxan jartzeko:

```
docker run -p 8888:1313 -v $(pwd)/quickstart:/site xezpeleta/hugo server -D --bind 0.0.0.0
```

Sortu eduki estatikoa:

```
docker run -v $(pwd)/quickstart:/site xezpeleta/hugo -D
```

`quickstart/public` direktorioan utziko digu edukia


Webgune berri bat sortu nahiko bagenu ("quickstart" direktorioa horrela sortu dugu):

```
docker run -it --rm -v $(pwd):/site xezpeleta/hugo new site quickstart
```



