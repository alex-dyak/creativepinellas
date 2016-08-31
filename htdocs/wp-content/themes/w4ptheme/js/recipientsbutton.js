(function() {
    tinymce.create('tinymce.plugins.recipients', {
        init : function(ed, url) {
            ed.addButton('recipients', {
                title : 'Recipients shortcode',
                image : url + '/images/recipients.jpg',
                onclick : function() {
                    ed.selection.setContent('[resipients_list recipients=4]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('recipients', tinymce.plugins.recipients);
})();
