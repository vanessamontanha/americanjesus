<?php
echo json_encode(array(
	'success'=>TRUE,
	'stores'=>$stores,
	'table'=>$this->element('stores_table',array(
		'stores'=>$stores
	))
));