from pathlib import Path
import os

escaped_path = str(path3).replace(':', r'\:').replace('\\', r'\/')
command3="ffmpeg -y -i "+str(path1)+".mp4 "+ "-vf "+ "\"subtitles='"+ str(escaped_path)+".srt"+":force_style=OutlineColour=&H80000000,BorderStyle=4,BackColour=&H80000000,Outline=0,Shadow=0,MarginV=25,Fontname=Arial,Fontsize=20,Alignment=2'\" "+str(path2)+".mp4"
