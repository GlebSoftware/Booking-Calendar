
START TRANSACTION;

ALTER TABLE `password` ADD COLUMN `calendar_id` int(10) unsigned NOT NULL AFTER `id`;
ALTER TABLE `password` ADD COLUMN `user_id` int(10) unsigned NOT NULL AFTER `calendar_id`;
ALTER TABLE `password` ADD COLUMN `format` enum('ical','xml', 'csv') NOT NULL DEFAULT 'ical' AFTER `user_id`;
ALTER TABLE `password` ADD COLUMN `type` enum('next','last') NOT NULL DEFAULT 'next' AFTER `password`;
ALTER TABLE `password` ADD COLUMN `period` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1' AFTER `password`;

COMMIT;