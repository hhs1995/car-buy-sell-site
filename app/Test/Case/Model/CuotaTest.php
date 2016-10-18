<?php
App::uses('Cuota', 'Model');

/**
 * Cuota Test Case
 *
 */
class CuotaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuota',
		'app.planesnuevo',
		'app.modelo',
		'app.marca',
		'app.foto',
		'app.planesusado',
		'app.version',
		'app.model',
		'app.segmento',
		'app.video'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuota = ClassRegistry::init('Cuota');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuota);

		parent::tearDown();
	}

}
