<?php
/**
 * CuotaFixture
 *
 */
class CuotaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'planesnuevo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'texto' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'orden' => array('type' => 'integer', 'null' => false, 'default' => null),
		'valor' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'cuotaPlanesnuevos' => array('column' => 'planesnuevo_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'planesnuevo_id' => 1,
			'texto' => 'Lorem ipsum dolor sit amet',
			'orden' => 1,
			'valor' => 1
		),
	);

}
