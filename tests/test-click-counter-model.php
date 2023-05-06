<?php
/**
 * Class TemplateTagsTest
 *
 * @package Lightning_Pro_Child_Vws
 */


class ClickCounterModelTest extends WP_UnitTestCase {

    private $click_counter_model = null;

    public function setUp() : void {
		parent::setUp();
        $this->click_counter_model = BF_ClickCounter\ClickCounterModel::get_instance();
        $this->click_counter_model->activate();

    }

    public function test_all() {
        $this->click_counter_model->countup('test', '127.0.0.1');
        $this->assertEquals(  $this->click_counter_model->get_count('test'), 1 );
        $this->click_counter_model->countup( 'test', '127.0.0.1' );
        $this->assertEquals(  $this->click_counter_model->get_count('test'), 1 );
        $this->click_counter_model->countup( 'test2', '127.0.0.1' );
        $this->assertEquals(  $this->click_counter_model->get_count('test2'), 1 );
        $this->click_counter_model->countup( 'test', '127.0.0.2' );
        $this->assertEquals(  $this->click_counter_model->get_count('test'), 2 );
        $this->click_counter_model->countup( 'test2', '127.0.0.1' );
        $this->assertEquals(  $this->click_counter_model->get_count('test2'), 1 );
        $this->click_counter_model->countup( 'test2', '127.0.0.2' );
        $this->assertEquals(  $this->click_counter_model->get_count('test2'), 2 );
        $this->click_counter_model->delete( 'test' );
        $this->assertEquals(  $this->click_counter_model->get_count('test'), null);

        $this->click_counter_model->update( array('count' => 11), array('counter_key' => 'test2'));
        $this->assertEquals(  $this->click_counter_model->get_count('test2'), 11 );

    }



    public function tearDown() : void {
		parent::tearDown();
        $this->click_counter_model->drop_table();
        
    }
}
