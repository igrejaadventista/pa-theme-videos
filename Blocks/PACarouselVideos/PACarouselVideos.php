<?php

namespace Blocks\PACarouselVideos;

use Blocks\Block;
use ExtendedLocal\LocalData;
use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\ButtonGroup;
use Extended\ACF\Fields\Text;

/**
 * Class PACarouselVideos
 * @package Blocks\PACarouselVideos
 */
class PACarouselVideos extends Block
{

	public function __construct()
    {
		parent::__construct([
			'title' 	  => __('IASD - Videos - Carousel', 'iasd'),
			'description' => 'Block to show video content on carousel format.',
			'category' 	  => 'pa-adventista',
			'keywords' 	  => ['featured'],
			'icon' 		  => '<svg id="Icons" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" 
							xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<style type="text/css">.st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}</style>
							<polyline class="st0" points="25,11 27,13 25,15 "/><polyline class="st0" points="7,11 5,13 7,15 "/><path class="st0" 
							d="M29,23H3c-1.1,0-2-0.9-2-2V5c0-1.1,0.9-2,2-2h26c1.1,0,2,0.9,2,2v16C31,22.1,30.1,23,29,23z"/><circle class="st0" cx="16" cy="28" r="1"/>
							<circle class="st0" cx="10" cy="28" r="1"/><circle class="st0" cx="22" cy="28" r="1"/></svg>',
		]);

    add_filter('acf/fields/localposts_data/query/name=items_popular', array($this, 'filter'));
	}

	/**
	 * set ACF Field
	 *
	 * @return array Fields array
	 */
	protected function setFields(): array
    {
		return [
            Text::make(__('Title', 'iasd'), 'title')
                ->defaultValue('IASD - Carrosel de Vídeos'),

			ButtonGroup::make('Modo', 'mode')
				->choices([
					'latest' => __('Recents', 'iasd'),
					'popular' => __('Popular', 'iasd'),
				])
				->defaultValue('latest'),

        LocalData::make(__('Videos', 'iasd'), 'items_latest')
          ->instructions(__('Select videos', 'iasd'))
          ->postTypes(['post'])
          ->initialLimit(10)
          ->manualItems(false)
          ->filterTaxonomies([
            'xtt-pa-sedes',
            'xtt-pa-projetos',
            'xtt-pa-departamentos',
            'xtt-pa-colecoes',
            'xtt-pa-editorias',  
          ])
          ->conditionalLogic([
              ConditionalLogic::where('mode', '==', 'latest')
          ]),

        LocalData::make(__('Videos', 'iasd'), 'items_popular')
          ->instructions(__('Select videos', 'iasd'))
          ->postTypes(['post'])
          ->initialLimit(10)
          ->manualItems(false)
          ->filterTaxonomies([
            'xtt-pa-sedes',
            'xtt-pa-projetos',
            'xtt-pa-departamentos',
            'xtt-pa-colecoes',
            'xtt-pa-editorias', 
          ])
          ->conditionalLogic([
              ConditionalLogic::where('mode', '==','popular')
          ]),
		];
	}

	/**
	 * with Inject fields values into template
	 *
	 * @return array
	 */
	public function with(): array
    {
      $mode  = get_field('mode');
      $items = get_field("items_{$mode}");

		return [
			'title'	=> get_field('title'),
			'items'        => !empty($items) && !is_wp_error($items) && isset($items['data']) ? array_column($items['data'], 'id') : null,
		];
	}

  function filter(array $args): array {
    $args['meta_key'] = 'views_count';
    $args['orderby']  = 'meta_value_num';
    $args['order']    = 'DESC';

    return $args;
  }

}
