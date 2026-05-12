Recover Cart Sales (RCS) plugin for Zen Cart v2.1.0 to v2.2.2
PHP 8.3 to PHP 8.5
Version 4.2.1 Encapsulated only
2026-05-12
=============
DESCRIPTION:
=============
Recover Cart Sales Tool is an admin utility for Zen Cart allowing merchants to send individual or 
bulk email messages to customers who have set up a shop account and added items to their shopping 
cart, but for various reasons did not complete submitting an order (this is known as an 'abandoned 
cart'). The tool also generates a report listing the "possible" response to your email, informing 
you if customer followed up with a purchase from your shop. The email sent to these customers may 
help educate your customers about your shop and at the same time assist you the merchant in identifying 
trends and individual reasons behind abandoned carts. Use this tool diligently. 
Compose your email message carefully. Don't burden your customers with undesirable repeat messages. 
The idea here is to "recover" sales and reduce abandoned carts, not lose customers.

=============
INSTALL:
=============
1. Upload plugin files to your Zen Cart zc_plugins directory

2. Now login to your Zen Cart admin.

3. Run the installer from admin > Modules > Plugin Installer

4. Three new menus should display in ZC admin:
   - Configuration > Configure RCS
   - Customers > Abandoned Carts
   - Reports > Recovered Sales Results
   
   
=============
CONFIGURE:
=============
1. Configuration > Configure RCS:
  Allows for configuration of Recover Cart Sales module
  
  Version 4.0 settings:

  Look back days            30           
  Sales Results Report days 90  
  E-Mail time to live       90  
  Friendly E-Mails          true/false  
  E-Mail Copies to          (allows for copies of emails to be sent to whomever)
  Show Attributes           true/false  
  Ignore Customers with Sessions    true/false 
  Ignore Repeat Customers       true/false  
  Current Customer Color        0000FF  
  Uncontacted hilight color     80FFFF   
  Contacted hilight color       FF9FA2   
  Matching Order Hilight        9FFF22   
  Skip Carts w/Matched Orders       true/false   
  Autocheck "safe" carts to email   true/false   
  Match orders from any date        true/false   
  Lowest Pending sales status       Pending [1]     
  Report Even Row Style         dataTableRow    
  Report Odd Row Style

  
===================
HOW TO USE THE MOD:
===================
1. Customers > Abandoned Carts:
   Search for abandoned carts to "recover" and compose/send individual/bulk email to customers.

    After configuring RCS in "CONFIGURE" step above:

    a. Search for customers who still have items in their shopping cart.
        (first set the number of days back you want to search for abandoned carts)
    b. Results will appear as "uncontacted" or "previously contacted by RCS"
    c. Check the box next to the customers you want to send a bulk RCS email
    d. Compose the body of the bulk email you will send to customers (see RCS email template in /admin/includes/languages/english/recover_cart_sales.php)
    e. Set an appropriate subject and your store email address 
    f. Send email

    NOTE: Before sending bulk messages it's best to create a test account, add item to shopping cart (don't order) then select ONLY your "uncontacted" email 
          address to send you a test RCS message. Then view the message to ensure the results are as desired. 
 
2. Reports > Recovered Sales Results:
   Display RCS email results report (that is, did customers return to your shop and resubmit abandoned cart or buy other items?) 

    a. Select the number of days to show.

    b. The results will present the following in the report:

    Examined Records:   
    Recovered Sales:     
    (Possible sales from customers who abanoned carts & were notified via RCS)

    For each "recovered sale" the report will display:
    - SCart ID  (entry number in the "scart" table in the db)
    - Date Added to SC  
        - RC email sent     
        - Customer Name     
        - Order Date    
        - Status    
        - Amount

    Note: Once an order arrives from customer cart listed on the abandoned cart list, the entry on the list 
          should be automatically cleared and then the customer's orders should automatically display on the RCS report.
    
UPGRADING
=========
Installing the encapsulated version will delete all existing non-plugin directory files for Recover Cart Sales
    FILES:
    =============
    /YOUR_admin/recover_cart_sales.php
    /YOUR_admin/stats_recover_cart_sales.php
    /YOUR_admin/includes/extra_datafiles/recover_cart_filenames.php
    /YOUR_admin/includes/functions/install_rcs.php
    /YOUR_admin/includes/languages/english/recover_cart_sales.php
    /YOUR_admin/includes/languages/english/stats_recover_cart_sales.php
    /YOUR_admin/includes/languages/english/extra_definitions/recover_cart.php
    =============
    The values in the config will remain and so will the scart table.
    When the the encapsulated verson is uninstalled all database entries are removed including the scart table.
    
MAINTENANCE:
=============   
Occassionally flush out your "scart" db table (via phpmyadmin). Be sure to check your uncontacted/contacted list and RCS report before flushing.

========================================
COMMON KNOWN ISSUES:
========================================
- Supports sending text email only, not HTML. Sent message is based on Zen Cart email template.
- When a customer with an abandoned cart is deleted from Zen Cart, sometimes the cart can still stick around in the database, 
  and then RCS reports the cart data without connecting it to a customer. And then you cannot clear the item from the RCS report. 
  If this occurs flushing your 'scart' db table (via phpmyadmin) is recommended.
