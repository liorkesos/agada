<?php
/**
 * @file
 * Zen theme's implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   - view-mode-[mode]: The view mode, e.g. 'full', 'teaser'...
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content. Currently broken; see http://drupal.org/node/823380
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess_node()
 * @see template_process()
 */
?>
<?php if ($page): ?>
	<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

		<?php if ($unpublished): ?>
			<div class="unpublished"><?php print t('Unpublished'); ?></div>
		<?php endif; ?>

		<!--Tabs -->
		<div id="content_tabs">
				<div id="all_story" class="active_story_type">עיבוד מחודש</div>
				<?php if (isset($agada_story_nid)): ?>
					<?php 
						global $base_url;
						$adults_url = $base_url."/node/".$agada_story_nid;
					?>
					<div id="original_story"><a href="<?php print $adults_url; ?>">ספר האגדה</a></div>
					
				<?php endif;?>
		</div>  
		<!--End of Tabs -->
		<div class="field-name-field-sound">לשמיעת הסיפור:</div>
		<?php print render($content['field_sound']);?>
		<div class="content"<?php print $content_attributes; ?>>
		<?php
		  // We hide the comments and links now so that we can render them later.
		  hide($content['comments']);
		  hide($content['links']);
		?>
		<?php
		  $rendered_content = '<div class="small_title">'.render($content['field_vocalized_title']).'</div>'.render($content['field_processor_name']);
			if (isset($content['field_agada_in_courtesy_of'])) {
				$rendered_content .= "<br />".render($content['field_agada_in_courtesy_of']);
			}
			$rendered_content .= render($content['field_agada_image']).render($content['body']);  
			$rendered_content = preg_replace('/\"/',' &quot;',$rendered_content); 
//			$rendered_original = render($agada_story_body);
//			$rendered_original = preg_replace('/\"/',' &quot;',$rendered_original);
			
		?>
		<input type="hidden" id="all_story_hidden_content" value="<?php print $rendered_content; ?>" />

		<div id="green_box">
			<div id="white_box">
				<div class="list">
					<div class="small_title"> <?php print render($content['field_vocalized_title']); ?> </div>
					<?php 
						print render($content['field_processor_name']);
						if (isset($content['field_agada_in_courtesy_of'])) {
							print "<br />";
							print render($content['field_agada_in_courtesy_of']);
						}
						print render($content['field_agada_image']);
						print render($content['body']);		
					?>

					<div class="clear"></div>
				</div>
			</div>
		</div> <!-- /.green_box -->
		<div id="comment_title">
			<p><?php print t('new comment title'); ?></p>
		</div>
	</div>

	<div id="meta_keywords">
		<div>
			 <span>תגיות:</span>
			 <?php print render($content['field_gada_categories']);?>
			 <?php if (isset($content['field_agada_tags']) && sizeof($content['field_agada_tags'])) :  ?>
				<?php print ", ".render($content['field_agada_tags']); ?>
			 <?php endif; ?>
		</div> 
	</div>

	</div><!-- /.node -->
	<?php 
		hide($content['links']['comment'] ); 
		print render($content['links']); 
//		if ($logged_in) {
//			print render($content['field_agada_fivestars']); 
//	   }
	?>

<!-- case of teaser display -->
<?php else: ?>
	<div class="taxonomy-term"> 
	
		<div class="taxonomy-term-right">
			<?php
				if (isset($content['field_icon'])) {
						print render($content['field_icon']);
				}
				else {
					print "<a href=''><img src='/sites/all/themes/agada/images/term_pic.png'alt='' title='' /></a>";
				}
			?> 		
		</div>
		
		<div class="taxonomy-term-left">    
			<?php print render($title_prefix); ?>
			<?php if (!$page && $title): ?>
				<h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
			<?php endif; ?>
			<?php print render($title_suffix); ?>
			<?php 
				$short_body = short_text(render($content['body']), 400);
			?>
			<p><?php print render($short_body); ?>...</p>

			<div class="taxonomy-term-tags"><span>תגיות נוספות:</span>: <?php print render($content['field_gada_categories']); ?>
				<?php if (isset($content['field_agada_tags']) && sizeof($content['field_agada_tags'])) :  ?>
					<?php print ", ".render($content['field_agada_tags']); ?>
				<?php endif; ?>
			</div>

			<div class="taxonomy-term-details">
				<?php if (isset($content['field_original_version'])) : ?>
					<img src="/sites/all/themes/agada/images/figure_icon.png" alt="קיימת גרסה למבוגרים" title="קיימת גרסה למבוגרים"/>
				<?php endif; ?>
				<!--<img src="/sites/all/themes/agada/images/like_icon.png" alt="דירוג" title="דירוג"/> 
				<span><?php print render($content['field_agada_fivestars']);?></span>-->
				<img src="/sites/all/themes/agada/images/comment_icon.png" alt="תגובות" title="תגובות"/>
				<span><?php print $comment_count;?></span>
				<a href="/node/<?php print $node->nid;?>">כניסה</a> 
			</div>    	
		</div>

	</div>
<?php endif; ?>

	



