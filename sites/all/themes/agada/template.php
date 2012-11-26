<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can modify or override Drupal's theme
 *   functions, intercept or make additional variables available to your theme,
 *   and create custom PHP logic. For more information, please visit the Theme
 *   Developer's Guide on Drupal.org: http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to agada_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: agada_breadcrumb()
 *
 *   where agada is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override either of the two theme functions used in Zen
 *   core, you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
//function agada_preprocess_html(&$variables) {
//  $variables['head'] =<<<HTML
//	  <meta name="keywords" content="555"/>
//HTML;
////  token_replace('[node:author:picture]', array('node' => $node));
//  // The body tag's classes are controlled by the $classes_array variable. To
//  // remove a class from $classes_array, use array_diff().
//  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
//}
 


//function agada_html_head_alter(&$head_elements) {
//   $node=node_load(26);
//   $head_elements["system_meta_keywords"] = array(
//            '#type' => "html_tag",
//            '#tag' => "meta",
//            '#attributes' => array
//                (
//                    'name' => "keywords",
//                    'content' => "miriam, natanzon,Raab".token_replace('[node:field_agada_tags]', array('node' => $node)),
//	             ),
//			);
//              
//}

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function agada_preprocess_page(&$variables, $hook) {

	// kids custoized menu
	$space = spaces_get_space();

	if ($space && $space->term->name == "kids" ) {
		// remove "personal-area" for kids
		unset($variables['main_menu']['menu-605']);
		// add all stories-part to kids school
//		$variables['main_menu']['menu-5752222'] = Array
//			(
//            'attributes' => Array
//                (
//                    'title' => ''
//                ),
//            'href'=> 'all_kids_stories',
//            'title' => t('All Stories')
//        );
	} else {
		unset($variables['main_menu']['menu-6362']);
	}


//	$space = spaces_get_space();
//	if ($space){
//			dpm($space->term->name);
//
//	switch ($space->term->name) {
//      case 'kids':
//		  error_log("in agadaaaaaaaaaaaaaa ****");
//        $space->controllers->variable->set('site_frontpage', url('kids_frontpage'));
//		  $space->controllers->variable->set('site_name', 'hello566775');
//
//        //$space->controllers->variable->set('theme_default', 'blue');
//        break;
//
//      case 'Red':
//        $space->controllers->variable->set('menu_primary_links_source', 'menu-primary-links-red');
//        $space->controllers->variable->set('site_name', 'hello');
//        $space->controllers->variable->set('theme_default', 'red');
//        break;
//    }
//  }

  if (module_exists('comment') && isset($variables['node'])) {
    $variables['comment_form3'] = ($variables['node']->type != 'page')? drupal_get_form('comment_node_'.$variables['node']->type.'_form',(object) array('nid' => $variables['node']->nid)): '';
  }

  $google = t('Google button title');
  $email = t('Email button title');
  $favorites = t('Favorites button title');

  $variables['social_buttons_code']='';
  if (isset($variables['node'])) {
	  $social_buttons_code ='';
	  if ($variables['node']->type != 'agada_children_story') {
		  $social_buttons_code=<<<HTML
			 <a class="addthis_button_preferred_1"></a>
			 <a class="addthis_button_preferred_2" title="$google"></a>
			 <a class="addthis_button_preferred_3"></a>
			 <a class="addthis_button_preferred_6" title="$email"></a>	
HTML;
     }
  $variables['social_buttons_code']=<<<HTML
  <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
    $social_buttons_code
	 <a class="addthis_button_preferred_4" ></a>	
    <a class="addthis_button_preferred_5" title="$favorites"></a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e5f7b5e7c06284a"></script>
<!-- AddThis Button END -->
HTML;

  }


  // add meta tags: keywrds+description
  $agada_tags = agada_keywords();
  if (isset($variables['node'])) {
	  $agada_tags .= "," .token_replace('[node:field_agada_tags]', array('node' =>$variables['node']),array('clear'=>true)).",".token_replace('[node:field_gada_categories]', array('node' =>$variables['node']),array('clear'=>true));
  }
  $agada_description = agada_description();
  if (isset($variables['node'])) {
	  $agada_description .= "-".token_replace('[node:field-description]', array('node' =>$variables['node']), array('clear'=>true));
  }

  $head_elements["system_meta_keywords"] = array(
            '#type' => "html_tag",
            '#tag' => "meta",
            '#attributes' => array
                (
                    'name' => "keywords",
                    'content' => $agada_tags,
	             ),
	  );
  $head_elements["system_meta_description"] = array(
            '#type' => "html_tag",
            '#tag' => "meta",
            '#attributes' => array
                (
                    'name' => "description",
                    'content' => $agada_description,
	             ),
	  );
  drupal_add_html_head($head_elements["system_meta_keywords"], 'system_meta_keywords');
  drupal_add_html_head($head_elements["system_meta_description"], 'system_meta_description');

//	  dpm($variables['theme_hook_suggestions']);
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function agada_preprocess_node(&$variables, $hook) {
//   Optionally, run node-type-specific preprocess functions, like
//   agada_preprocess_node_page() or agada_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }

  // main page functions (q-tabs)
  if ($_GET['q'] == 'new_stories' || $_GET['q'] == 'commented_stories'|| $_GET['q'] == 'chidren_version_stories' || $_GET['q'] == 'viewed_stories' ||  drupal_is_front_page()) {
	  $variables['theme_hook_suggestions'][] = 'node_frontpage';
	}

  if (!isset($variables['content']['group_agada_content']['field_agada_foursquare_image']))
  {
	  $variables['category_image'] = get_category_image($variables['node']->nid); 
  }

//  if ($variables['view_mode'] == 'print') {
//   $variables['page'] = 1;
//  }

}


function  agada_preprocess_views_view_fields(&$vars) {
	if (isset($vars['fields']['nid'])) {
		$vars['category_image'] = get_category_image($vars['fields']['nid']->raw);
	}
}
function get_category_image($nid) { 
	$query = db_select('taxonomy_index', 't');
	$query->addField('t', 'tid');
	$query->join('field_data_field_agada_tags_image', 'i', 'i.entity_id=t.tid');
	$query->join('file_managed', 'f', 'f.fid=i.field_agada_tags_image_fid');
	$query->addField('f', 'uri');
	$query->condition('t.nid', $nid, "=");
	$terms = $query->execute();

	foreach ($terms as $term) {
		if ($term->uri) {
			return(file_create_url($term->uri));
		}
	}
	return(0);
}
/**
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function agada_preprocess_node_agada_children_story(&$variables, $hook) {
	$nid='';
	if (isset($variables['content']['field_original_version'])) {
		$nid = $variables['content']['field_original_version']['#items'][0]['nid'];
	}

  if ($nid) {
//	  $node = node_load($nid);
//	  $original_version = token_replace('[node:body]', array('node' =>$node),array('clear'=>true)).token_replace('[node:field_agada_image]', array('node' =>$node),array('clear'=>true));

	//  $variables['agada_story_body'] = $original_version;
	 $variables['agada_story_nid'] = $nid;
  }

  $name = clear_text($variables['title']);
  
  $variables['clear_name'] = $name;
}

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
function agada_preprocess_comment(&$variables, $hook) {

	// comments counter
	static $comment_counter;
    $variables['comment_counter'] = ++$comment_counter;
	
	//theme icons
	if (isset($variables['content']['links']['comment']['#links']['comment-reply'])) {
		$variables['content']['links']['comment']['#links']['comment-reply']['weight']= -3000;
		$variables['content']['links']['comment']['#links']['comment-reply']['title'] = theme('image', array('path'=>"sites/all/themes/agada/images/answer_comment.png", 'alt'=>t('reply'),  'title'=>t('reply')) );
	}

	if (isset($variables['content']['links']['comment']['#links']['comment-edit'])) {
		$variables['content']['links']['comment']['#links']['comment-edit']['weight']= -2000;
		$variables['content']['links']['comment']['#links']['comment-edit']['title'] = theme('image', array('path'=>"sites/all/themes/agada/images/edit_comment.png", 'alt'=>t('edit'),  'title'=>t('edit')) );
	}

	if (isset($variables['content']['links']['comment']['#links']['comment-delete'])) {
		$variables['content']['links']['comment']['#links']['comment-delete']['weight']= -1000;
		$variables['content']['links']['comment']['#links']['comment-delete']['title'] = theme('image', array('path'=>"sites/all/themes/agada/images/delete_comment.png", 'alt'=>t('delete'),  'title'=>t('delete')) );
	}

   // add the atachment icon to the links region
	if (isset($variables['content']['field_comment_attachment'])) {
		$variables['content']['links']['comment']['#links']['comment_attachment']['html']= 1;
		// we want the attachment icon to be the LAST one
		$variables['content']['links']['comment']['#links']['comment_attachment']['weight']= 10000;
		$variables['content']['links']['comment']['#links']['comment_attachment']['title'] = theme('image', array('path'=>"sites/all/themes/agada/images/attachment_icon.png", 'alt'=>t('atachment'),  'title'=>t('atachment')) );
	}

	if (isset($variables['content']['field_comment_type'])) {	
		$types_colors = array(t("simple comment type")=> "blue" , t("content comment type")=>"red", t("translate comment type")=>"green");
      $variables['types_colors_arr'] = $types_colors;
	}

//	// flag comments
//	if (isset($variables['content']['links']['flag']) && isset($variables['content']['links']['flag']['#links']['flag-flagged_comments'])) {
//		$variables['content']['links']['flag']['#links']['flag-flagged_comments']['title'] = theme('image', array('path'=>"sites/all/themes/agada/images/flag_comment.png", 'alt'=>$variables['content']['links']['flag']['#links']['flag-flagged_comments']['title'],  'title'=>$variables['content']['links']['flag']['#links']['flag-flagged_comments']['title']) );
//	}
//	// rating comments
//	if (isset($variables['content']['links']['flag']) && isset($variables['content']['links']['flag']['#links']['flag-comments_rating'])) {
//		$variables['content']['links']['flag']['#links']['flag-comments_rating']['title'] = theme('image', array('path'=>"sites/all/themes/agada/images/rate_comment.png", 'alt'=>$variables['content']['links']['flag']['#links']['flag-comments_rating']['title'],  'title'=>$variables['content']['links']['flag']['#links']['flag-comments_rating']['title']) );
//	}
	$variables['theme_hook_suggestions'][] = 'comment__' . $variables['node']->type;
}


/**
 * Process variables for comment-wrapper.tpl.php.
 *
 * @see comment-wrapper.tpl.php
 * @see theme_comment_wrapper()
 */
function agada_preprocess_comment_wrapper(&$variables) {
	$variables['theme_hook_suggestions'][] = 'comment_wrapper__' . $variables['node']->type;
}


///**
// * Override or insert variables into the block templates.
// *
// * @param $variables
// *   An array of variables to pass to the theme template.
// * @param $hook
// *   The name of the template being rendered ("block" in this case.)
// */
//function agada_preprocess_block(&$variables, $hook) {
//	dpm( $variables);
//  $variables['classes_array'][] = $variables['class_title'];
//}


/**
 * A preprocess function for our theme('flag'). It generates the
 * variables needed there.
 *
 * The $variables array initially contains the following arguments:
 * - $flag
 * - $action
 * - $content_id
 * - $after_flagging
 *
 * See 'flag.tpl.php' for their documentation.
 */
function agada_preprocess_flag(&$variables) {
  // Some typing shotcuts:
  $flag =& $variables['flag'];
 
  $variables['flag_counter'] = 0;
  $variables['link_html'] = 0;

  // add flag counter for the rating flag
  if ($flag->name == 'comments_rating') {
	  $count_flags = flag_get_counts( $flag->content_type , $variables['content_id']);
	  $variables['flag_counter'] =  (isset($count_flags['comments_rating'])) ? $count_flags['comments_rating']['content_id'] : 0 ;
  }
  switch ($flag->name) {
	  case 'bookmarks': 
		  $variables['link_html'] = 1;
		  if ($variables['link_href'] && $variables['action']=="flag" ) {
			 $variables['link_text'] = theme('image', array('path'=>path_to_theme().'/images/add_to_favorite.png'));
		  }
	     break;
		case 'comments_rating': 
		  $variables['link_html'] = 1;
		  if ($variables['link_href']) {
			 $variables['link_text'] = theme('image', array('path'=>path_to_theme().'/images/rate_comment.png'));
		  }	
	     break;
		case 'flagged_comments': 
		  $variables['link_html'] = 1;
		  if ($variables['link_href']) {
		    $variables['link_text'] = theme('image', array('path'=>path_to_theme().'/images/flag_comment.png'));
		  }
	     break;
  }
}


/**
 * Preprocesses the rendered tree for theme_menu_tree().
// */
//function agada_preprocess_menu_tree(&$variables) {
//  dpm($variables);
//}

//	/**
// * Returns HTML for a wrapper for a menu sub-tree.
// *
// * @param $variables
// *   An associative array containing:
// *   - tree: An HTML string containing the tree's items.
// *
// * @see template_preprocess_menu_tree()
// * @ingroup themeable
// */
//function agada_menu_tree($variables) {
//	dpm($variables);
//  return '<ul class="menu">' . $variables['tree'] . '</ul>';
//
//}
/**
 * Returns HTML for a set of links.
 *
 * @param $variables
 *   An associative array containing:
 *   - links: An associative array of links to be themed. The key for each link
 *     is used as its css class. Each link should be itself an array, with the
 *     following elements:
 *     - title: The link text.
 *     - href: The link URL. If omitted, the 'title' is shown as a plain text
 *       item in the links list.
 *     - html: (optional) Whether or not 'title' is HTML. If set, the title
 *       will not be passed through check_plain().
 *     - attributes: (optional) Attributes for the anchor, or for the <span> tag
 *       used in its place if no 'href' is supplied. If element 'class' is
 *       included, it must be an array of one or more class names.
 *     If the 'href' element is supplied, the entire link array is passed to l()
 *     as its $options parameter.
 *   - attributes: A keyed array of attributes for the UL containing the
 *     list of links.
 *   - heading: (optional) A heading to precede the links. May be an associative
 *     array or a string. If it's an array, it can have the following elements:
 *     - text: The heading text.
 *     - level: The heading level (e.g. 'h2', 'h3').
 *     - class: (optional) An array of the CSS classes for the heading.
 *     When using a string it will be used as the text of the heading and the
 *     level will default to 'h2'. Headings should be used on navigation menus
 *     and any list of links that consistently appears on multiple pages. To
 *     make the heading invisible use the 'element-invisible' CSS class. Do not
 *     use 'display:none', which removes it from screen-readers and assistive
 *     technology. Headings allow screen-reader and keyboard only users to
 *     navigate to or skip the links. See
 *     http://juicystudio.com/article/screen-readers-display-none.php and
 *     http://www.w3.org/TR/WCAG-TECHS/H42.html for more information.
 */
 /* agada version add the 'seperator' param */
function agada_links($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  global $language_url;
  $output = '';

  // addition: sort the links regarding to the weight , if exists
  if (is_array($links))
	  uasort($links, 'drupal_sort_weight');

  if (count($links) > 0) {
    $output = '';

    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading.
          'level' => 'h2',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array($key);

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
		
		$space = spaces_get_space();
	   if ($space && $space->term->name == "kids" ) {
			global $base_url;
			if (isset($link['href']) && $link['href'] == '<front>') {
			  $link['href'] = 'kids_frontpage';
			}
			else if (isset($link['href']) && ($link['href'] == $base_url.'/'.$space->term->name ||  $link['href'] == $space->term->name || strpos($link['href'], "kids_frontpage") !== FALSE)) {
			  $link['title'] = t('to adults');
			  $link['href'] = $base_url;
			}
		}

      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';
      
		$link['seperator'] = (isset($link['seperator'])) ? $link['seperator'] :'';
      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link) . $link['seperator'];
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>' .$link['seperator'];
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}


/*************** PAGER functions ****************/
/**
* these pager function represents the option of pages list and prev/next buttons
* the prev/next buttons are implemented with icons (html parameter is set to true).
*/


/**
 * Returns HTML for a query pager.
 *
 * Menu callbacks that display paged query results should call theme('pager') to
 * retrieve a pager control so that users can view other results. Format a list
 * of nearby pages with additional query results.
 *
 * @param $variables
 *   An associative array containing:
 *   - tags: An array of labels for the controls in the pager.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *   - quantity: The number of pages in the list.
 *
 * @ingroup themeable
 */
 /**
 * Returns HTML for a query pager.
 *
 * Menu callbacks that display paged query results should call theme('pager') to
 * retrieve a pager control so that users can view other results. Format a list
 * of nearby pages with additional query results.
 *
 * @param $variables
 *   An associative array containing:
 *   - tags: An array of labels for the controls in the pager.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *   - quantity: The number of pages in the list.
 *
 * @ingroup themeable
 */
function agada_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;

  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;

  // max is the maximum page number
  $pager_max = $pager_total[$element];

  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));
  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => array('pager-first'),
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('pager-current'),
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
        'class' => array('pager-last'),
        'data' => $li_last,
      );
    }
    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pager')),
    ));
  }
}


