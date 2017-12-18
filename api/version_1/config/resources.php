<?php

return array(

	/* ----------------------------------------------------------------------------------------------
	 * Available methods for the resources
	 * ----------------------------------------------------------------------------------------------
	 *
	 */

	'users' => array(
		'/' => array('GET', 'POST'),
		'/{id}' => array('GET', 'DELETE')
	),

    'tasks' => array(
        '/' => array('GET', 'POST'),
        '/{id}' => array('GET', 'DELETE')
    ),

    'tasksByUser' => array(
        '/{id}' => array('GET', 'POST', 'DELETE')
    ),

);