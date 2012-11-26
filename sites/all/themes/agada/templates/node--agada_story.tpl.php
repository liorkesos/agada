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
 *
 * Our additions:
 * - $category_image: created in agade_preproccess_node, contein the image of the first category with image.
 */
 if (!defined('EXTENDED_VERSION')) {
	 define ("EXTENDED_VERSION", 2);
 }
?>
<?php if (isset($commment)) ?>
<?php if ($page): ?>
	<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

	<?php print render($title_prefix); ?>
	<?php if (!$page && $title): ?>
	<h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
	<?php endif; ?>
	<?php print render($title_suffix); ?>

	<?php if ($unpublished): ?>
	<div class="unpublished"><?php print t('Unpublished'); ?></div>
	<?php endif; ?>

	<!--Tabs -->
	<div id="content_tabs">
			<div id="all_story" class="active_story_type">ספר האגדה</div>
			<?php  if (isset($content['group_agada_content']['field_children_version'])) : ?>
			   <?php 
			     global $base_url;
					$kids_url = 	$base_url."/kids".render($content['group_agada_content']['field_children_version']);
				?>
				<div id="children_story"><a href="<?php print $kids_url; ?>">עיבוד לילדים</a></div>
			<?php endif; ?>
			<?php if ($field_type[0]['value'] == EXTENDED_VERSION) : ?>
				<div id="about_story">על הסיפור</div>
			<?php endif; ?>
	</div>  
	<!--End of Tabs -->
	
	<div class="content"<?php print $content_attributes; ?>>
		<?php
		  // We hide the comments and links now so that we can render them later.
		  hide($content['comments']);
		  hide($content['links']);
			?>
		
		<?php 
			$rendered_content = render($content['group_agada_content']['body']);  
			$rendered_content = preg_replace('/\"/',' &quot;',$rendered_content); 
			$about_content = render($content['field_write_name']).render($content['group_agada_content']['field_about_story']);  
			$about_content = preg_replace('/\"/',' &quot;',$about_content); 
		 ?>
		 <?php
			 $extended_class='basic-story';
			 if (isset($content['group_agada_content']['field_agada_image']) && $field_type[0]['value'] == EXTENDED_VERSION) {
				         $extended_class = "expanded-story";
							$rendered_content='<div class="small_title">'.$title.'</div>'.
							render($content['group_agada_content']['field_agada_image']);
			} else {				
							$rendered_content= '<div class="small_title_wide"> '.$title.'</div>'; 
			}				

			$resources = render($content['field_agada_resources_open']);
			$resources = preg_replace('/<\/p>\s*<p>/', ' | ' ,$resources);

			$rendered_content .= '<div class="resources"><div class="resources_title"><p>מקורות הסיפור:</p></div>'.$resources.'</div>'.render($content['group_agada_content']['body']);	
			$rendered_content = preg_replace('/\"/',' &quot;',$rendered_content); 
			?>
		 <input type="hidden" id="all_story_hidden_content" value="<?php print $rendered_content; ?>" />
		 <input type="hidden" id="children_story_hidden_content" value="" />
		 <input type="hidden" id="about_story_hidden_content" value="<?php print $about_content; ?>" />
			

		 <div id="green_box" class="<?php print $extended_class; ?>">
			<div id="white_box">
				<div class="list">
					<?php if (isset($content['group_agada_content']['field_agada_image']) && $field_type[0]['value'] == EXTENDED_VERSION) : ?> 
							<div class="small_title"> <?php print $title; ?> </div>
							<?php
								//unset($content['group_agada_content']['field_agada_image']['#prefix']);
								//unset($content['group_agada_content']['field_agada_image']['#suffix']);
							 	print render($content['group_agada_content']['field_agada_image']);
							?>
							
						<?php else: ?> 
							<div class="small_title_wide"> <?php print $title; ?></div> 
						<?php endif; ?>
						
						<div class="resources">
						<?php print "<div class='resources_title'><p>מקורות הסיפור:</p></div>".$resources;?>
						</div>
					
						<?php print render($content['group_agada_content']['body']); ?>
					<div class="clear"></div>
				</div>
			</div>
		 </div>
	</div>
	 <?php 
		hide($content['links']['comment'] ); 
		print render($content['links']); 
//		if ($logged_in) {
//			print render($content['field_agada_fivestars']); 
//		}	
	?> 
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
	
<!-- Teaser display --->
<?php else: ?> 
	<div class="taxonomy-term"> 
	
		<div class="taxonomy-term-right">
			<?php 
				if (isset($content['group_agada_content']['field_agada_foursquare_image'])) {
						print render($content['group_agada_content']['field_agada_foursquare_image']);
				}
				else {
					print "<a href='$category_image'><img src='$category_image' alt='' title='' /></a>";
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
				$short_body = short_text(render($content['group_agada_content']['body']), 400);
			?>
			<p><?php print render($short_body); ?>...</p>

			<div class="taxonomy-term-tags"><span>תגיות נוספות:</span>: <?php print render($content['field_gada_categories']); ?>
				<?php if (isset($content['group_agada_content']['field_agada_tags']) && sizeof($content['group_agada_content']['field_agada_tags'])) :  ?>
					<?php print ", ".render($content['group_agada_content']['field_agada_tags']); ?>
				<?php endif; ?>
			</div>

			<div class="taxonomy-term-details">
				<?php  if (isset($content['field_children_version'])) : ?>
					<a href="/kids<?php print render($content['field_children_version']);?>" ><img src="/sites/all/themes/agada/images/figure_icon.png" alt="עיבוד לילדים" title="עיבוד לילדים"/></a>
				<?php endif; ?>
				<?php if (isset($field_type[0]['value']) && $field_type[0]['value'] == EXTENDED_VERSION) : ?>
					<img src="/sites/all/themes/agada/images/extended.png" alt="עיבוד מורחב" title="עיבוד מורחב"/> 
				<?php else: ?>
					<img src="/sites/all/themes/agada/images/basic_version.png" alt="עיבוד בסיסי" title="עיבוד בסיסי"/>
				<?php endif; ?>
				<!-- <img src="/sites/all/themes/agada/images/like_icon.png" alt="דירוג" title="דירוג"/> 
				<span><?php print render($content['field_agada_fivestars']);?></span> -->
				<img src="/sites/all/themes/agada/images/comment_icon.png" alt="תגובות" title="תגובות"/>
				<span><?php print $comment_count;?></span>
				<a href="/node/<?php print $node->nid;?>">כניסה</a> 
			</div>    	
		</div>

	</div>
<?php endif; ?>
