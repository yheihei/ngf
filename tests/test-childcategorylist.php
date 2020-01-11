<?php
/**
 * Class SampleTest
 *
 * @package Ngf
 */

/**
 * カテゴリーリンクを開いた場合、記事一覧ではなくそれぞれの子カテゴリーの一覧を出す
 */
class カテゴリーリンクを開いた場合、記事一覧ではなくそれぞれの子カテゴリーの一覧を出す extends WP_UnitTestCase {

	public $_category_id;
	public $_category_id2;
	public $_category_id_child;

	public function setUp() {
		$this->_category_id = wp_create_category( 'Competition' );
		$this->_category_id_child = wp_create_category( 'IKUTA CUP 2019', $this->_category_id );
		$this->_category_id2 = wp_create_category( '講習会' );
		update_option( 'ngf_child_category_show_ids', $this->_category_id . "," . $this->_category_id2 );
	}

	/**
	 * @test
	 */
	public function 子カテゴリーを出す対象のカテゴリーが保存されていること() {
		$this->assertEquals( 'Competition', getShowChildCategorys()[0]->name );
	}

	/**
	 * @test
	 */
	public function 子カテゴリーを出す対象のカテゴリーが複数保存されていること() {
		$this->assertEquals( 2, count(getShowChildCategorys()) );
	}

	/**
	 * @test
	 */
	public function 指定の子カテゴリーが取得できること() {
		$this->assertEquals( 'IKUTA CUP 2019', getCategorysChilds($this->_category_id)[0]->name );
	}

	/**
	 * @test
	 */
	public function 現在のページが対象のページである() {
		$this->go_to( get_category_link($this->_category_id) );
		$this->assertTrue( is_show_childs_category_page() );
	}

	/**
	 * @test
	 */
	public function 現在のページが対象のページでない() {
		$this->go_to( get_category_link($this->_category_id_child) );
		$this->assertFalse( is_show_childs_category_page() );
	}

	/**
	 * @test
	 */
	public function 現在のページがカテゴリーページでないため対象ではない() {
		$this->go_to( '/' );
		$this->assertFalse( is_show_childs_category_page() );
	}
}
