#!C:\Users\stagiaireafpa\AppData\Local\Programs\Python\Python38-32\python.exe
from waptpackage import PackageEntry,WaptLocalRepo
from waptcrypto import SSLCABundle,SSLPrivateKey,SSLCertificate
import sys
arg=""
if len(sys.argv)>2:
    for i in sys.argv:
        if not i==sys.argv[0]:
            arg=arg+i+" "
    arg=arg.split("add")
    option=arg[1].split("remove")
    uuid_machine=arg[0]
    adddepend=option[0].split(" ")
    removedepend=option[1].split(" ")
    adddepend.remove("")
    removedepend.remove("")
    adddepend.remove("")
    removedepend.remove("")
    if len(removedepend)<=0:
        print("Pas de suppr")
    if len(adddepend)<=0:
        print("Pas d'ajout")

	#Configuration
	certpub="/root/mykey.crt"
	privatekey="/root/mykey.pem"
	passwordkey='password'

	#definition de variable pour la clé privé
	ca_bundle = SSLCABundle()
	signers_bundle = SSLCABundle()
	signers_bundle.add_certificates_from_pem(pem_filename=certpub)
	key = SSLPrivateKey(privatekey)
	#selection de l'ordinateur à modifier
	pe = PackageEntry(waptfile = "/var/www/html/wapt-host/%s.wapt" % uuid_machine)

	depends = pe.depends.split(',')
	if not len(adddepend)<=0:
		for dep in adddepend:
		    if not dep in depends:
		        depends.append(dep)

	if not len(removedepend)<=0:
		for dep in removedepend:
		    if dep in depends:
		        depends.remove(dep)

	pe.depends = ','.join(depends)
	pe.inc_build()
	pe.sign_package(private_key=key,certificate = signers_bundle.certificates(),private_key_password=passwordkey)
    print("Modification réussite")
else:
    print("Erreur pas assez d'arguments ont été saisis")