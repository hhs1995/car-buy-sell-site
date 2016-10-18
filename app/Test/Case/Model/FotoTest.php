<?php
App::uses('Foto', 'Model');

/**
 * Foto Test Case
 *
 */
class FotoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.foto',
		'app.modelo',
		'app.marca',
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
		$this->Foto = ClassRegistry::init('Foto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Foto);

		parent::tearDown();
	}

}