- RCS sometimes reports incorrect dates in abandoned cart list and the report. If you have solutions please post to the support forum.

=================
ZEN CART VERSION:
=================
Zen Cart v2.1.0 to v2.2.2 with PHP 8.2 to 8.5
(this mod version will not run on any previous version)

=============
AUTHORS:
=============
Too many too list here. See mod history below.

=============
SUPPORT:
=============
In Zen Cart Support Forum
http://www.zen-cart.com/forum/showthread.php?t=37128

Previous archived threads related to his mod:
http://www.zen-cart.com/forum/showthread.php?t=48516
http://www.zen-cart.com/forum/showthread.php?t=31037
http://www.zen-cart.com/forum/showthread.php?t=30680
http://www.zen-cart.com/forum/showthread.php?t=22231
http://www.zen-cart.com/forum/showthread.php?t=13920
http://www.zen-cart.com/forum/showthread.php?t=13191


=============
HISTORY:
=============
Based on an original release of unsold carts by JM Ivler
 Oct 8th, 2003
 
Report was turned into a sales tool by JM Ivler - Nov 22, 2003
  (recover_cart_sales.php) 
   based on the scart.php program based on Oct 8 unsold carts code release.

1.2 to 1.36 - Modifed by Aalst - aalst@aalst.com
  (recover_cart_sales.php,v 1.2) - Nov 28th 2003
  (recover_cart_sales.php,v 1.3) - Nov 29th 2003
  (recover_cart_sales.php,v 1.3.5) - Nov 30th 2003
  (recover_cart_sales.php,v 1.3.6) -  Dec 2nd 2003

1.4 - Modifed by willross - reply@qwest.net
   recover_cart_sales.php,v 1.4) - Mar 31st 2004
 
1.4d to 2.11 - Modified by Lane Roathe  - lane@ifd.com
   www.osc-modsquad.com / www.ifd.com
   (recover_cart_sales.php,v 1.4d to v2.11)
   
1.4d/e    Nov 12, 2004/Nov 13, 2004

** 1.4e to 2.11 - Visit OSC site for mod development history **

2005/03/09 - RecoverCartSales for Zen Cart (merlin)
    Port mod to Zen Cart

2005/05/31 - updated version released for Zen Cart 1.2x (merlin)
2005/06/01 - updated version released for Zen Cart 1.2x (merlin)
2005/06/20 - updated version released for Zen Cart 1.2x (merlin)
2005/07/20 - updated version released for Zen Cart 1.2x (merlin)

NOTE: It appears at this point mod development for Zen Cart forked with upgrades to ports of both 1.4 and 2.11 versions occurring during the same time by different authors. History is murky.

2006/03/08 - RecoverCartSales for Zen Cart 1.3.0.2
    Version number and author not documented

2.12* - Modified by Andrew Berezin (a_berezin)
    2006/09/17 Update of v.2.11

1.5 - 2006/09/20 v.1.5 (brent firar) - bfriar@gmail.com
    Update of v.1.4d/e (recover_cart_sales.php,v 1.5)
    Updated <head> for JS menus
    Updated to use database_tables.php vs. hardcoded name

2.12a - 2006/11/08 (a_berezin)
    Update of 2.12
    
1.5.1 12-04-06 1.5.1 (quentin)
    Update of v.1.5, and standardize language-selector

Later known v.2.12 updates released by Andrew (a_berezin):
2.12b - 2007/02/27 (a_berezin)
2.12c - 2007/04/01 (a_berezin)
2.12d - 2007/04/29 (a_berezin)
2.12e - 2007/04/30 (a_berezin)
2.12f - 2007/05/03 (a_berezin)   sql patch update
    
3.00 - 2007/08/11 (woodymon)
    same as 2.12f 
    - one superficial edit in a heading define
    - readme added (previous versions contained no readme)

3.00a - 2009/03/17 (numinix)
  - fixed small bug;
  
3.00B - 2009/03/17 (PRO-Webs)  - fixed email spelling error from "shopping by" to "stopping by"
  
3.1.0 - 2009/09/08 (numinix) - added option to skip all repeat customers

4.00.00a - 2012/04/23 (testuser)  - Upgraded module to work with Zen Cart 1.5 (not backwards compatible, use previous version 3.1.0)
  
4.0.1  2014/08/03 (jwlamb) - Upgraded module to show attributes in the Tools>Recover Cart Sales. Updated some possible php errors. Now includes an uninstall.sql.

4.0.4 - 12/2016 Improvements to email handling

4.0.5 - 07/2017 - DrByte - Automated the DB/menu install process

4.0.6 - 02/2022 - ThatSoftwareGuy - add specific template for email sends and specify module in zen_mail 

4.2 - 2026-05-09 OldNGrey - international dates DATE_FORMAT_INTL (update lang.recover_cart.php in english/extra_definitions as well), customer ID appended to customer name for better identification where names are identical, maintain sort order by date added, reformatted code; updated lang file with new defines, change buttom images to css

4.2.1 2026-05-12 encapsulated
