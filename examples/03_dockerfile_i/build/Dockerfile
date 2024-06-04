# container usage:
#   docker build -t aplusb .
#   docker run -it --name=aplusb aplusb
FROM debian

# install g++ compiler
RUN apt-get update && apt-get install -y g++

# copy source code
COPY sample.cpp /sample.cpp

# compile source code
RUN g++ -o /sample /sample.cpp

# run the program
CMD "/sample"