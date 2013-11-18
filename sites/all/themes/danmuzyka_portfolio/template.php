<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function danmuzyka_portfolio_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  danmuzyka_portfolio_preprocess_html($variables, $hook);
  danmuzyka_portfolio_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function danmuzyka_portfolio_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function danmuzyka_portfolio_preprocess_page(&$variables, $hook) {
  $header_classes = array();
  if ($variables['logo']) {
    $header_classes[] = 'with-logo';
  }
  if ($variables['site_name']) {
    $header_classes[] = 'with-site-name';
  }
  $variables['header_classes'] = !empty($header_classes) ? ' ' . implode($header_classes, ' ') : '';

  // Control breadcrumbs for taxonomy terms
  if (in_array('page__taxonomy', $variables['theme_hook_suggestions'])) {
    $term = menu_get_object('taxonomy_term', 2);
    if ($term->vocabulary_machine_name === 'skills') {
      $current = (object) array(
        'tid' => $term->tid,
      );
      $breadcrumb = array();
      while ($parents = taxonomy_get_parents($current->tid)) {
        $current = array_shift($parents);
        $breadcrumb[] = l($current->name, 'taxonomy/term/' . $current->tid);
      }
      array_pop($breadcrumb);
      $breadcrumb[] = l(t('Skills'), 'skills');
      $breadcrumb[] = l(t('Home'), NULL);
      $breadcrumb = array_reverse($breadcrumb);
      drupal_set_breadcrumb($breadcrumb);
    }
  }

  $breadcrumb = drupal_get_breadcrumb();
  if (count($breadcrumb) > 1) {
    $variables['section_name'] = strip_tags($breadcrumb[1]);
  }
  else {
    $variables['section_name'] = drupal_get_title();
  }

}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function danmuzyka_portfolio_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // danmuzyka_portfolio_preprocess_node_page() or danmuzyka_portfolio_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function danmuzyka_portfolio_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function danmuzyka_portfolio_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function danmuzyka_portfolio_preprocess_block(&$variables, $hook) {
  if ($variables['block']->delta === 'skills-block_1') {
    $variables['classes_array'][] = 'block-skills';
  }
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
/**
 * Override or insert variables into the field templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("field" in this case.)
 */
function danmuzyka_portfolio_preprocess_field(&$variables, $hook) {
  //dpm($variables, 'variables');
  //$variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
}

/**
 * Override theme_field() for skills field.
 */
function danmuzyka_portfolio_field__field_skills($variables) {
  $output = '';
  $final_iteration = count($variables['items']) - 1;

  if ($variables['element']['#label_display'] == 'inline') {
    $output .= '<span class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':</span>';
  }
  elseif ($variables['element']['#label_display'] == 'above') {
    $output .= '<h3 class="field-label"' . $title_attributes . '>' . $label . '</h3>';
  }

  // Render the items.
  foreach ($variables['items'] as $delta => $item) {
    $classes = 'field-item ';
    $output .= '<span class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</span>';
    if ($delta < $final_iteration) {
      $output .= ', ';
    }
  }

  // Remove any classes for 'inline'
  foreach ($variables['classes_array'] as $index => $class) {
    if (strpos($class, 'inline') !== FALSE) {
      unset($variables['classes_array'][$index]);
    }
  }
  $variables['classes_array'] = array_values($variables['classes_array']);
  $variables['classes'] = implode($variables['classes_array'], ' ');

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}

/**
 * Modify the skills view block.
 */
function danmuzyka_portfolio_preprocess_views_view_unformatted(&$variables, $hook) {
  if (($variables['view']->name === 'skills') && ($variables['view']->current_display === 'block_1')) {
    $final_iteration = count($variables['rows']) - 1;
    $count = 0;
    foreach ($variables['rows'] as $id => $row) {
      if ($count < $final_iteration) {
        $variables['rows'][$id] = trim($row) . ', ';
      }
      $count++;
    }
  }
}
// */
