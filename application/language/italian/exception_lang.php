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

$lang['exception_'.NO_EXCEPTIONS] = 'Nessuna eccezione sollevata';

$lang['exception_'.INVALID_EXCEPTION_CODE] = 'Eccezione lanciata con un codice non valido';
$lang['exception_'.INVALID_PARAMETER] = '&Egrave; stato fornito un parametro non valido';
$lang['exception_'.REQUIRED_PROPERTY] = 'La seguente propriet&agrave; deve essere settata per eseguire il metodo: ';

$lang['exception_'.ID_NON_EXISTENT] = 'ID inesistente';
$lang['exception_'.USER_NAME_NON_EXISTENT] = 'User name inesistente';
$lang['exception_'.EMAIL_NON_EXISTENT] = 'Indirizzo email inesistente';
$lang['exception_'.ISBN_NON_EXISTENT] = 'Codice ISBN non presente nel database';
$lang['exception_'.GOOGLE_ID_NON_EXISTENT] = 'Google id inesistente';
$lang['exception_'.NEITHER_USER_NOR_EMAIL] = 'Indirizzo email o nome utente non valido';
$lang['exception_'.SALE_NON_EXISTENT] = 'Vendita inesistente';
$lang['exception_'.REQUEST_NON_EXISTENT] = 'Richiesta inesistente';

$lang['exception_'.WRONG_PASSWORD] = 'La password inserita &egrave; errata';
$lang['exception_'.WRONG_CONFIRM_CODE] = 'Il codice di conferma non corrisponde';
$lang['exception_'.WRONG_ISBN] = 'Il codice ISBN inserito non &egrave; valido';
$lang['exception_'.ACCOUNT_ALREADY_CONFIRMED] = 'Questo account &egrave; gi&agrave; stato attivato';
$lang['exception_'.ACCOUNT_NOT_CONFIRMED] = 'Questo account deve essere prima attivato per eseguire questa operazione';


$lang['exception_'.EXISTING_SALE] = 'Vendita gi&agrave; esistente';
$lang['exception_'.EXISTING_REQUEST] = 'Richiesta gi&agrave; esistente';
$lang['exception_'.EXISTING_USER_NAME] = 'User name gi&agrave; esistente';
$lang['exception_'.EXISTING_EMAIL] = 'Indirizzo email gi&agrave; esistente';

$lang['exception_'.ISBN_NOT_FOUND] = 'Impossibile trovare codice ISBN (dalle API di google)';
$lang['exception_'.BOOK_NOT_FOUND] = 'Nessun libro trovato con i parametri indicati';

$lang['exception_'.REQUEST_OVERFLOW] = 'L\'elemento a cui stai cercando di accedere non esiste (request overflow)';
$lang['exception_'.REQUEST_UNDERFLOW] = 'L\'elemento a cui stai cercando di accedere non esiste (request underflow)';

/* End of file exception_lang.php */
/* Location: ./application/language/italian/exception_lang.php */ 
