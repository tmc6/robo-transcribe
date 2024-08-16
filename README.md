
# Robo-Transcribe

A website that automatically captions files using OpenAI's whisper.

# Features
Homepage, Login page, Signup, Video uploader form, PHP user input validation, Rabbitmq For Cross Application Communication, Python Backend and More.

Signup checks usernames for validity before forum submission and if the passwords match. Emails addresses and other inputs are validated in the backend as well.

![available username](/screenshot/signup1.png?raw=true "Available Username")

![unavailable username](/screenshot/signup2.png?raw=true "Unavailable Username")

# Video Demo

 [![YouTube](http://i.ytimg.com/vi/_Vre2jyVPTU/hqdefault.jpg)](https://www.youtube.com/watch?v=_Vre2jyVPTU)
 
## Dependencies and Installation

Clone the project

```bash
  git clone https://link-to-project
```

Go to the project directory

Install WAMP or  Apache, MySQL and PHP separately

```bash
  pip install openai-whisper 
```


```bash
  pip install pika 
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
Run the backend python files before using the site.

Start the webserver and visit the locally hosted site

The site is located at: localhost or http://videosubtitle/ 

