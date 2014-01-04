		<h1>Risultati della ricerca</h1>
<?php
if( ! $books_data )
	echo '<p>La ricerca non ha prodotto risultati</p>';
else
{
	echo form_open('book/select_result');

	$this->table->set_heading('Titolo', 'Autori', 'Anno di pubblicazione', 'ISBN', 'Pagine', 'Materia'/*, 'Lingua'*/);
	foreach ( $books_data as $index => $book )
	{
		$radio = array(
			'name'	=> 'book_id',
			'id'		=> 'book_id',
			'value'	=> $book['ID'],
		);
		unset($book['ID']);
		array_push($book, form_radio($radio));
		$this->table->add_row($book);
	}
	echo $this->table->generate();

	echo form_submit('select', 'Seleziona');
	echo form_close();
}
?>