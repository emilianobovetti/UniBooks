
<?php

echo	form_open($action),
				"<label for=\"{$input['id']}\">$label</label>",
				form_input($input),
				form_submit($submit_name, $submit_value),
			form_close(),
			validation_errors();
