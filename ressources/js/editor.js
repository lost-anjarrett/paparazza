// CONTENT TOOLS (EDITEUR DE TEXTE)
window.addEventListener('load', function() {
    var editor;

    ContentTools.StylePalette.add([
        new ContentTools.Style('Inset 1 (écarte l\'élément sélectionné du précédent)', 'inset-1', ['p','h2', 'h1']),
        new ContentTools.Style('Texte noir', 'text-base', ['p','h2','h1']),
        new ContentTools.Style('Texte gris', 'text-darker', ['p','h2','h1']),
        new ContentTools.Style('Texte blanc', 'text-white', ['p','h2','h1']),
        new ContentTools.Style('Fond rouge', 'bg-danger', ['p','h2','h1']),
        new ContentTools.Style('Fond orange', 'bg-warning', ['p','h2','h1']),
        new ContentTools.Style('Fond bleu', 'bg-info', ['p','h2','h1']),
        new ContentTools.Style('Fond vert', 'bg-success', ['p','h2','h1'])
    ]);

    editor = ContentTools.EditorApp.get();
    editor.init('*[data-editable]', 'data-name');

    editor.addEventListener('saved', function (ev) {
        var name, payload, regions, xhr;

        // Check that something changed
        regions = ev.detail().regions;
        if (Object.keys(regions).length == 0) {
            return;
        }

        // Set the editor as busy while we save our changes
        this.busy(true);

        // Collect the contents of each region into a FormData instance
        payload = new FormData();
        for (name in regions) {
            if (regions.hasOwnProperty(name)) {
                payload.append(name, regions[name]);
            }
        }

        // Send the update content to the server to be saved
        function onStateChange(ev) {
            // Check if the request is finished
            if (ev.target.readyState == 4) {
                editor.busy(false);
                if (ev.target.status == '200') {
                    // Save was successful, notify the user with a flash
                    new ContentTools.FlashUI('ok');
                    // console.log('envoyé mazaltof');
                } else {
                    // Save failed, notify the user with a flash
                    new ContentTools.FlashUI('no');
                }
            }
        };

        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', onStateChange);
        xhr.open('POST', 'save-page');
        xhr.send(payload);
        console.log(payload);
    });


});
