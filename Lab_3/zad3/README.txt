proc3.sh - uruchamia serwer (proc3.php) zabijajac przy tym procesy, ktore blokuja porty
proc2.php - uruchomic jako drugi (dziala w sposob ciagly)
proc1.php - uruchomic jako ostatni (dziala w sposob ciagly)

proc1 -> proc2 - udp
proc2 -> proc3 - xml-rpc
