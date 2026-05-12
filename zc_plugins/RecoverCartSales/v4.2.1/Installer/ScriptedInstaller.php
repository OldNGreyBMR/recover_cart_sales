<?php
// -----
// Part of the "Recover Cart Sales" plugin by OldNGrey
// Copyright (C) 2026, Zen Cart
// Last updated: v4.2.0
//
use Zencart\PluginSupport\ScriptedInstaller as ScriptedInstallBase;

class ScriptedInstaller extends ScriptedInstallBase
{
    protected string $configGroupTitle = 'Recover Cart Sales';
    public const RECOVER_CART_SALES_CURRENT_VERSION = '4.2.1';
    protected int $configurationGroupId;    
    /**
    * @return bool
    */
    public function executeInstall() : void
    {
        global $db, $sniffer;
        
        if (!$this->purgeOldFiles()) {
            return ;
        }
        // -----
        // First, determine the main options' configuration-group-id and
        // install the main options.
        //
       /*$cgi = $this->installConfigGroup(
            'Recover Cart Sales',
            'The main options for the Recover Cart Sales module are stored here.'
        );
*/
        if (! defined('TABLE_SCART')) define('TABLE_SCART', DB_PREFIX . 'scart');
        if (!$sniffer->table_exists(TABLE_SCART)) {
        
        $sql = "CREATE TABLE IF NOT EXISTS " . TABLE_SCART . " (
            CREATE TABLE `" . TABLE_SCART . "` (
                scartid int(11) NOT NULL auto_increment,
                customers_id int(11) NOT NULL default '0',
                dateadded varchar(8) NOT NULL default '',
                datemodified varchar(8) NOT NULL default '',
                PRIMARY KEY  (scartid),
                UNIQUE KEY customers_id (customers_id),
                UNIQUE KEY scartid (scartid)
            ) ENGINE=MyISAM DEFAULT ";
        $this->executeInstallerSql($sql);
        }

        if (!defined('RCS_BASE_DAYS')) {
            $result = $db->Execute("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title= 'Recover Cart Sales' LIMIT 1");
            if ($result->RecordCount() && $result->fields['configuration_group_id'] > 0) {
                $db->Execute("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_group_id = " . (int) $result->fields['configuration_group_id']);
                $db->Execute("DELETE FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_id = " . (int) $result->fields['configuration_group_id']);
            }
    
            $sql = "INSERT INTO " . TABLE_CONFIGURATION_GROUP . " 
                (configuration_group_title, configuration_group_description, sort_order, visible) 
                VALUES 
                    ('Recover Cart Sales', 'Recover Cart Sales (RCS) Configuration Values', '1', '1')
                    ";
            $result = $db->Execute($sql);
            $cgroup_id = $db->insert_ID();

            $db->Execute("UPDATE " . TABLE_CONFIGURATION_GROUP . " SET sort_order = " . $cgroup_id . " WHERE configuration_group_id = " . $cgroup_id);
            $table_config = TABLE_CONFIGURATION;
            
            $this->executeInstallerSql(
                "INSERT IGNORE INTO " . TABLE_CONFIGURATION . "
                    (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) 
                        VALUES 
                            ('Look back days', 'RCS_BASE_DAYS', '30', 'Number of days to look back from today for abandoned cards.',  $this->configurationGroupId, 10, NULL, NOW(), NULL, NULL),
                            ('Sales Results Report days', 'RCS_REPORT_DAYS', '90', 'Number of days the sales results report takes into account. The more days the longer the SQL queries!.', 
                                $this->configurationGroupId, 15, NULL, NOW(), NULL, NULL),
                            ('Contacted History Limit', 'RCS_EMAIL_TTL', '90', 'Number of days to give for Contacted emails before they no longer show as being sent',  $this->configurationGroupId, 20, NULL, NOW(), NULL, NULL),
                    ('Personalized E-Mails', 'RCS_EMAIL_FRIENDLY', 'true', 'If <b>true</b> then the customer name will be used in the greeting. If <b>false</b> then a generic greeting will be used.', 
                        $this->configurationGroupId, 30, NULL, NOW(), NULL, zen_cfg_select_option(array('true', 'false')),'),
                    ('Show Attributes', 'RCS_SHOW_ATTRIBUTES', 'true', 'Controls display of item attributes.<br><br>Some sites have attributes for their items.<br><br>Set this to <b>true</b> 
                        if yours does and you      want    to show them, otherwise set to <b>false</b>.',  $this->configurationGroupId, 40, NULL, NOW(), NULL, zen_cfg_select_option(array('true', 'false')),'),
                    ('Ignore Customers with Sessions', 'RCS_CHECK_SESSIONS', 'false', 'If you want the tool to ignore customers with an active session (ie, probably still shopping) set this to 
                        <b>true</b>.<br><br>Setting this to <b>false</b> will operate in the default manner of ignoring session data &amp; using less resources', $this->configurationGroupId, 40, NULL, NOW(), NULL, 
                        zen_cfg_select_option(array('true', 'false')),',
                    ('Current Customer Color', 'RCS_CURCUST_COLOR', '0000FF', 'Color for the word/phrase used to notate a current customer<br><br>A current customer is someone who has purchased items 
                        from your store in the past.', $this->configurationGroupId, 50, NULL, NOW(), NULL, NULL),
                    ('Uncontacted Highlight Color', 'RCS_UNCONTACTED_COLOR', '80FFFF', 'Row highlight color for uncontacted customers.<br><br>An uncontacted customer is one that you have <i>not</i> 
                        used this tool to send an email to before.', $this->configurationGroupId, 60, NULL, NOW(), NULL, NULL),
                    ('Contacted Highlight Color', 'RCS_CONTACTED_COLOR', 'FF9FA2', 'Row highlight color for contacted customers.<br><br>An contacted customer is one that you <i>have</i> used this 
                        tool to send an email to before.', $this->configurationGroupId, 70, NULL, NOW(), NULL, NULL),
                    ('Matching Order Highlight', 'RCS_MATCHED_ORDER_COLOR', '9FFF22', 'Row highlight color for entrees that may have a matching order.<br><br>An entry will be marked with this color 
                        if an order contains one or more of an item in the abandoned cart <b>and</b> matches either the carts customer email address or database ID.', $this->configurationGroupId, 72, NULL, NOW(), NULL, NULL),
                    ('Skip Carts w/Matched Orders', 'RCS_SKIP_MATCHED_CARTS', 'true', 'To ignore carts with an a matching order set this to <b>true</b>.<br><br>Setting this to <b>false</b> will cause 
                        entries with a matching order to show, along with the matching order status.<br><br>See documentation for details.', $this->configurationGroupId, 80, NULL, NOW(), NULL, 
                            zen_cfg_select_option(array('true', 'false')),'),
                    ('Lowest Pending sales status', 'RCS_PENDING_SALE_STATUS', '1', 'The highest Order-Status value that an order can have and still be considered pending. Any value higher than this 
                        will be considered by RCS as sale which completed.<br><br>(Assumes order-status values are numerically sequential to match fulfillment processes. RCS is only aware of the status-id-number.) See documentation for details.', $this->configurationGroupId, 85, NULL, NOW(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses('),
                    ('Report Even Row CSS Style', 'RCS_REPORT_EVEN_STYLE', 'dataTableRow', 'Style for even rows in results report. Typical options are <i>dataTableRow</i> and <i>attributes-even</i>.',
                        $this->configurationGroupId, 90, NULL, NOW(), NULL, NULL),
                    ('Report Odd Row CSS Style', 'RCS_REPORT_ODD_STYLE', '', 'Style for odd rows in results report. Typical options are NULL (ie, no entry) and <i>attributes-odd</i>.', 
                        $this->configurationGroupId, 92, NULL, NOW(), NULL, NULL),
                    ('E-Mail Copies to', 'RCS_EMAIL_COPIES_TO', '', 'If you want copies of emails that are sent to customers by RCS, enter the email address here. If empty no copies are sent', 
                        $this->configurationGroupId, 35, NULL, NOW(), NULL, NULL),
                    ('Auto pre-check safe carts to email', 'RCS_AUTO_CHECK', 'true', 'To pre-check the checkboxes for entries which are most likely safe to email (ie, not existing customers, 
                        not previously emailed, etc.) set this to <b>true</b>.<br><br>Setting this to <b>false</b> will leave all entries unchecked (you will have to check each entry you want to 
                        send an email for).', $this->configurationGroupId, 82, NULL, NOW(), NULL, zen_cfg_select_option(array('true', 'false')),'),
                    ('Match orders from any date', 'RCS_CARTS_MATCH_ALL_DATES', 'true', 'If <b>true</b> then any order found with a matching item will be considered a matched order.<br><br>
                        If <b>false</b> only orders placed after the abandoned cart are considered.', $this->configurationGroupId, 84, NULL, NOW(), NULL, zen_cfg_select_option(array('true', 'false')),
           "
         );
    
        }

        // Register admin page
        if (function_exists('zen_register_admin_page')) {
            if (! zen_page_key_exists('config_recover_cart_sales')) {
                zen_register_admin_page('recover_cart_sales', 'BOX_TOOLS_RECOVER_CART', 'FILENAME_RECOVER_CART_SALES', '', 'customers', 'Y', 200);
                zen_register_admin_page('stats_recover_cart_sales', 'BOX_REPORTS_RECOVER_CART_SALES', 'FILENAME_STATS_RECOVER_CART_SALES', '', 'reports', 'Y', 200);
                zen_register_admin_page('config_recover_cart_sales', 'BOX_CONFIG_RECOVER_CART_SALES', 'FILENAME_CONFIGURATION', 'gID=' . $this->configurationGroupId, 'configuration', 'Y', 77);
        }

          // -----
        // Updating/removing various configuration descriptions and/or values if
        // installing the encapsulated version over a previously-installed
        // non-encapsulated one.
        //
        $this->executeInstallerSql(
            "UPDATE " . TABLE_CONFIGURATION . "
                SET last_modified = now(),
                    configuration_value = '" . self::RECOVER_CART_SALES_CURRENT_VERSION . "'
              WHERE configuration_key = 'RECOVER_CART_SALES_VERSION'
              LIMIT 1"
        );
        }
        function executeUninstall()
        {
        zen_deregister_admin_pages(['recover_cart_sales', 'stats_recover_cart_sales', 'config_recover_cart_sales']);

       /*
        $sql = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE 'RCS\_%'";
        $this->executeInstallerSql($sql);

        $deleteMap = "'Printable Price-list', 'Price-list Profile-1', 'Price-list Profile-2', 'Price-list Profile-3'";
        $sql = "DELETE FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title = 'Recover Cart Sales'";
        $this->executeInstallerSql($sql);
        */
    }
        
   /*
     function executeInstallerSelectSql(string $sql)
    {
        $this->dbConn->dieOnErrors = false;
        $result = $this->dbConn->Execute($sql);
        if ($this->dbConn->error_number !== 0) {
            $this->errorContainer->addError(0, $this->dbConn->error_text, true, PLUGIN_INSTALL_SQL_FAILURE);
            return false;
        }
        $this->dbConn->dieOnErrors = true;
        return $result;
    } */
    /*
     function installConfigGroup(string $config_group_title, string $config_group_description): int
    {
        $sql =
            "INSERT IGNORE INTO " . TABLE_CONFIGURATION_GROUP . "
                (configuration_group_title, configuration_group_description, sort_order, visible)
             VALUES
                ('$config_group_title', '$config_group_description', 1, 1)";
        $this->executeInstallerSql($sql);
        $sql = "SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title = '$config_group_title' LIMIT 1";
        $config_group = $this->executeInstallerSelectSql($sql);
        $cgi = $config_group->fields['configuration_group_id']; 
        $sql = "UPDATE " . TABLE_CONFIGURATION_GROUP . " SET sort_order = $cgi WHERE configuration_group_id = $cgi LIMIT 1";
        $this->executeInstallerSql($sql);
        return
    }
        */
    }
    /**
     * Purge old files
     */
    protected function purgeOldFiles(): bool
    {
        $filesToDelete = [
            DIR_FS_ADMIN . 'includes/languages/english/extra_definitions/lang.recover_cart_sales.php',
            DIR_FS_ADMIN . 'includes/languages/english/extra_definitions/recover_cart.php',
            DIR_FS_ADMIN . 'includes/languages/english/stats_recover_cart_sales.php',
            DIR_FS_ADMIN . 'includes/languages/english/lang.stats_recover_cart_sales.php',
            DIR_FS_ADMIN . 'includes/languages/english/recover_cart_sales.php',
            DIR_FS_ADMIN . 'includes/languages/english/lang.recover_cart_sales.php',
            DIR_FS_ADMIN . 'includes/functions/install_rcs.php',
            DIR_FS_ADMIN . 'includes/extra_datafiles/recover_cart_filenames.php',
            DIR_FS_ADMIN . 'stats_recover_cart_sales.php',
            DIR_FS_ADMIN . 'recover_cart_sales.php',
            DIR_FS_CATALOG . 'email\email_template_recover_cart_sales.html'
            ,
        ];

        foreach ($filesToDelete as $file) {
            if (file_exists($file)) {
                if (!unlink($file)) {
                    error_log('Failed to delete file: ' . $file);
                    return false;
                }
            }
        }
        return true;
    }
}