function agada_pager__comment($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.
	$prev_img = theme('image', array('path'=>path_to_theme().'/images/prev_arrow.png', 'alt' =>t('previous'), 'title' =>t('previous')));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : $prev_img), 'element' => $element, 'interval' => 1, 'parameters' => $parameters ,'html'=>1));
  
  $next_img = theme('image', array('path'=>path_to_theme().'/images/next_arrow.png', 'alt' =>t('next'), 'title' =>t('next')));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] :$next_img), 'element' => $element, 'interval' => 1, 'parameters' => $parameters ,'html'=>1));

  if ($pager_total[$element] > 1) {
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }
    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('pager-current'),
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }
    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pager')),
    ));
  }
}




/**
 * Returns HTML for the "previous page" link in a query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - interval: The number of pages to move backward when the link is clicked.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function agada_pager_previous($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  $html = (isset($variables['html'])) ? $variables['html'] : FALSE ; //agada addition in order to support image links

  global $pager_page_array;
  $output = '';

  // If we are anywhere but the first page
  if ($pager_page_array[$element] > 0) {
    $page_new = pager_load_array($pager_page_array[$element] - $interval, $element, $pager_page_array);
	 $output = theme('pager_link', array('text' => $text, 'page_new' => $page_new, 'element' => $element, 'parameters' => $parameters ,'html'=>$html));
  }

  return $output;
}

/**
 * Returns HTML for the "next page" link in a query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - interval: The number of pages to move forward when the link is clicked.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function agada_pager_next($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  $html = (isset($variables['html'])) ? $variables['html'] : FALSE ; //agada addition in order to support image links

  global $pager_page_array, $pager_total;
  $output = '';

  // If we are anywhere but the last page
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $page_new = pager_load_array($pager_page_array[$element] + $interval, $element, $pager_page_array);
	 $output = theme('pager_link', array('text' => $text, 'page_new' => $page_new, 'element' => $element, 'parameters' => $parameters,'html'=>$html));	  
  }

  return $output;
}

function agada_preprocess_search_result(&$variables) {
	$ITEMS_IN_PAGE = 10;
	static $result_counter;

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		if ($result_counter <= $ITEMS_IN_PAGE * $page) {
			$result_counter = $ITEMS_IN_PAGE * $page;
		}
	}
    $variables['result_counter'] = ++$result_counter;
}
/**
 * Returns HTML for a link to a specific query result page.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The link text. Also used to figure out the title attribute of the
 *     link, if it is not provided in $variables['attributes']['title']; in
 *     this case, $variables['text'] must be one of the standard pager link
 *     text strings that would be generated by the pager theme functions, such
 *     as a number or t('« first').
 *   - page_new: The first result to display on the linked page.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager link.
 *   - attributes: An associative array of HTML attributes to apply to the
 *     pager link.
 *
 * @see theme_pager()
 *
 * @ingroup themeable
 */
