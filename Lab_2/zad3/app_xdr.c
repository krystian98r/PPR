/*
 * Please do not edit this file.
 * It was generated using rpcgen.
 */

#include "app.h"

bool_t
xdr_wejscie (XDR *xdrs, wejscie *objp)
{
	register int32_t *buf;

	int i;
	 if (!xdr_vector (xdrs, (char *)objp->wejscie, 512,
		sizeof (char), (xdrproc_t) xdr_char))
		 return FALSE;
	return TRUE;
}

bool_t
xdr_wyjscie (XDR *xdrs, wyjscie *objp)
{
	register int32_t *buf;

	int i;
	 if (!xdr_vector (xdrs, (char *)objp->wyjscie, 512,
		sizeof (char), (xdrproc_t) xdr_char))
		 return FALSE;
	return TRUE;
}
