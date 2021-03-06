<?php 

class PaEnqueueFiles {
	public function __construct(){
		add_action('wp_enqueue_scripts', [$this, 'RegisterChildAssets']);
		add_action('admin_enqueue_scripts', [$this, 'enqueueAssets'], 15);
	}

	public function RegisterChildAssets() {
		wp_enqueue_style( 'pa-child-style', get_stylesheet_uri());
	}

	function enqueueAssets() {
    wp_localize_script(
      'adventistas-admin', 
      'iasd',
      array(
        'requiredTaxonomies' => [
          [
            'post_type'    => 'post',
            'taxonomies'   => [
              'xtt-pa-editorias',
              'xtt-pa-owner',
              'xtt-pa-sedes'
            ],
          ]
        ],
        'unregisterBlocks' => [
          'acf/p-a-magazines', 
          'acf/p-a-list-news',
          'acf/p-a-carousel-downloads',
          'acf/p-a-list-downloads',
          'acf/p-a-carousel-ministry',
          'acf/p-a-list-buttons',
          'acf/p-a-list-items',
          'acf/p-a-list-icons',
          'acf/p-a-carousel-feature',
          'acf/p-a-list-videos'
        ],
      )
    );
	}
}
$PaEnqueueFiles = new PaEnqueueFiles();
