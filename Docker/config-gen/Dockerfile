FROM alpine:latest

COPY default.conf /scripts/default.conf
COPY template.conf /scripts/template.conf
COPY run.sh /scripts/run.sh

RUN chmod +x /scripts/run.sh

CMD ["/scripts/run.sh"]