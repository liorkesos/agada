(function($) {

  /**
   * Adds a CKEditor plugin to insert <pre> tags.
   *
   * This is heavily based on blog posts by:
   *
   * Nikolay Ulyanitsky
   * http://blog.lystor.org.ua/2010/11/ckeditor-plugin-and-toolbar-button-for.html
   *
   * and
   *
   * Peter Petrik
   * http://peterpetrik.com/blog/ckeditor-and-geshi-filter
   */
  CKEDITOR.plugins.add('code-button', {
    init: function (editor) {
      // Create a new CKEditor style to add <pre> tags.
      var buttonName = 'code-button';
      var format = {
        element : "pre"
      };
      var style = new CKEDITOR.style(format);

      // Override the removeFromRange() method to avoid a JavaScript error when
      // the button is "unclicked", caused by the attachStyleStateChange() call
      // below.
      // @todo: Actually make this do something instead of being a no-op.
      style.removeFromRange = function (range) {
      };

      // Allow the button's state to be toggled.
      // @todo: Make this work when toggling the button off too (see comment
      //   above).
      editor.attachStyleStateChange(style, function (state) {
        editor.getCommand(buttonName).setState(state);
      });

      // Add the command and the button to the editor.
      editor.addCommand(buttonName, new CKEDITOR.styleCommand(style));
      editor.ui.addButton(buttonName, {
        label: Drupal.t('Code'),
        command: buttonName
      });
    }
  });

})(jQuery);
