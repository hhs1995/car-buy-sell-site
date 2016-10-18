<?php
App::uses('Versione', 'Model');

/**
 * Versione Test Case
 *
 */
class VersioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.versione',
		'app.model',
		'app.segmento',
		'app.modelo',
		'app.marca',
		'app.foto',
		'app.planesnuevo',
		'app.cuota',
		'app.planesusado',
		'app.video'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Versione = ClassRegistry::init('Versione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Versione);

		parent::tearDown();
	}

}
