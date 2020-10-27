SELECT ime,prezime,adresa,grad,telefon,email 
FROM kupci
LEFT JOIN grad ON kupci.id_grad=grad.id;