SELECT id_vrsta_robe,vrsta_robe,marka,naziv_robe,namena,velicina,cena,pol,boja
FROM roba
LEFT JOIN Vrsta_robe ON roba.id_vrsta_robe=vrsta_robe.id
LEFT JOIN Marka ON roba.id_marka=marka.id
LEFT JOIN Namena ON roba.id_namena=namena.id
LEFT JOIN Boja ON roba.id_boja=boja.id;
