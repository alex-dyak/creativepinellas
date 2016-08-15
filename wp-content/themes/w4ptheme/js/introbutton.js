(function() {
    tinymce.create('tinymce.plugins.visual_intro', {
        init : function(ed, url) {
            ed.addButton('intro', {
                title : 'Intro',
                image : url + '/images/intro.png',
                onclick : function() {
                    ed.selection.setContent('<div class="intro">' + ed.selection.getContent() + '</div>');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('visual_intro', tinymce.plugins.visual_intro);
})();
