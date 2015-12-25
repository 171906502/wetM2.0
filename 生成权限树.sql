INSERT INTO auth_item (
	SELECT
		menu.`name`,
		'2',
		menu.`name`,
		NULL,
		NULL,
		'1448421208',
		'1448421208'
	FROM
		menu
	WHERE
		menu.`name` NOT IN (
			SELECT
				auth_item.`name`
			FROM
				auth_item
		)
);

INSERT INTO auth_item (
	SELECT
		`group`.`name`,
		'2',
		`group`.`name`,
		NULL,
		NULL,
		'1448421208',
		'1448421208'
	FROM
		`group`
	WHERE
		`group`.`name` NOT IN (
			SELECT
				auth_item.`name`
			FROM
				auth_item
		)
);


INSERT INTO auth_item_child(
SELECT
	p1.`name`,
	`group`.`name`
FROM
	`group`
LEFT JOIN `group` p1 ON `group`.pid = p1.id
WHERE
	p1.`name` IS NOT NULL);


INSERT INTO auth_item_child(
SELECT `group`.`name`, menu.`name` FROM menu LEFT JOIN `group` on menu.group_id=`group`.id
);

