#!/bin/bash
openssl s_client -showcerts -connect $1:$2 </dev/null | openssl x509 -outform DER > out.cer

