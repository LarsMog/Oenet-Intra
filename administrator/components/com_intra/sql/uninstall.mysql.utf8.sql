DROP TABLE IF EXISTS `#__intra_departments`;
DROP TABLE IF EXISTS `#__intra_groups`;
DROP TABLE IF EXISTS `#__intra_polls`;
DROP TABLE IF EXISTS `#__intra_polls_answers`;

DELETE FROM `#__content_types` WHERE (type_alias LIKE 'com_intra.%');