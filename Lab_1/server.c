#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>        // inet_ntoa
#include <time.h>            // time

//======================================================================
int error(int ern, const char *msg) {
    perror(msg);
    return ern;
}

//======================================================================
int main(void) {

    /* zmienne predefiniowane *****************************************/
    int port = 12345;

    /* zmienne niezainicjowane ****************************************/
    int n;
    int fd, newfd;
    char buffer[256], filename_buffer[64], hex[256];
    socklen_t socklen;
    FILE *f;

    struct sockaddr_in serv_addr, cli_addr;

    /* tworzymy gniazdo ***********************************************/
    fd = socket(AF_INET, SOCK_DGRAM, 0);        // tworzymy nowe gniazdo
    if (fd < 0)
        return error(1, "socket()");

    /* zapelniamy strukture zerami (inicjujemy) ***********************/
    bzero((char *) &serv_addr, sizeof(serv_addr));    // zapelniamy strukture zerami


    /* przypisujemy parametry *****************************************/
    serv_addr.sin_family = AF_INET;            // typ gniazda
    serv_addr.sin_addr.s_addr = INADDR_ANY;        // oczekujemy polaczen na kazdym adresie
    serv_addr.sin_port = htons(port);        // port, na ktorym nasluchujemy

    /* mapujemy gniazdo ***********************************************/
    if (bind(fd, (struct sockaddr *) &serv_addr, sizeof(serv_addr)) < 0)
        return error(2, "bind()");

    /* rozpoczynamy nasluchiwanie na gniezdzie ************************/
//    listen(fd, 5);

    /* kod obslugujacy nowe polaczenia ********************************/
    socklen = sizeof(cli_addr);
    printf("Start serwera\n");
    for (;;) {
        switch (fork()) {
            case 0:
                bzero(buffer, 256);
                bzero(filename_buffer, 64);
                /* odczytujemy wiadomosc ******************************************/
                n = recvfrom(fd, buffer, 255, MSG_WAITALL, (struct sockaddr *) &cli_addr, &socklen);
                if (n < 0)
                    return error(4, "Blad odczytania wiadomosci");

                snprintf(filename_buffer, sizeof(char) * 64, "%i.txt", getpid());

                /* konwersja na hexa */
                int j = 0;
                int i = 0;
                while (buffer[j] != '\0') {
                    sprintf((char *) (hex + i), "%02X", buffer[j]);
                    j += 1;
                    i += 2;
                }
                hex[i++] = '\0';

                /* wypisujemy wiadomosc do pliku */
                f = fopen(filename_buffer, "w");
                fprintf(f, "%s", hex);
                printf("%s >> %s\n", hex, filename_buffer);
                /* konczymy polaczenie i zamykamy plik ******/
                fclose(f);
                exit(0);
            case -1:
                printf("Blad funkcji fork\n");
                exit(1);
            default:
                wait(NULL); // czekamy na zakonczenie procesu
        }
    }
}