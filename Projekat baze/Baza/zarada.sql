SELECT SUM(cena) AS zarada,(SUM(cena)*0.4) AS cista_zarada 
FROM Narudzbine
LEFT JOIN Kupci ON narudzbine.id_kupca=kupci.id
LEFT JOIN Grad ON kupci.id_grad=grad.id
LEFT JOIN Roba ON narudzbine.id_robe=roba.id
LEFT JOIN Vrsta_robe ON roba.id_vrsta_robe=vrsta_robe.id
LEFT JOIN Marka ON roba.id_marka=marka.id
LEFT JOIN Namena ON roba.id_namena=namena.id
LEFT JOIN Boja ON roba.id_boja=boja.id;