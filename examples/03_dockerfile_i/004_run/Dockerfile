FROM debian:latest

RUN apt-get update && apt-get -y install python3
RUN mkdir -p /app
RUN echo "#!/usr/bin/env python3" > /app/hello.py
RUN echo "print('Hello, World!')" >> /app/hello.py
RUN chmod +x /app/hello.py

CMD ["/app/hello.py"]