function agada_pager_link($variables) {
  $text = $variables['text'];
  $page_new = $variables['page_new'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = $variables['attributes'];
  $html = (isset($variables['html'])) ? $variables['html'] : FALSE ; //agada addition in order to support image links

  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = array();
  if (count($parameters)) {
    $query = drupal_get_query_parameters($parameters, array());
  }
  if ($query_pager = pager_get_query_parameters()) {
    $query = array_merge($query, $query_pager);
  }

  // Set each pager link title
  if (!isset($attributes['title'])) {
    static $titles = NULL;
    if (!isset($titles)) {
      $titles = array(
        t('« first') => t('Go to first page'),
        t('‹ previous') => t('Go to previous page'),
        t('next ›') => t('Go to next page'),
        t('last »') => t('Go to last page'),
      );
    }
    if (isset($titles[$text])) {
      $attributes['title'] = $titles[$text];
    }
    elseif (is_numeric($text)) {
      $attributes['title'] = t('Go to page @number', array('@number' => $text));
    }
  }

  return l($text, $_GET['q'], array('attributes' => $attributes, 'query' => $query, 'html'=>$html));
}


/*************** FORM ALTER functions ****************/

/* 
* implemetation of hook_form_FORM_ID_alter
*
*/
function agada_form_search_block_form_alter(&$form, &$form_state, $form_id) {
	unset($form['actions']['submit']['#value']);
}




/* 
* implemetation of hook_form_FORM_ID_alter
*
*/
function agada_form_comment_node_agada_story_form_alter(&$form, &$form_state, $form_id) {
	$form['subject']['#title_display_class'] = "same-line";
	$form['#prefix'] = '<h3>'.t('comments on').'</h3>';
	$form['author']['#type'] = 'hidden';

   unset($form['comment_body']['und'][0]['#title']);
	unset($form['field_comment_attachment']['und'][0]['#title']);

  $form["#action"] ="#a-comments-region";
//	if (isset($_GET['comment_type'])) {
//		$form['field_comment_type']['und']['#default_value'] = $_GET['comment_type'];
//	}
}


/**
 * Returns HTML for an individual file upload widget.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: A render element representing the widget.
 *
 * @ingroup themeable
 */
function agada_file_widget($variables) {
  $element = $variables['element'];
  $output = '';

  // agada addition. remove upload button from comments forms
  if ($element['#entity_type'] == 'comment') {
	  unset($element['upload_button']);
  }

  // The "form-managed-file" class is required for proper Ajax functionality.
  $output .= '<div class="file-widget form-managed-file clearfix">';
  if ($element['fid']['#value'] != 0) {
    // Add the file size after the file name.
    $element['filename']['#markup'] .= ' <span class="file-size">(' . format_size($element['#file']->filesize) . ')</span> ';
  }
  $output .= drupal_render_children($element);
  $output .= '</div>';

  return $output;
}




	/**
 * Theme function for a CAPTCHA element.
 *
 * Render it in a fieldset if a description of the CAPTCHA
 * is available. Render it as is otherwise.
 */
function agada_captcha($variables) {
  $element = $variables['element'];
  if (!empty($element['#description']) && isset($element['captcha_widgets'])) {
    $fieldset = array(
      '#type' => 'fieldset',
      '#title' => t('CAPTCHA'),
      '#description' => $element['#description'],
      '#children' => drupal_render_children($element),
      '#attributes' => array('class' => array('captcha')),
    );
    return theme('fieldset', array('element' => $fieldset));
  }
  else {
	 // agada addition. remove captcha description from all forms
    if (isset($element['captcha_widgets']) && isset($element['captcha_widgets']['captcha_response'])) {
		unset($element['captcha_widgets']['captcha_response']['#description']);
	 }
	 $title =  '<div class="captcha-title">' . t("User validation").  '</div>';
    return '<div class="captcha">' . $title . drupal_render_children($element) . '</div>';
  }
}



	/**
 * Returns HTML for a form element label and required marker.
 *
 * Form element labels include the #title and a #required marker. The label is
 * associated with the element itself by the element #id. Labels may appear
 * before or after elements, depending on theme_form_element() and #title_display.
 *
 * This function will not be called for elements with no labels, depending on
 * #title_display. For elements that have an empty #title and are not required,
 * this function will output no label (''). For required elements that have an
 * empty #title, this will output the required marker alone within the label.
 * The label will use the #id to associate the marker with the field that is
 * required. That is especially important for screenreader users to know
 * which field is required.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #required, #title, #id, #value, #description.
 *
 * @ingroup themeable
 */
function agada_form_element_label($variables) {
  $element = $variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // If title and required marker are both empty, output no label.
  if (empty($element['#title']) && empty($element['#required'])) {
    return '';
  }

  // If the element is required, a required marker is appended to the label.
  $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '';

  $title = filter_xss_admin($element['#title']);

  $attributes = array();
  // Style the label as class option to display inline with the element.
  if ($element['#title_display'] == 'after') {
    $attributes['class'] = 'option';
  }
  // Show label only to screen readers to avoid disruption in visual flows.
  elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'] = 'element-invisible';
  }

  // add suport for same-line option - AGADA ADDITION !!!!!!
  if (isset($element['#title_display_class']) && $element['#title_display_class'] == 'same-line') {
    $attributes['class'] = 'label-same-line';
  }

  if (!empty($element['#id'])) {
    $attributes['for'] = $element['#id'];
  }

  // The leading whitespace helps visually separate fields from inline labels.
  return ' <label' . drupal_attributes($attributes) . '>' . $t('!title !required', array('!title' => $title, '!required' => $required)) . "</label>\n";
}


