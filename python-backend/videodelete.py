import os
import pika
import sys
import json
import logging
from pathlib import Path

encoding = 'utf-8'
def main():
    connection = pika.BlockingConnection(pika.ConnectionParameters('localhost'))
    channel = connection.channel()
    channel.exchange_declare(exchange="delayed_exchange",auto_delete=False,exchange_type="x-delayed-message", arguments={'x-delayed-type': 'direct'})
    channel.queue_declare(queue='timeoutQueue', durable=True)
    channel.queue_bind(exchange='delayed_exchange',queue='timeoutQueue',routing_key="timeout")
    def callback(ch, method, properties, body):
        try:
            var1=json.loads(str(body,encoding))
            var2=var1["originalName"]
            var3=var1["tempName"]
            path1=Path(__file__).parents[1]/"uploads"/"subtitledVideos"/str(var3)/str(var2)
            Path.unlink(path1)
            path2=Path(__file__).parents[1]/"uploads"/"subtitledVideos"/str(var3)
            Path.rmdir(path2)
        except:
            logging.exception("message")
    channel.basic_consume(queue='timeoutQueue', auto_ack=True, on_message_callback=callback)
    channel.start_consuming()

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('Interrupted')
        sys.exit(0)