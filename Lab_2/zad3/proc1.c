/*
 * This is sample code generated by rpcgen.
 * These are only templates and you can use them
 * as a guideline for developing your own functions.
 */

#include "app.h"


void
wiadomoscprog_1(char *host)
{
	CLIENT *clnt;
	void  *result_1;
	wejscie  konwertuj_1_arg;
	wyjscie  *result_2;
	char *odbierz_1_arg;

#ifndef	DEBUG
	clnt = clnt_create (host, WIADOMOSCPROG, WIADOMOSCVER, "udp");
	if (clnt == NULL) {
		clnt_pcreateerror (host);
		exit (1);
	}
#endif	/* DEBUG */
	printf("Podaj tekst:\n > ");
	scanf("%s", konwertuj_1_arg.wejscie);
	
	result_1 = konwertuj_1(&konwertuj_1_arg, clnt);
	if (result_1 == (void *) NULL) {
		clnt_perror (clnt, "call failed");
	}
#ifndef	DEBUG
	clnt_destroy (clnt);
#endif	 /* DEBUG */
}


int
main (int argc, char *argv[])
{
	char *host;

	wiadomoscprog_1 ("127.0.0.1");
exit (0);
}
