<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * UniBooks
 *
 * An application for books trade off
 *
 * @package UniBooks
 * @author Emiliano Bovetti
 * @since Version 1.0
 */

$lang['email_must_be_array'] = "Il metodo di validazione email deve essere passato come array.";
$lang['email_invalid_address'] = "Indirizzo email non valido: %s";
$lang['email_attachment_missing'] = "Impossibile individuare il seguente allegato email: %s";
$lang['email_attachment_unreadable'] = "Impossibile aprire questo allegato: %s";
$lang['email_no_recipients'] = "È necessario includere i destinatari: To, Cc, or Bcc";
$lang['email_send_failure_phpmail'] = "Impossibile inviare email con PHP mail().  Il tuo server potrebbe non essere configuarto per inviare email con questo metodo.";
$lang['email_send_failure_sendmail'] = "Impossibile inviare email con PHP Sendmail. Il tuo server potrebbe non essere configuarto per inviare email con questo metodo.";
$lang['email_send_failure_smtp'] = "Impossibile inviare email con PHP SMTP.  Il tuo server potrebbe non essere configuarto per inviare email con questo metodo.";
$lang['email_sent'] = "Il tuo messaggio è stato inviato con successo attraverso il seguente protocollo: %s";
$lang['email_no_socket'] = "Impossibile aprire un socket per Sendmail. Per favore controlla le impostazioni.";
$lang['email_no_hostname'] = "Non è stato specificato un hostname SMTP.";
$lang['email_smtp_error'] = "È stato riscontrato il seguente errore SMTP: %s";
$lang['email_no_smtp_unpw'] = "Errore: è necessario assegnare un username e una password SMTP.";
$lang['email_failed_smtp_login'] = "Impossibile inviare il comando AUTH LOGIN. Errore: %s";
$lang['email_smtp_auth_un'] = "Impossibile autenticare l'username. Errore: %s";
$lang['email_smtp_auth_pw'] = "Impossibile autenticare la password. Errore: %s";
$lang['email_smtp_data_failure'] = "Impossibile inviare dati: %s";
$lang['email_exit_status'] = "Codice di uscita: %s";


/* End of file email_lang.php */
/* Location: ./application/language/italian/email_lang.php */
