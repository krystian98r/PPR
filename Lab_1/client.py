import socket

sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
server_address = ('localhost', 12345)

try:
    message = raw_input('> ')
    sock.sendto(message, server_address)
finally:
    sock.close()
