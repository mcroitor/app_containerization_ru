# create image with source code
FROM scratch AS sourcecode

COPY files/site /site

# build image
FROM php:8.1-cli AS build

COPY --from=sourcecode /site /site

VOLUME ["/database"]

# RUN php /site/install/index.php

# release image
FROM php:8.1 AS release

COPY --from=build  /site /site

VOLUME ["/database"]

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/site"]
