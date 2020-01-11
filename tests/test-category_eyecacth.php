<?php
/**
 * Class SampleTest
 *
 * @package Ngf
 */

/**
 * カテゴリーにはアイキャッチを表示できる
 */
class カテゴリーにはアイキャッチを表示できる extends WP_UnitTestCase {

	public $_category_id;
	public $_category_id2;
	const IMG_URL = 'http://example.com/img/hoge.jpg';

	public function setUp() {
		$this->_category_id = wp_create_category( 'アイキャッチ付きカテゴリー' );
		update_term_meta( $this->_category_id, NGF_CATEGORY_EYECATCH, self::IMG_URL );
		$this->_category_id2 = wp_create_category( 'アイキャッチなしカテゴリー' );
	}

	/**
	 * @test
	 */
	public function アイキャッチ画像のURLが取得できる() {
		$this->assertEquals(self::IMG_URL, get_term_meta( $this->_category_id, NGF_CATEGORY_EYECATCH )[0] );
	}

	/**
	 * @test
	 */
	public function カテゴリーページに遷移した際に、アイキャッチ画像のURLが取得できる() {
		$this->go_to( get_category_link($this->_category_id) );
		$this->assertEquals(self::IMG_URL, get_the_category_eyecatch_url() );
	}

	/**
	 * @test
	 */
	public function アイキャッチ未設定の場合アイキャッチ画像のURLが空文字となること() {
		$this->go_to( get_category_link($this->_category_id2) );
		$this->assertEquals( '', get_the_category_eyecatch_url() );
	}

	/**
	 * @test
	 */
	public function カテゴリーページでない場合アイキャッチ画像のURLが空文字となること() {
		$this->go_to( '/' );
		$this->assertEquals( '', get_the_category_eyecatch_url() );
	}

	/**
	 * @test
	 */
	public function カテゴリーID指定で、アイキャッチ画像のURLが取得できる() {
		$this->assertEquals(self::IMG_URL, get_the_category_eyecatch_url($this->_category_id) );
	}
}
