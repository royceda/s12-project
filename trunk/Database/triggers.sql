CREATE TABLE error(
       id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
       message VARCHAR(64))
       CHARSET=UTF8;
     

INSERT INTO error(id, message)
       values(1, 'Produit indisponible');

INSERT INTO error(id, message)
       values(2, 'error: Commande non confirmé');

INSERT INTO error(id, message)
       values(3, 'impossible, prosuit non commandé');



-- T2: on commande donc on decremente la quantitÃ© dispo
DELIMITER //
CREATE TRIGGER decrement_qte BEFORE INSERT ON commande 
BEGIN
	UPDATE disponibilite
	SET quantite = quantite-1 WHERE nprod = NEW.nprod;		
END //


-- T1: On commmande que si le produit est dispo en taille et en quantite 
CREATE TRIGGER control_expedition BEFORE INSERT ON commande
for each row
BEGIN

	IF (select nprod  from disponibilite where id=new.nprod and taille = new.taille and quantite > new.quantite) != NULL
	THEN 
	     INSERT INTO commande( nprod, taille, quantite, nclient, confirme, date)
	     	    values(new.nprod, new.taille, new.quantite, new.nclient, new.confirme, new.date);
	ELSE
		select message from error where id=1;
	END IF;

END //


-- T3: on expedit que si la commande est confirmer
CREATE TRIGGER control_avis BEFORE INSERT ON expedition
BEGIN

	IF (select confirme from commande where id=new.ncmd) = 1
	THEN 
	     INSERT INTO expedition(id, addr, date, ncmd)
	     	    values(new.id, new.addr, new.date, new.ncmd);
	ELSE
		select message from error where id=2;
	END IF;


END //



-- T4: un membre donne son avis que si il  a deja commander le produit
CREATE TRIGGER control_commande BEFORE INSERT ON avis
BEGIN
	IF (select * from commande where nprod=new.nprod and nclient=new.nclient) NOT NULL
	THEN 
	     INSERT INTO avis(nprod, nclient, note, comment)
	     	    values(new.nprod, new.nclient, new.note, new.comment);
	ELSE
		select message from error where id=2;
	END IF;
END //
DELIMITER;



