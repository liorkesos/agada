
(function($) {
		  
CKEDITOR.plugins.add( 'source-button',
{	
	init: function( editor )
	{
		

		editor.addCommand( 'source-button',new CKEDITOR.dialogCommand( 'tooltipSourceDialog' ) );
		editor.ui.addButton( 'source-button',
		{
			label: 'מקור',
			command: 'source-button',
			icon: 'http://agadastories.org.il:8080/sites/all/modules/custom/custom_image/ckeditor/source-button/images/source_ckeditor_icon.png'
		} );
		
	
		
		CKEDITOR.dialog.add( 'tooltipSourceDialog', function( editor )
		{
			var old_tooltip_text = "";
			return {
				title : 'מקור',
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
								label : 'מקור',
								'default' : old_tooltip_text,
								validate : CKEDITOR.dialog.validate.notEmpty( "מקור" )
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
					tooltip_text.setAttribute("class", "tooltip_source");
				    
					tooltip_text.setAttribute( 'title', dialog.getValueOf( 'tab1', 'title' ) );
					tooltip_text.setText( sel.getSelectedText());
					editor.insertElement( tooltip_text );
					old_tooltip_text = "";
					
				}
			};
		} );
	}
} );

})(jQuery);