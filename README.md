
# Robo-Transcribe

A website that automatically captions files using OpenAI's whisper.

# Features
Homepage, Login page, Login Rate Limiting, Signup, Video uploader form, PHP user input validation, Rabbitmq For Cross Application Communication, Python Backend and More.

Signup checks usernames for validity before forum submission and if the passwords match. Emails addresses and other inputs are validated in the backend as well.


# Video Demo

 [![YouTube](http://i.ytimg.com/vi/rbExqifFDAM/hqdefault.jpg)](https://youtu.be/rbExqifFDAM)
 
## Dependencies and Installation

Clone the project

```bash
  git clone https://link-to-project
```

Go to the project directory

Install WAMP or  Apache, MySQL and PHP separately

Download and Install FFMPEG

https://ffmpeg.org/download.html

Add ffmpeg to the path variable if on windows


Install the following Python libraries:


```bash
  pip install openai-whisper 
```


```bash
  pip install pika 
```


```bash
pip install mysql-connector-python
```

Install composer then run the following command in project directory:
```bash
composer require php-amqplib/php-amqplib
```
Download RabbitMQ [delayed messages](https://github.com/rabbitmq/rabbitmq-delayed-message-exchange/releases/latest) plugin .ez file

Navigate to rabbitmq plugin folder example: 
C:\Program Files\RabbitMQ Server\rabbitmq_server-3.13.5\plugins

Paste .ez file

```bash
rabbitmq-plugins enable rabbitmq_delayed_message_exchange
```


Paste github project files into folder marked: C:\wamp64\www\ or apache www folder


## Running
Run the backend python files before using the site. The files are in the python-backend folder

Start the webserver and visit the locally hosted site

The site is located at: localhost or http://videosubtitle/ 