/**
 * Returns HTML for help text based on file upload validators.
 *
 * @param $variables
 *   An associative array containing:
 *   - description: The normal description for this field, specified by the
 *     user.
 *   - upload_validators: An array of upload validators as used in
 *     $element['#upload_validators'].
 *
 * @ingroup themeable
 */
function agada_file_upload_help($variables) {
  $description = $variables['description'];
  $upload_validators = $variables['upload_validators'];

  $descriptions = array();

  if (strlen($description)) {
    $descriptions[] = $description;
  }
  if (isset($upload_validators['file_validate_size'])) {
    $descriptions[] = t('Files must be less than !size.', array('!size' => '<strong>' . format_size($upload_validators['file_validate_size'][0]) . '</strong>'));
  }
  if (isset($upload_validators['file_validate_extensions'])) {
    $descriptions[] = t('Allowed file types: !extensions.', array('!extensions' => '<strong>' . check_plain($upload_validators['file_validate_extensions'][0]) . '</strong>'));
  }
  if (isset($upload_validators['file_validate_image_resolution'])) {
    $max = $upload_validators['file_validate_image_resolution'][0];
    $min = $upload_validators['file_validate_image_resolution'][1];
    if ($min && $max && $min == $max) {
      $descriptions[] = t('Images must be exactly !size pixels.', array('!size' => '<strong>' . $max . '</strong>'));
    }
    elseif ($min && $max) {
      $descriptions[] = t('Images must be between !min and !max pixels.', array('!min' => '<strong>' . $min . '</strong>', '!max' => '<strong>' . $max . '</strong>'));
    }
    elseif ($min) {
      $descriptions[] = t('Images must be larger than !min pixels.', array('!min' => '<strong>' . $min . '</strong>'));
    }
    elseif ($max) {
      $descriptions[] = t('Images must be smaller than !max pixels.', array('!max' => '<strong>' . $max . '</strong>'));
    }
  }

  return implode(' | ', $descriptions);
}


