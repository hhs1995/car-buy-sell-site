<?php
App::uses('Plantipo', 'Model');

/**
 * Plantipo Test Case
 *
 */
class PlantipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.plantipo',
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
		$this->Plantipo = ClassRegistry::init('Plantipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Plantipo);

		parent::tearDown();
	}

}
