import socket
import sys

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

server_address = ('localhost', 12345)
sock.connect(server_address)

try:
    message = 'This is the message...'
    sock.sendall(message)
    data = sock.recv(100)
    print >>sys.stderr, 'received "%s"' % data

finally:
    sock.close()
