docker run -it --rm -p 8888:8080 tomcat:9.0


```
Note: as of docker-library/tomcat#181, the upstream-provided (example) webapps are not enabled by default, per upstream's security recommendations, but are still available under the webapps.dist folder within the image to make them easier to re-enable.
```
