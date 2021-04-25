/****
	Przyklad pliku RPCGEN
	Obliczanie sumy, roznicy i iloczynu dwoch liczb calkowitych
****/

/*************************************
	Wywolanie procedury odleglej dopuszcza tylko jeden
	argument wywolania i jeden zwracany wynik.
	Oba musza byc podane w formie wskaznikow

	Dlatego nalezy definiowac odpowiednie struktury
*************************************/
struct wejscie {
	char wejscie[512];
};
struct wyjscie {
	char wyjscie[512];
};
/* definicja programu i jego wersji */

program WIADOMOSCPROG {
	version WIADOMOSCVER{
			/* definicja procedury nr 1 */
	void KONWERTUJ(wejscie) = 1;
	wyjscie ODBIERZ() = 2;
	} = 1;		/* nr wersji */	
} = 0x21000000;		/* nr programu */	
	
