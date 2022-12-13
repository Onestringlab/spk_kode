BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS tb_alternatif (
	id INT(6) AUTO_INCREMENT PRIMARY KEY,
	kode VARCHAR(30),
	alternatif VARCHAR(30),
	k1 INT(6),
	k2 INT(6),
	k3 INT(6),
	k4 INT(6),
	k5 INT(6)
);
CREATE TABLE IF NOT EXISTS tb_kriteria (
	id	INT(6) AUTO_INCREMENT PRIMARY KEY,
	kode	VARCHAR(30),
	kriteria	VARCHAR(30),
	atribut	VARCHAR(30),
	bobot	FLOAT,
	satuan	VARCHAR(30)
);
INSERT INTO tb_alternatif VALUES (1,'A1','Bigbos Store Profesional Curly ZF-2002',30,20,30,50,50);
INSERT INTO tb_alternatif VALUES (2,'A2','Sayota Curly HC 80',20,20,30,50,40);
INSERT INTO tb_alternatif VALUES (3,'A3','Wigo W-811 Curling Iron',30,50,40,50,30);
INSERT INTO tb_alternatif VALUES (4,'A4','Wand Interchangeable 3 Parts',40,50,30,40,50);
INSERT INTO tb_alternatif VALUES (5,'A5','Nova Curly Hair Profesional HC6808',40,50,30,40,30);
INSERT INTO tb_alternatif VALUES (6,'A6','Sonar Tourmalin SN-1071',50,50,30,40,30);
INSERT INTO tb_alternatif VALUES (7,'A7','Rui Zhi Tools Curling Iron',30,50,40,50,40);
INSERT INTO tb_kriteria VALUES (1,'K1','Bahan Pembuatan','benefit',2.2,'-');
INSERT INTO tb_kriteria VALUES (2,'K2','Pengaturan Suhu','benefit',2.1,'°C');
INSERT INTO tb_kriteria VALUES (3,'K3','Garansi','benefit',2.1,'Tahun/Bulan');
INSERT INTO tb_kriteria VALUES (4,'K4','Harga','cost',1.8,'Rp.');
INSERT INTO tb_kriteria VALUES (5,'K5','Ukuran','cost',1.8,'P x L x T');
COMMIT;
