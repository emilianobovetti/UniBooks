    <?php echo form_open('login'); ?>
      
      <h1>Login</h1>
      <p>Nickname: <?php echo form_input($user_name); ?> </p>
      <p>Password: <?php echo form_password($password); ?> </p>
    <?php echo form_submit('login', 'Log In!');
echo form_close();

echo validation_errors();
?>