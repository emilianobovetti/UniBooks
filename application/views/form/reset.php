
<?php echo validation_errors(); ?>

<?php echo form_open('user/reset'); ?>
	  <h1>Iscrizione</h1>
	  <p>Inserisci il tuo nome utente o la tua email:
	  	<?php echo form_input($reset_form_data); ?>
	  </p>
<?php
		echo form_submit('reset', 'Reset password');
echo form_close(); 
?>

 