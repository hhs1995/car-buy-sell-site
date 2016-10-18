<?php
App::uses('Segmento', 'Model');

/**
 * Segmento Test Case
 *
 */
class SegmentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.segmento',
		'app.version',
		'app.model',
		'app.planesnuevo',
		'app.modelo',
		'app.marca',
		'app.foto',
		'app.planesusado',
		'app.video',
		'app.cuota'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Segmento = ClassRegistry::init('Segmento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Segmento);

		parent::tearDown();
	}

}
