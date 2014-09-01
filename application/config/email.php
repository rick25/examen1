<?php

/*
 * What protocol to use?
 * mail, sendmail, smtp
 */
//$config['protocol'] = 'mail';
$config['protocol'] = 'smtp';

/*
 * SMTP server address and port
 */
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
//$config['smtp_host'] = 'ssl://smtp.googlemail.com';
//$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 465;
//$config['smtp_port'] = '465';
//$config['smtp_port'] = '587';


//$config['smtp_host']='tls://smtp.googlemail.com'; $config['smtp_port']='587';
/*
 * SMTP username and password.
 */
//$config['smtp_user'] = '';
$config['smtp_user'] = 'liker251281@gmail.com';
$config['smtp_pass'] = '20ri8125';



//$config['smtp_timeout'] = '6';  // Tiempo de espera SMTP(segundos)
//$config['email']['newline']  = '\r\n';
//$config['mailtype'] = 'html'; // o text para texto sin HTML
/*
 * Heroku Sendgrid information.
 */
/*
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.sendgrid.net';
$config['smtp_port'] = 587;
$config['smtp_user'] = $_SERVER['SENDGRID_USERNAME'];
$config['smtp_pass'] = $_SERVER['SENDGRID_PASSWORD'];
*/
