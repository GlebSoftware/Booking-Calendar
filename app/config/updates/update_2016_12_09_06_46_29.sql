
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'btnAddCalendar', 'backend', 'Button / + Add calendar', 'script', '2016-12-09 06:23:06');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', '+ Add calendar', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnAddUser', 'backend', 'Button / + Add user', 'script', '2016-12-09 06:25:57');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', '+ Add user', 'script');

COMMIT;