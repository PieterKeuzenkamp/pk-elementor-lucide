document.addEventListener('DOMContentLoaded', function() {
  if(typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
});

// Voor Elementor editor ondersteuning
if (typeof elementor !== 'undefined') {
    elementor.hooks.addAction('panel/open_editor/widget/lucide_icon', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
    
    elementor.hooks.addAction('frontend/element_ready/lucide_icon.default', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
}
