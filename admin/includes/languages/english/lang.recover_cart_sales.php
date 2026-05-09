<?php
/*
  $Id: recover_cart_sales.php, v4.00.00a 2012/04/23 testuser -> iChoze -> Zen Cart v1.5 $ Exp $
  Recover Cart Sales ENGLISH Language File 
  HISTORY
  - Recover Cart Sales contribution: JM Ivler (c)   Copyright (c) 2003-2026 JM Ivler  Released under the GNU General Public License
2026-05-09 OldNGrey updated International date format; css buttons and unique constant names
*/
$define = [
   'MESSAGE_STACK_CUSTOMER_ID' =>  'Cart for Customer-ID ',
   'MESSAGE_STACK_CART_CUSTOMER' =>  'Cart for Customer ',
   'MESSAGE_STACK_DELETE_SUCCESS' =>  ' deleted successfully',
   'MESSAGE_STACK_CUSTOMER' =>  'Customer ',
   'MESSAGE_STACK_SETCONTACTED' =>  ' Marked as Contacted.',
   'HEADING_TITLE' =>  'Recover Cart Sales',
   'HEADING_EMAIL_SENT' =>  'E-mail Sent Report',
   'EMAIL_TEXT_LOGIN' =>  'Login to your account here:',
   'EMAIL_SEPARATOR' =>  '------------------------------------------------------',
   'EMAIL_TEXT_SUBJECT' =>  'Inquiry from '.  STORE_NAME ,
   'EMAIL_TEXT_SALUTATION' =>  'Dear ' ,
   'EMAIL_TEXT_NEWCUST_INTRO' =>  "\n\n" . 'Thank you for stopping by ' . STORE_NAME .  ' and considering us for your purchase. ',
   'EMAIL_TEXT_CURCUST_INTRO' =>  "\n\n" . 'We would like to thank you for having shopped at ' .  STORE_NAME . ' in the past. ', 
   'EMAIL_TEXT_BODY_HEADER' => 
	'We noticed that during a visit to our store you placed ' .
	'the following item(s) in your shopping cart, but did not complete ' .
	'the transaction.' . "\n\n" .
	'Shopping Cart Contents:' . "\n\n",
   'EMAIL_TEXT_BODY_FOOTER' => 
	'We are always interested in knowing what happened ' .
	'and if there was a reason that you decided not to purchase at ' .
	'this time. If you could be so kind as to let us ' .
	'know if you had any issues or concerns, we would appreciate it.  ' .
	'We are asking for feedback from you and others as to how we can ' .
	'help make your experience at '. STORE_NAME . ' better.'."\n\n".
	'PLEASE NOTE:'."\n".'If you believe you completed your purchase and are ' .
	'wondering why it was not delivered, this email is an indication that ' .
	'your order was NOT completed, and that you have NOT been charged! ' .
	'Please return to the store in order to complete your order.'."\n\n".
	'Our apologies if you already completed your purchase, ' .
	'we try not to send these messages in those cases, but sometimes it is ' .
	'hard for us to tell depending on individual circumstances.'."\n\n".
	'Again, thank you for your time and consideration in helping us ' .
	'improve the ' . STORE_NAME .  " website.\n\nSincerely,\n\n", 
   'DAYS_FIELD_PREFIX' =>  'Show for last ',
   'DAYS_FIELD_POSTFIX' =>  ' days ',
   'DAYS_FIELD_BUTTON' =>  'Go',
   'TABLE_HEADING_DATE' =>  'DATE',
   'TABLE_HEADING_CONTACT' =>  'CONTACTED',
   'TABLE_HEADING_CUSTOMER' =>  'CUSTOMER NAME',
   'TABLE_HEADING_EMAIL' =>  'E-MAIL',
   'TABLE_HEADING_PHONE' =>  'PHONE',
   'TABLE_HEADING_MODEL' =>  'ITEM',
   'TABLE_HEADING_DESCRIPTION' =>  'DESCRIPTION',
   'TABLE_HEADING_QUANTY' =>  'QTY',
   'TABLE_HEADING_PRICE' =>  'PRICE',
   'TABLE_HEADING_TOTAL' =>  'TOTAL',
   'TABLE_GRAND_TOTAL' =>  'Grand Total: ',
   'TABLE_CART_TOTAL' =>  'Cart Total: ',
   'TEXT_CURRENT_CUSTOMER' =>  'CUSTOMER',
   'TEXT_SEND_EMAIL' =>  'Send E-mail',
   'TEXT_RETURN' =>  '[Click Here To Return]',
   'TEXT_NOT_CONTACTED' =>  'Uncontacted',
   'PSMSG' =>  'Additional PS Message: ',
   'TEXT_SET_CONTACTED' =>  'Set Contacted',
   'TEXT_FROM' =>  'From:',
   'TEXT_SUBJECT' =>  'Subject:',
   
    'BOX_REPORTS_RECOVER_CART_SALES' => 'Recovered Sales Results',
    'BOX_TOOLS_RECOVER_CART' => 'Abandoned Carts',
    'BOX_CONFIG_RECOVER_CART_SALES' => 'Configure RCS',
    'DATE_FORMAT_INTL' => 'Y-m-d',                    /* BMH new format 2024-12-18  for RCS recover cart */
    'IMAGE_RECOVER_CART_DELETE' => 'Delete',
    
];
return $define;

