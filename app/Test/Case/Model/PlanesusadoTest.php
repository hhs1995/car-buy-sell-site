<?php
App::uses('Planesusado', 'Model');

/**
 * Planesusado Test Case
 *
 */
class PlanesusadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.planesusado',
		'app.modelo',
		'app.marca',
		'app.foto',
		'app.planesnuevo',
		'app.version',
		'app.segmento',
		'app.cuota',
		'app.video'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Planesusado = ClassRegistry::init('Planesusado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Planesusado);

		parent::tearDown();
	}

}
