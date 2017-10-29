<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

$config['useragent'] = 'PHPMailer';
$config['protocol'] = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
$config['mailpath'] = 'abc123';
$config['smtp_host'] = 'abc123';
$config['smtp_user'] = 'abc13';
$config['smtp_pass'] = '';
$config['smtp_port'] = '465';
$config['charset'] = 'utf-8'; // Default should be utf-8 (this should be a text field) // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
$config['smtp_timeout'] = '30';

$config['smtp_crypto'] = 'ssl';                    // '' or 'tls' or 'ssl'
$config['smtp_debug'] = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
$config['smtp_auto_tls'] = false;                    // Whether to enable TLS encryption automatically if a server supports it, even if `smtp_crypto` is not set to 'tls'.
$config['smtp_conn_options'] = array();                 // SMTP connection options, an array passed to the function stream_context_create() when connecting via SMTP.
$config['wordwrap'] = true;
$config['wrapchars'] = 76;
$config['mailtype'] = 'html';                   // 'text' or 'html'

$config['validate'] = TRUE;
$config['priority'] = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
$config['crlf'] = "\r\n";                     // "\r\n" or "\n" or "\r"
$config['newline'] = "\r\n";
$config['encoding'] = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.
// DKIM Signing
$config['dkim_domain'] = '';                       // DKIM signing domain name, for exmple 'example.com'.
$config['dkim_private'] = '';                       // DKIM private key, set as a file path.
$config['dkim_private_string'] = '';                    // DKIM private key, set directly from a string.
$config['dkim_selector'] = '';                       // DKIM selector.
$config['dkim_passphrase'] = '';                       // DKIM passphrase, used if your key is encrypted.
$config['dkim_identity'] = '';                       // DKIM Identity, usually the email address used as the source of the email.