/**
 * Returns HTML for a field.
 *
 * This is the default theme implementation to display the value of a field.
 * Theme developers who are comfortable with overriding theme functions may do
 * so in order to customize this markup. This function can be overridden with
 * varying levels of specificity. For example, for a field named 'body'
 * displayed on the 'article' content type, any of the following functions will
 * override this default implementation. The first of these functions that
 * exists is used:
 * - THEMENAME_field__body__article()
 * - THEMENAME_field__article()
 * - THEMENAME_field__body()
 * - THEMENAME_field()
 *
 * Theme developers who prefer to customize templates instead of overriding
 * functions may copy the "field.tpl.php" from the "modules/field/theme" folder
 * of the Drupal installation to somewhere within the theme's folder and
 * customize it, just like customizing other Drupal templates such as
 * page.tpl.php or node.tpl.php. However, it takes longer for the server to
 * process templates than to call a function, so for websites with many fields
 * displayed on a page, this can result in a noticeable slowdown of the website.
 * For these websites, developers are discouraged from placing a field.tpl.php
 * file into the theme's folder, but may customize templates for specific
 * fields. For example, for a field named 'body' displayed on the 'article'
 * content type, any of the following templates will override this default
 * implementation. The first of these templates that exists is used:
 * - field--body--article.tpl.php
 * - field--article.tpl.php
 * - field--body.tpl.php
 * - field.tpl.php
 * So, if the body field on the article content type needs customization, a
 * field--body--article.tpl.php file can be added within the theme's folder.
 * Because it's a template, it will result in slightly more time needed to
 * display that field, but it will not impact other fields, and therefore,
 * is unlikely to cause a noticeable change in website performance. A very rough
 * guideline is that if a page is being displayed with more than 100 fields and
 * they are all themed with a template instead of a function, it can add up to
 * 5% to the time it takes to display that page. This is a guideline only and
 * the exact performance impact depends on the server configuration and the
 * details of the website.
 *
 * @param $variables
 *   An associative array containing:
 *   - label_hidden: A boolean indicating to show or hide the field label.
 *   - title_attributes: A string containing the attributes for the title.
 *   - label: The label for the field.
 *   - content_attributes: A string containing the attributes for the content's
 *     div.
 *   - items: An array of field items.
 *   - item_attributes: An array of attributes for each item.
 *   - classes: A string containing the classes for the wrapping div.
 *   - attributes: A string containing the attributes for the wrapping div.
 *
 * @see template_preprocess_field()
 * @see template_process_field()
 * @see field.tpl.php
 *
 * @ingroup themeable
 */
