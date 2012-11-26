<?php

/**
 * @file
 * Provides support for the Views module.
 */

/**
 * Implementation of hook_views_default_views().
 */
function custom_agada_views_default_views() {


$view = new view;
$view->name = 'comments_by_type';
$view->description = 'רשימת תגובות ממוינות לפי סוג';
$view->tag = 'comment';
$view->base_table = 'comment';
$view->human_name = 'comments_by_type';
$view->core = 7;
$view->api_version = '3.0-alpha1';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['title'] = 'comments_by_type';
$handler->display->display_options['use_ajax'] = TRUE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['query']['options']['query_comment'] = FALSE;
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'איתחול';
$handler->display->display_options['pager']['type'] = 'full';
$handler->display->display_options['pager']['options']['items_per_page'] = '5';
$handler->display->display_options['style_plugin'] = 'default';
$handler->display->display_options['row_plugin'] = 'comment';
/* Relationship: תגובה: תוכן */
$handler->display->display_options['relationships']['nid']['id'] = 'nid';
$handler->display->display_options['relationships']['nid']['table'] = 'comment';
$handler->display->display_options['relationships']['nid']['field'] = 'nid';
$handler->display->display_options['relationships']['nid']['required'] = 1;
/* שדה: תגובה: כותרת */
$handler->display->display_options['fields']['subject']['id'] = 'subject';
$handler->display->display_options['fields']['subject']['table'] = 'comment';
$handler->display->display_options['fields']['subject']['field'] = 'subject';
$handler->display->display_options['fields']['subject']['label'] = '';
$handler->display->display_options['fields']['subject']['alter']['alter_text'] = 0;
$handler->display->display_options['fields']['subject']['alter']['make_link'] = 0;
$handler->display->display_options['fields']['subject']['alter']['absolute'] = 0;
$handler->display->display_options['fields']['subject']['alter']['word_boundary'] = 0;
$handler->display->display_options['fields']['subject']['alter']['ellipsis'] = 0;
$handler->display->display_options['fields']['subject']['alter']['strip_tags'] = 0;
$handler->display->display_options['fields']['subject']['alter']['trim'] = 0;
$handler->display->display_options['fields']['subject']['alter']['html'] = 0;
$handler->display->display_options['fields']['subject']['hide_empty'] = 0;
$handler->display->display_options['fields']['subject']['empty_zero'] = 0;
$handler->display->display_options['fields']['subject']['link_to_comment'] = 1;
/* Sort criterion: תגובה: Post date */
$handler->display->display_options['sorts']['created']['id'] = 'created';
$handler->display->display_options['sorts']['created']['table'] = 'comment';
$handler->display->display_options['sorts']['created']['field'] = 'created';
$handler->display->display_options['sorts']['created']['order'] = 'DESC';
/* Contextual filter: תגובה: סוג התגובה (field_comment_type) */
$handler->display->display_options['arguments']['field_comment_type_value']['id'] = 'field_comment_type_value';
$handler->display->display_options['arguments']['field_comment_type_value']['table'] = 'field_data_field_comment_type';
$handler->display->display_options['arguments']['field_comment_type_value']['field'] = 'field_comment_type_value';
$handler->display->display_options['arguments']['field_comment_type_value']['default_action'] = 'default';
$handler->display->display_options['arguments']['field_comment_type_value']['default_argument_type'] = 'fixed';
$handler->display->display_options['arguments']['field_comment_type_value']['default_argument_options']['argument'] = '1';
$handler->display->display_options['arguments']['field_comment_type_value']['default_argument_skip_url'] = 0;
$handler->display->display_options['arguments']['field_comment_type_value']['summary']['number_of_records'] = '0';
$handler->display->display_options['arguments']['field_comment_type_value']['summary']['format'] = 'default_summary';
$handler->display->display_options['arguments']['field_comment_type_value']['summary_options']['items_per_page'] = '25';
$handler->display->display_options['arguments']['field_comment_type_value']['glossary'] = 0;
$handler->display->display_options['arguments']['field_comment_type_value']['limit'] = '0';
$handler->display->display_options['arguments']['field_comment_type_value']['transform_dash'] = 0;
$handler->display->display_options['arguments']['field_comment_type_value']['break_phrase'] = 0;
/* Filter criterion: תגובה: Approved */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'comment';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 0;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: תוכן: מפורסם */
$handler->display->display_options['filters']['status_node']['id'] = 'status_node';
$handler->display->display_options['filters']['status_node']['table'] = 'node';
$handler->display->display_options['filters']['status_node']['field'] = 'status';
$handler->display->display_options['filters']['status_node']['relationship'] = 'nid';
$handler->display->display_options['filters']['status_node']['value'] = 1;
$handler->display->display_options['filters']['status_node']['group'] = 0;
$handler->display->display_options['filters']['status_node']['expose']['operator'] = FALSE;

/* Display: Block */
$handler = $view->new_display('block', 'Block', 'block');
$translatables['comments_by_type'] = array(
  t('Master'),
  t('comments_by_type'),
  t('more'),
  t('Apply'),
  t('איתחול'),
  t('Sort by'),
  t('Asc'),
  t('Desc'),
  t('Items per page'),
  t('- All -'),
  t('Offset'),
  t('תוכן'),
  t('הכל'),
  t('Block'),
);

  $views[$view->name] = $view;

  return $views;




//
//  // Set up properties that are used for both views.
//  $fields = array(
//    'type' => array(
//      'id' => 'type',
//      'table' => 'node',
//      'field' => 'type',
//      'label' => 'Type',
//    ),
//    'title' => array(
//      'id' => 'title',
//      'table' => 'node',
//      'field' => 'title',
//      'label' => 'Title',
//      'link_to_node' => 1,
//    ),
//    'name' => array(
//      'label' => 'Author',
//      'link_to_user' => 1,
//      'id' => 'name',
//      'table' => 'users',
//      'field' => 'name',
//      'relationship' => 'uid_1',
//    ),
//  );
//
//  $style_options = array(
//    'grouping' => '',
//    'override' => 0,
//    'sticky' => 1,
//    'columns' => array(),
//    'default' => 'title',
//    'order' => 'asc',
//    'columns' => array(
//      'type' => 'type',
//      'title' => 'title',
//      'name' => 'name',
//    ),
//    'info' => array(
//      'type' => array(
//        'sortable' => TRUE,
//      ),
//      'title' => array(
//        'sortable' => TRUE,
//      ),
//      'name' => array(
//        'sortable' => TRUE,
//      ),
//    ),
//    'override' => FALSE,
//    'order' => 'asc',
//  );
//
//  $filters = array(
//    'status' => array(
//      'operator' => '=',
//      'value' => 1,
//      'group' => '0',
//      'exposed' => FALSE,
//      'expose' => array(
//        'operator' => FALSE,
//        'label' => '',
//      ),
//      'id' => 'status',
//      'table' => 'node',
//      'field' => 'status',
//      'relationship' => 'none',
//    ),
//  );
//
//  $relationships = array(
//    'flag_content_rel' => array(
//      'label' => 'bookmarks',
//      'required' => 1,
//      'flag' => 'bookmarks',
//      'user_scope' => 'current',
//      'id' => 'flag_content_rel',
//      'table' => 'node',
//      'field' => 'flag_content_rel',
//      'relationship' => 'none',
//      'override' => array(
//        'button' => 'Override',
//      ),
//    ),
//    'uid_1' => array(
//      'label' => 'author',
//      'required' => 0,
//      'id' => 'uid_1',
//      'table' => 'node',
//      'field' => 'uid',
//    ),
//  );
//
//  $access = array(
//    'type' => 'role',
//    'role' => drupal_map_assoc($flag->roles['flag']),
//    'perm' => '',
//  );
//
//  // Additional fields and style options if comment exists.
//  if (module_exists('comment')) {
//    $fields += array(
//      'comment_count' => array(
//        'id' => 'comment_count',
//        'table' => 'node_comment_statistics',
//        'field' => 'comment_count',
//        'label' => 'Replies',
//      ),
//      'last_comment_timestamp' => array(
//        'id' => 'last_comment_timestamp',
//        'table' => 'node_comment_statistics',
//        'field' => 'last_comment_timestamp',
//        'label' => 'Last Post',
//      ),
//    );
//
//    $style_options['default'] = 'last_comment_timestamp';
//    $style_options['order'] = 'desc';
//    $style_options['info'] += array(
//      'comment_count' => array(
//        'sortable' => TRUE,
//      ),
//      'last_comment_timestamp' => array(
//        'sortable' => TRUE,
//      ),
//    );
//    $style_options['columns'] += array(
//      'comment_count' => 'comment_count',
//      'last_comment_timestamp' => 'last_comment_timestamp',
//    );
//  }
//
//  $views = array();
//
//  /* Individual users user/%/bookmarks tab. */
//
//  // Additional relationship for this view.
//  $relationships_tab = $relationships;
//  $relationships_tab['flag_content_rel']['user_scope'] = 'any';
//  $relationships_tab += array(
//    'uid' => array(
//      'label' => 'bookmarks_user',
//      'required' => 1,
//      'id' => 'uid',
//      'table' => 'flag_content',
//      'field' => 'uid',
//      'relationship' => 'flag_content_rel',
//    ),
//  );
//
//  // Additional argument for this view.
//  $arguments_tab = array(
//    'uid' => array(
//      'default_action' => 'empty',
//      'style_plugin' => 'default_summary',
//      'style_options' => array(),
//      'wildcard' => 'all',
//      'wildcard_substitution' => 'All',
//      'title' => '%1\'s bookmarks',
//      'default_argument_type' => 'fixed',
//      'default_argument' => '',
//      'validate_type' => 'none',
//      'validate_fail' => 'not found',
//      'break_phrase' => 0,
//      'not' => 0,
//      'id' => 'uid',
//      'table' => 'users',
//      'field' => 'uid',
//      'override' => array(
//        'button' => 'Override',
//      ),
//      'relationship' => 'uid',
//      'default_options_div_prefix' => '',
//      'default_argument_user' => 0,
//      'default_argument_fixed' => '',
//      'default_argument_php' => '',
//    ),
//  );
//
//  $view = new view;
//  $view->name = 'flag_bookmarks_tab';
//  $view->description = 'Provides a tab on all user\'s profile pages containing bookmarks for that user.';
//  $view->tag = 'flag';
//  $view->view_php = '';
//  $view->base_table = 'node';
//  $view->is_cacheable = FALSE;
//  $view->api_version = 2;
//  $view->disabled = FALSE;
//  $handler = $view->new_display('default', 'Defaults', 'default');
//  $handler->override_option('relationships', $relationships_tab);
//  $handler->override_option('fields', $fields);
//  $handler->override_option('arguments', $arguments_tab);
//  $handler->override_option('filters', $filters);
//  $handler->override_option('access', $access);
//  $handler->override_option('title', 'User bookmarks');
//  $handler->override_option('empty', 'This user has not yet bookmarked any content.');
//  $handler->override_option('empty_format', filter_fallback_format());
//  $handler->override_option('items_per_page', '25');
//  $handler->override_option('use_pager', TRUE);
//  $handler->override_option('style_plugin', 'table');
//  $handler->override_option('style_options', $style_options);
//
//  $handler = $view->new_display('page', 'Page', 'page');
//  $handler->override_option('path', 'user/%/bookmarks');
//  $handler->override_option('menu', array(
//    'type' => 'tab',
//    'title' => 'Bookmarks',
//    'weight' => '0',
//    'name' => 'navigation',
//  ));
//  $handler->override_option('tab_options', array(
//    'type' => 'none',
//    'title' => NULL,
//    'weight' => NULL,
//  ));
//
//  $views[$view->name] = $view;
//
//  /* User bookmarks page with Ops. */
//
//  // Add some unique options for this view.
//  $style_options['columns'] += array('ops' => 'ops');
//  $fields += array(
//    'ops' => array(
//      'label' => 'Ops',
//      'id' => 'ops',
//      'table' => 'flag_content',
//      'field' => 'ops',
//      'relationship' => 'flag_content_rel',
//    ),
//  );
//
//  $view = new view;
//  $view->name = 'flag_'. $flag->name;
//  $view->description = 'A page listing the current user\'s bookmarks at /bookmarks.';
//  $view->tag = 'flag';
//  $view->view_php = '';
//  $view->base_table = 'node';
//  $view->is_cacheable = '0';
//  $view->api_version = 2;
//  $view->disabled = FALSE;
//  $handler = $view->new_display('default', 'Defaults', 'default');
//  $handler->override_option('relationships', $relationships);
//  $handler->override_option('fields', $fields);
//  $handler->override_option('filters', $filters);
//  $handler->override_option('access', $access);
//  $handler->override_option('title', t('My bookmarks'));
//  $handler->override_option('items_per_page', '25');
//  $handler->override_option('use_pager', TRUE);
//  $handler->override_option('empty', 'You have not yet bookmarked any content. Click the "'. $flag->flag_short .'" link when viewing a piece of content to add it to this list.');
//  $handler->override_option('empty_format', filter_fallback_format());
//  $handler->override_option('style_plugin', 'table');
//  $handler->override_option('style_options', $style_options);
//  $handler = $view->new_display('page', 'Page', 'page');
//  $handler->override_option('path', 'bookmarks');
//  $handler->override_option('menu', array(
//    'type' => 'normal',
//    'title' => t('My bookmarks'),
//    'weight' => '0',
//  ));
//  $handler->override_option('tab_options', array(
//    'type' => 'none',
//    'title' => NULL,
//    'weight' => NULL,
//  ));
//
//  $views[$view->name] = $view;
//
//  return $views;
}
