SELECT ime,prezime,adresa,grad,vrsta_robe,marka,velicina,cena,pol,boja,datum_narucivanja
FROM Narudzbine
LEFT JOIN Kupci ON narudzbine.id_kupca=kupci.id
LEFT JOIN Grad ON kupci.id_grad=grad.id
LEFT JOIN Roba ON narudzbine.id_robe=roba.id
LEFT JOIN Vrsta_robe ON roba.id_vrsta_robe=vrsta_robe.id
LEFT JOIN Marka ON roba.id_marka=marka.id
LEFT JOIN Namena ON roba.id_namena=namena.id
LEFT JOIN Boja ON roba.id_boja=boja.id;