function agada_field__field_agada_image($variables) {
  $output = '';

  foreach ($variables['items'] as $delta => $item) {
	 if (isset( $item['#markup'] )) {
		 $item['#markup']= preg_replace('/<p>(.*)<\/p>/',"$1", $item['#markup']); // remove p from internal fields
	 }
    $output .= drupal_render($item) ;
  }

  return $output;
}


function agada_field__field_comment_type($variables) {
  $output = '';

  foreach ($variables['items'] as $delta => $item) {
    $output .= drupal_render($item) ;
  }

  return $output;
}

function agada_field__field_children_version($variables) {
  $output = '';

  foreach ($variables['items'] as $delta => $item) {
    $output .= drupal_render($item) ;
  }

  return $output;
}

//function agada_field__body__agada_story($variables) {
//  $output = '';
//
//  foreach ($variables['items'] as $delta => $item) {
//    $output .=  drupal_render($item) ;
//  }
//
//  // Render the top-level DIV.
//  $output = '<div class="agada-story-body">'. $output."</div>";
//
//  return $output;
//}

function agada_field__field_agada_tags__agada_children_story($variables) {
	return(agada_field__field_agada_tags__agada_story($variables));
}

function agada_field__field_agada_tags__agada_story($variables) {
  $output_arr = array();
  foreach ($variables['items'] as $delta => $item) {
    array_push($output_arr ,drupal_render($item));
  }
  $output= implode(', ',$output_arr);
  return $output;
}


