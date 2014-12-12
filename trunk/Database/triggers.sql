DROP table error;


CREATE TABLE error(
       id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
       message VARCHAR(64))
       CHARSET=UTF8;
     

INSERT INTO error(id, message)
       values(1, 'error: Produit indisponible');

INSERT INTO error(id, message)
       values(2, 'error: Commande non confirm�');

INSERT INTO error(id, message)
       values(3, 'error: Impossible, prosuit non command�');


DROP TRIGGER IF EXISTS decrement_qte; 
-- T2: on commande donc on decremente la quantité dispo
DELIMITER //
CREATE TRIGGER decrement_qte BEFORE INSERT ON commande FOR EACH ROW
BEGIN
	UPDATE disponibilite
	SET quantite = quantite-1 WHERE nprod = NEW.nprod;		
END
//
DELIMITER; //



DELIMITER //
-- T1: On commmande que si le produit est dispo en taille et en quantite 
CREATE TRIGGER control_expedition BEFORE INSERT ON commande
FOR EACH ROW
BEGIN
	IF (select count(*)  from disponibilite where id=new.nprod and taille = new.taille and quantite > new.quantite > 0)
	THEN 
	     INSERT INTO commande( nprod, taille, quantite, nclient, confirme, date)
	     	    values(new.nprod, new.taille, new.quantite, new.nclient, new.confirme, new.date);
	ELSE
		INSERT INTO error(message) VALUES ('error: Produit indisponible');	
	END IF;

END
//
DELIMITER ;

DELIMITER //
-- T3: on expedit que si la commande est confirmer
CREATE TRIGGER control_avis BEFORE INSERT ON expedition
BEGIN
	IF (select confirme from commande where id=new.ncmd and confirme=1) IS NOT NULL
	THEN 
	     INSERT INTO expedition(id, addr, date, ncmd)
	     	    values(new.id, new.addr, new.date, new.ncmd);
	ELSE
		INSERT INTO error(message) VALUES ('error: Commande non confirm�');
	END IF;


END
//
DELIMITER ;

DELIMITER //
-- T4: un membre donne son avis que si il  a deja commander le produit
CREATE TRIGGER control_commande BEFORE INSERT ON avis
BEGIN
	IF (select * from commande where nprod=new.nprod and nclient=new.nclient) IS NOT NULL
	THEN 
	     INSERT INTO avis(nprod, nclient, note, comment)
	     	    values(new.nprod, new.nclient, new.note, new.comment);
	ELSE
		INSERT INTO error(message) VALUES('error: Impossible, prosuit non command�');
	END IF;
END
//
DELIMITER;


