import whisper
from whisper.utils import get_writer
import os
import pika
import sys
import json
import logging

encoding = 'utf-8'
model = whisper.load_model("base")
def main():
    connection = pika.BlockingConnection(pika.ConnectionParameters('localhost'))
    channel = connection.channel()
    output_dir=r"C:\wamp64\www\videoUpload\uploads\subtitles"
    channel.queue_declare(queue='videoQueue', durable=True)
    channel.queue_declare(queue='subtitledVideos', durable=True)
    def callback(ch, method, properties, body):
        global model
        try:
            var1=json.loads(str(body,encoding))
            var2=str(var1["tempName"])
            var3=str(var1["originalName"])
            path1=os.path.join("C:\\wamp64\\www\\videoUpload\\uploads",var2)
            command2="ffmpeg -y -i "+path1+".mp4 "+ "-q:a 0 -map a " +path1+".mp3"
            os.system(command2)
            audio_path=path1+".mp3"
            result = model.transcribe(audio_path,initial_prompt="prompt", word_timestamps=True)
            word_options = {
            "highlight_words": False,
            "max_line_count": 50,
            "max_line_width": 3
            }
            srt_writer = get_writer("srt", output_dir)
            srt_writer(result, audio_path, word_options)
            os.mkdir(r"C:\wamp64\www\videoUpload\uploads\subtitledVideos\\"+var2)
            path2=os.path.join("C:\\wamp64\\www\\videoUpload\\uploads\\subtitledVideos\\"+var2,var2)
            path3=os.path.join("C:\\wamp64\\www\\videoUpload\\uploads\\subtitles",var2)
            path4=os.path.join("C:\\wamp64\\www\\videoUpload\\uploads\\subtitledVideos\\"+var2,var3)
            command3="ffmpeg -y -i "+path1+".mp4 "+ "-vf "+ "\"subtitles='"+ "C\:\/wamp64\/www\/videoUpload\/uploads\/subtitles\/"+var2+".srt"+":force_style=OutlineColour=&H80000000,BorderStyle=4,BackColour=&H80000000,Outline=0,Shadow=0,MarginV=25,Fontname=Arial,Fontsize=20,Alignment=2'\" "+path2+".mp4"
            os.system(command3)
            command4="del "+path1+".mp4 "+path3+".srt "+path1+".mp3"
            os.system(command4)
            os.rename(path2+".mp4",path4)
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