
<?php echo  form_open($action) ?>
      <label for="isbn_field">ISBN del libro da vendere</label>

<?php echo
    form_input(array(
        'name'          => 'isbn',
        'id'                => 'isbn_field',
        'maxlength' => '13',
        'value'         => $isbn,
    ));
?>
      <label for="price_field">Prezzo di vendita</label>

<?php echo
    form_input(array(
        'name'          => 'price',
        'id'                => 'price_field',
        'maxlength' => '7',
        'value'         => $price,
    ));
?>
      <label for="description_field">Descrizione (opzionale)</label>

<?php echo
    form_textarea(array(
        'name'          => 'description',
        'id'                => 'description_field',
        'value'         => $description,
    )),
    form_submit('book_sell', 'Continua'),
    form_close(),
    validation_errors();
