DELETE FROM configuration_group WHERE configuration_group_title = 'Recover Cart Sales';
DELETE FROM configuration WHERE configuration_key LIKE 'RCS\_%';
DELETE FROM admin_pages WHERE page_key IN ('recover_cart_sales', 'stats_recover_cart_sales', 'config_recover_cart_sales');
DROP TABLE IF EXISTS scart;
