from flask import Flask 
from flask_socketio import SocketIO, send
import numpy as np
import cv2
import base64
import simplejson
import time

cap = cv2.VideoCapture(0)
cap.set(3, 640)
cap.set(4, 480)

app = Flask(__name__)
app.config['SECRET_KEY'] = 'mysecret'
socketio = SocketIO(app)

@socketio.on('image')
def image(msg):
	rect, frame = cap.read()
	newFrame = rescale_frame(frame, percent=20)
	cnt = cv2.imencode('.png',newFrame)[1]
	encoded_string = base64.b64encode(cnt)
	send(simplejson.dumps({'data': encoded_string}), broadcast=True)

def rescale_frame(frame, percent):
    scale_percent = percent
    width = int(frame.shape[1] * scale_percent / 100)
    height = int(frame.shape[0] * scale_percent / 100)
    dim = (width, height)
    return cv2.resize(frame, dim, interpolation = cv2.INTER_AREA)
	
if __name__ == '__main__':
    socketio.run(app, host = '0.0.0.0', port=5005)