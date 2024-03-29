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
 kids\/node\/$nid
 */
?>

<a href="node/<?php print $fields['nid']->raw; ?>" ><?php print $fields['field_agada_image']->content;?> </a>
<h2><?php print $fields['title']->content; ?></h2>

<div id="most-view-contents">
	<!--<div id="most-view-contents-like">
		<img src="../sites/all/themes/agada/images/like_icon.png" />
		<span><?php //print $fields['field_agada_fivestars']->content;?></span>
	</div>-->
	<div  id="most-view-contents-comment">
		<img src="../sites/all/themes/agada/images/comment_icon.png" />
		<span><?php print $fields['comment_count']->content;?></span>
	</div>
</div>

<!--<?php foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    <?php print $field->content; //dpm($id);?>
  <?php print $field->wrapper_suffix; ?>
<?php endforeach; ?>
-->