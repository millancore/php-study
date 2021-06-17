FROM httpd:2.4-alpine

ARG HTTPD_CONF=/usr/local/apache2/conf

COPY vhost.conf ${HTTPD_CONF}/vhost.conf
RUN echo "Include ${HTTPD_CONF}/vhost.conf" >> ${HTTPD_CONF}/httpd.conf