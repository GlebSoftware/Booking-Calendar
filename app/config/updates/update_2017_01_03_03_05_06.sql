
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'infoUpdateReservationTitle', 'backend', 'Infobox / Update reservation', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Update reservation', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateReservationDesc', 'backend', 'Infobox / Update reservation', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'You can make any changes to this reservation. Just click "Save" to update the booking details.', 'script');

COMMIT;