DROP table error;


CREATE TABLE error(
       id      INTEGER     PRIMARY KEY NOT NULL AUTO_INCREMENT,
       message VARCHAR(64) UNIQUE)
       CHARSET=UTF8;
     

INSERT INTO error(id, message)
       values(1, 'error: Produit indisponible');

INSERT INTO error(id, message)
       values(2, 'error: Commande non confirmé');

INSERT INTO error(id, message)
       values(3, 'error: Impossible, produit non commandé');


DROP TRIGGER IF EXISTS decrement_qte;
-- T2: on commande donc on decremente la quantitÃ© dispo

DELIMITER //
CREATE TRIGGER decrement_qte BEFORE INSERT ON commande FOR EACH ROW
BEGIN
	UPDATE disponibilite
	SET quantite = quantite-1 WHERE nprod = NEW.nprod;		
END;
//  
DELIMITER ; 


DROP TRIGGER IF EXISTS control_expedition;
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
