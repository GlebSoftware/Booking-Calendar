
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblPeriod', 'backend', 'Label / Period', 'script', '2016-12-09 08:31:54');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '::LOCALE::', 'title', 'Period', 'script');

COMMIT;