function agada_field__field_gada_categories__agada_children_story($variables) {
	return(agada_field__field_gada_categories__agada_story($variables));
}
function agada_field__field_gada_categories__agada_story($variables) {
  $output_arr = array();
  foreach ($variables['items'] as $delta => $item) {
    array_push($output_arr ,drupal_render($item));
  }
  $output= implode(', ',$output_arr);
  return $output;
}

function agada_keywords() {
	return ' אדה, ספר האגדה, חיים נחמן ביאליק, יהושע חנא רבניצקי, אביגדור שנאן, קרן אבי חי, סנונית, עמותת סנונית, חז"ל, סיפורי חז"ל, משנה, תלמוד, מדרש, מדרשים, מדרש אגדה, סיפורים לילדים, סיפורי חז"ל לילדים,Agada, midrash, mishna, Talmud, sages, avi chai, stories';
}

function agada_description() {
	return 'אתר ספר האגדה מעמיד לרשות הגולשים מבחר רחב של סיפורי חז"ל הלקוחים מתוך ספר האגדה, כבסיס לדיון תרבותי שיתופי. סיפורי חז"ל מלווים בפרשנות חדשה, בכלי עזר, בהפניה ליצירות קשורות, ובכלי קיטלוג ואחזור מתקדמים. המאגר כולל כשש-מאות סיפורים, מתוכם כ-70 סיפורים מעובדים במיוחד לילדים. הגולשים מוזמנים לתרום תגובות, עיבודים ופירושים משלהם לסיפורים. האתר הוא פרי שיתוף פעולה בין קרן אבי חי לעמותת סנונית לקידום החינוך המתוקשב. ';
}


