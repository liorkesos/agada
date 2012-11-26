(function($) {
CKEDITOR.plugins.add( 'code-button',
{
	init: function( editor )
	{
		editor.addCommand( 'code-button',new CKEDITOR.dialogCommand( 'tooltipDialog' ) );
		editor.ui.addButton( 'code-button',
		{
			label: 'פירוש',
			command: 'code-button',
			icon: this.path + 'images/means_ckeditor_icon.png'
		} );

		CKEDITOR.dialog.add( 'tooltipDialog', function( editor )
		{
		var old_tooltip_text = "";
			return {
				title : 'פירוש',
				minWidth : 400,
				minHeight : 200,
				contents :
				[
					{
						id : 'tab1',
						label : 'הגדרות בסיסיות',
						elements :
						[

							{
								type : 'text',
								id : 'title',
								label : 'פירוש',
								'default' : old_tooltip_text,
								validate : CKEDITOR.dialog.validate.notEmpty( "פירוש" )
							}
	 
						]
					},
					
				],
				onShow : function()
				{
					old_tooltip_text = "";
					var sel = editor.getSelection();			
					old_tooltip_text = sel.getStartElement().$.title;
				    this.setValueOf( 'tab1', 'title' , old_tooltip_text );
				},
				onOk : function()
				{
					var dialog = this;
					var sel = editor.getSelection();
					
					var tooltip_text = editor.document.createElement( 'code' );
					tooltip_text.setAttribute("class", "tooltip_code");
					tooltip_text.setAttribute( 'title', dialog.getValueOf( 'tab1', 'title' ) );
					tooltip_text.setText( sel.getSelectedText());
					
					editor.insertElement( tooltip_text );
				
					
				}
			};
		} );
	}
} );
})(jQuery);