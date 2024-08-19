import whisper
from whisper.utils import get_writer
import os
import pika
import sys
import json
import logging
import mysql.connector
from pathlib import Path
from mysql.connector import errorcode


encoding = 'utf-8'
model = whisper.load_model("base")




HOST = "localhost"
USER = "root"
PASSWORD = ""

DB_NAME = "`robo-transcribe`"

TABLES = {
    "login-limiter": (
        "CREATE TABLE `login-limiter` ("
        "  `IP` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,"
        "  `count` tinyint(1) NOT NULL,"
        "  `timelog` int DEFAULT NULL,"
        "  PRIMARY KEY (`IP`)"
        ") ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci"
    ),
    "users": (
        "CREATE TABLE `users` ("
        "  `UserName` varchar(10) NOT NULL,"
        "  `Password` char(255) NOT NULL,"
        "  `Email` varchar(255) DEFAULT NULL,"
        "  PRIMARY KEY (`UserName`)"
        ") ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci"
    )
}

def create_database(cursor):
    try:
        cursor.execute(f"CREATE DATABASE {DB_NAME} DEFAULT CHARACTER SET 'utf8mb4'")
    except mysql.connector.Error as err:
        print(f"Failed creating database: {err}")
        exit(1)

def check_and_create_database(cursor):
    try:
        cursor.execute(f"USE {DB_NAME}")
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_BAD_DB_ERROR:
            print(f"Creating Database {DB_NAME}...")
            create_database(cursor)
            cursor.execute(f"USE {DB_NAME}")
        else:
            print(err)
            exit(1)

def check_and_create_tables(cursor):
    for table_name, table_definition in TABLES.items():
        try:
            cursor.execute(f"SHOW TABLES LIKE '{table_name}'")
            result = cursor.fetchone()
            if not result:
                print(f"Creating table {table_name}...")
                cursor.execute(table_definition)
        except mysql.connector.Error as err:
            print(f"Error creating table {table_name}: {err}")
            exit(1)
def main():
    cnx = mysql.connector.connect(user=USER, password=PASSWORD, host=HOST)
    cursor = cnx.cursor()

   
    check_and_create_database(cursor)

   
    check_and_create_tables(cursor)

   
    cursor.close()
    cnx.close()

    connection = pika.BlockingConnection(pika.ConnectionParameters('localhost'))
    channel = connection.channel()
    output_dir=Path(__file__).parents[1]/"uploads"/"subtitles"
    channel.queue_declare(queue='videoQueue', durable=True)
    channel.queue_declare(queue='subtitledVideos', durable=True)
    def callback(ch, method, properties, body):
        global model
        try:
            var1=json.loads(str(body,encoding))
            var2=str(var1["tempName"])
            var3=str(var1["originalName"])
            path1=Path(__file__).parents[1]/"uploads"/var2
            command2="ffmpeg -y -i "+str(path1)+".mp4 "+ "-q:a 0 -map a " +str(path1)+".mp3"
            os.system(command2)
            audio_path=str(path1)+".mp3"
            result = model.transcribe(audio_path,initial_prompt="prompt", word_timestamps=True)
            word_options = {
            "highlight_words": False,
            "max_line_count": 5,
            "max_line_width": 3
            }
            srt_writer = get_writer("srt", output_dir)
            srt_writer(result, audio_path, word_options)

            
            os.mkdir(Path(__file__).parents[1] /"uploads"/"subtitledVideos"/var2)
            path2=Path(__file__).parents[1]/"uploads"/"subtitledVideos"/var2/var2

            path3=Path(__file__).parents[1]/"uploads"/"subtitles"/var2
            
            path4=Path(__file__).parents[1]/"uploads"/"subtitledVideos"/var2/var3
            escaped_path = str(path3).replace('\\', r'\/').replace(':', r'\:')
            command3="ffmpeg -y -i "+str(path1)+".mp4 "+ "-vf "+ "\"subtitles='"+ str(escaped_path)+".srt"+":force_style=OutlineColour=&H80000000,BorderStyle=4,BackColour=&H80000000,Outline=0,Shadow=0,MarginV=25,Fontname=Arial,Fontsize=20,Alignment=2'\" "+str(path2)+".mp4"
            os.system(command3)
            del1=path1.parent/(path1.name+".mp4")
            del2=path3.parent/(path3.name+".srt")
            del3=path1.parent/(path1.name+".mp3")
            Path.unlink(del1)
            Path.unlink(del2)
            Path.unlink(del3)
            
            os.rename(str(path2)+".mp4",str(path4))
            successMsg=json.dumps({"tempName":var2,"originalName":var3})

            channel.basic_publish("","subtitledVideos", body=successMsg)
        except:
            logging.exception("message")

    channel.basic_consume(queue='videoQueue', auto_ack=True, on_message_callback=callback)
    channel.start_consuming()

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('Interrupted')
        sys.exit(0)