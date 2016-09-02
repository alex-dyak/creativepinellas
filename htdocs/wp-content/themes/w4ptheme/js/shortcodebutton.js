(function() {
    tinymce.create('tinymce.plugins.visual_shortcode', {
        init : function(ed, url) {
            ed.addButton('shortcode', {
                title : 'Blog shortcode',
                image : url + '/images/rsz_brases.jpg',
                onclick : function() {
                    ed.selection.setContent('[blog category="" post_number=12 featured=0]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('visual_shortcode', tinymce.plugins.visual_shortcode);
})();
