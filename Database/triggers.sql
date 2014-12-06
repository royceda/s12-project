DELIMITER |

CREATE TRIGGER decrement_qte BEFORE INSERT ON commande
BEGIN
	UPDATE disponibilite
 	SET quantite = quantite-1 WHERE nprod = NEW.nprod;		
END |

DELIMITER ;

