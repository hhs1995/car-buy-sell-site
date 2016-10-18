<?php
App::uses('Planesnuevo', 'Model');

/**
 * Planesnuevo Test Case
 *
 */
class PlanesnuevoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.planesnuevo',
		'app.modelo',
		'app.marca',
		'app.foto',
		'app.planesusado',
		'app.version',
		'app.segmento',
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
		$this->Planesnuevo = ClassRegistry::init('Planesnuevo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Planesnuevo);

		parent::tearDown();
	}

}
