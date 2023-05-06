<?php
/**
 * Class ShortcodeTest
 *
 * @package Lightning_Pro_Child_Vws
 */


class ShortcodeTest extends WP_UnitTestCase {

    private $click_counter_model = null;

    public function setUp() : void {
		parent::setUp();
        $this->click_counter_model = BF_ClickCounter\ClickCounterModel::get_instance();
        $this->click_counter_model->activate();

    }

    public function test_all() {
        $content = '[bfcc id="test"]';
        $this->click_counter_model->countup('test', '127.0.0.1');
        $this->click_counter_model->countup('test', '127.0.0.2');
        $output = do_shortcode( $content );
        $this->assertEquals( '<a href="javascript:void(0);" class="bf-click-counter" data-id="test">Like!(<span class="count">2</span>)</a>', $output );
    }

    public function test_build() {
        $shortcode = BF_ClickCounter\Shortcode::get_instance();
        $result = $shortcode->build( array( 'id' => 'test' , 'ip' => 0 ) );
        $this->assertEquals('[bfcc id="test" ip="0"]', $result);
        $result = $shortcode->build( array( 'id' => 'test2' , 'ip' => 7 ) );
        $this->assertEquals('[bfcc id="test2" ip="7"]', $result);
        $result = $shortcode->build( array( 'id' => 'test2' ) );
        $this->assertEquals('[bfcc id="test2"]', $result);
    }



    public function tearDown() : void {
		parent::tearDown();
        $this->click_counter_model->drop_table();
        
    }
}
