<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 *
 * $category_image - comes from custom_agada_preprocess_views_view_fields().
 */
?>
<?php if (preg_match('/\D1\D/', $fields['counter']->content)) :?><h2 class="page-visitors-page-right-title blue">הסיפורים הנקראים</h2>
<?php endif; ?>

<div class="taxonomy-term">
  <div class="content">              
	<div class="taxonomy-term-right">
		<?php  
			if (isset($fields['field_agada_foursquare_image'])) {print $fields['field_agada_foursquare_image']->content;} 
			else {
				print "<a href='$category_image'><img src='$category_image' alt='' title='' /></a>";
			}
		?>
	</div>
	
	<div class="taxonomy-term-left">    
		<h2><?php print $fields['title']->content; ?></h2>
		<div id="left-taxonomy"><p><?php print short_text($fields['body']->content, 200); ?></p></div>

		<div class="taxonomy-term-tags"><span>תגיות</span>: <?php print $fields['field_gada_categories']->content; ?>
		<?php if (isset($fields['field_agada_tags']->content) && sizeof($fields['field_agada_tags']->content)) :  ?>
			<?php print ", ".$fields['field_agada_tags']->content;?>
		<?php endif; ?>

		</div>
		<div class="taxonomy-term-details">
			<img src="/sites/all/themes/agada/images/figure_icon.png" />
			<img src="/sites/all/themes/agada/images/figure_icon.png" /> 
			<img src="/sites/all/themes/agada/images/like_icon.png" /> 
			<!-- <span><?php //print $fields['field_agada_fivestars']->content;?></span> -->
			<img src="/sites/all/themes/agada/images/comment_icon.png" />
			<span><?php print $fields['comment_count']->content; ?></span>
			<div id="enterbtn"><?php print $fields['view_node']->content;?></div>
		</div>    	
	</div>
  </div>    
</div>
<!--
<?php foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    <?php print $field->content; //dpm($id);?>
  <?php print $field->wrapper_suffix; ?>
<?php endforeach; ?>
-->