function agada_preprocess_user_profile(&$variables) {
  $account = $variables['elements']['#account'];
  $variables['user_profile']['name'] ['#title'] = t("Username").":";
  $variables['user_profile']['name'] ['#markup'] = $account->name;
  $variables['user_profile']['name'] ['#type'] = "user_profile_item";
}


function agada_preprocess_print(&$variables) {
	$type_logo = (isset($variables['node']->type)) ? $variables['node']->type."_logo" : '';
	$variables['node_type'] = $type_logo;
}




/**
 * Returns text at wanted length.
 *
 * params:
 *   $string - tiny text that you want to get shorter.
 *   $maxLength - the wanted length for the shorter text.
 *
 */
function short_text($string, $maxLength) {
	$short_body = preg_replace('/<(.*?)>/i', '', $string); 
	$short_body = preg_replace('/&nbsp;/i', ' ', $short_body);
	$short_body = preg_replace('/&quot;/i', '"', $short_body);
	$short_body = preg_replace('/&#39;/i', '\'', $short_body);
	$short_body = preg_replace('/&ndash;/i', '-',$short_body);
	
	$short_body = substr($short_body, 0, $maxLength);
	$pos = strrpos($short_body, ' ');
	$short_body = substr($short_body, 0, $pos);

	return($short_body);
}

function clear_text($text) {
	$arr = array('ָ', 'ַ', 'ֵ', 'ֶ', 'ִ', 'ְ', 'ֹ', 'ֻ', 'ֲ', 'ֳ', 'ֱ', 'ּ', 'ׁ', 'ׂ');
	foreach ($arr as &$c) {
		$text = preg_replace("/$c/", '', $text);
	}
	return($text);
}