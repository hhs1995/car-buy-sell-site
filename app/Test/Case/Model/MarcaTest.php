<?php
App::uses('Marca', 'Model');

/**
 * Marca Test Case
 *
 */
class MarcaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.marca',
		'app.modelo',
		'app.foto',
		'app.planesnuevo',
		'app.version',
		'app.model',
		'app.segmento',
		'app.planesusado',
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
		$this->Marca = ClassRegistry::init('Marca');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Marca);

		parent::tearDown();
	}

}
