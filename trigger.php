<?php

$sql =
/* 
DELEIMER $$ => this line chnage the eding of the query from ; to $$
DROP TRIGGER `delete_personne`$$ => deop trigeer if it exists
CREATE TRIGGER `delete_personne` BEFORE DELETE on `personne` => create trigeer  give it name and it will
trigger before delete on table which its name is `personne`
FOR EACH ROW => for each row :)
BEGIN END$ => between the two words you put your trigger body
OLD => this is the row that has been deleted and you can take its information put you can not update it
DELIMITER ; => chnage the delimeter to ; again
*/ 
"DELIMITER $$

DROP TRIGGER `delete_personne`$$

CREATE TRIGGER `delete_personne` BEFORE DELETE on `personne`
FOR EACH ROW
BEGIN
    INSERT INTO histo_personne SELECT OLD.initialespers,OLD.nompers,OLD.prenompers,OLD.datenaisspers,OLD.photopers,OLD.validepers,now();
END$$

DELIMITER ;
";

?>