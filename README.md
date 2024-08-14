
# Robo-Translate

A website that automatically captions files using OpenAI's whisper.

# Features
Homepage, Login page, Signup, Video Uploader form, php user input validation, rabbitmq for cross application communication, python backend and more.


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

Install composer then in project directory:
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


Run both backend python files before using the site.


Start the webserver and visit the locally hosted site

The site is located at: localhost or http://videosubtitle/ 
