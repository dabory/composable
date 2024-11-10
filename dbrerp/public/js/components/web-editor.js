// const editor = new FroalaEditor('div#froala-editor', {
//     height: 300,
//     placeholderText: false,
//     zIndex: 2501,

// })

$(document).on("dblclick", "#modal-memo .fr-view, #modal-memo #memo-editor", function () {
    complete_memo(this);
});

function change_memo_mode($this) {
    const modal_body = $($this).closest('.modal-body')

    const html = get_editor_codeView_html($this)

    $(modal_body).find('.fr-view').html( html )
    $(modal_body).find('#memo-editor').val(html)


    $(modal_body).find('#froala-editor').toggle()
    $(modal_body).find('#memo-editor').toggle()
}

function get_editor_codeView_html(dom_val) {
    const modal_body = $(dom_val).closest('.modal-body')

    let editor_html = ''
    if ($(modal_body).find('#memo-editor').is(':visible')) {
        editor_html = $(modal_body).find('#memo-editor').val()
    } else {
        const editor = $(modal_body).find('#froala-editor')[0]['data-froala.editor']

        if (editor.codeView.isActive()) {
            editor_html = editor.codeView.get()
            editor.codeView.toggle()
        } else {
            editor_html = editor.html.get()
        }
    }


    return editor_html
}

function complete_memo($this) {
    let editor_html = get_editor_codeView_html($this)

    $($('#froala-editor').data('preview_id')).html(editor_html);
    $($('#froala-editor').data('txtarea_id')).val(
        remove_tag(editor_html)
    );
    $('#modal-memo').modal("hide");

    $('#modal-memo').trigger('complete.memo', [$('#froala-editor').data('txtarea_id'), $('#froala-editor').data('preview_id')])
}

// Define popup template.
FroalaEditor.POPUP_TEMPLATES["customPlugin.popup"] =
    "[_BUTTONS_][_CUSTOM_LAYER_]";

// Define popup buttons.
Object.assign(FroalaEditor.DEFAULTS, {
    popupButtons: ["popupClose", "|", "popupButton1"],
});

// The custom popup is defined inside a plugin (new or existing).
FroalaEditor.PLUGINS.customPlugin = function (editor) {

};

// Define an icon and command for the button that opens the custom popup.
FroalaEditor.DefineIcon("buttonIcon", { NAME: "star", SVG_KEY: "star" });
FroalaEditor.RegisterCommand("myButton", {
    title: "Media Library",
    icon: "buttonIcon",
    undo: false,
    focus: false,
    plugin: "customPlugin",
    callback: async function () {
        if ($('.content').find('#modal-media-btn').length === 0) {
            $('.content').append(`
                <button type="button" id="modal-media-btn" hidden
                    class="btn btn-success btn-open-modal">
                </button>
            `)
        }
        $('#modal-media #media-form button').addClass('bg-primary')

        $('#modal-media').data('target-id', $('#froala-editor').data('target-id') ?? '#modal-memo')
        if (! PopupForm1FormBMediaForm.btn_act_new(
            $('#froala-editor').data('media_brand_code') ?? false)
        ) {
            return
        }
        $('#modal-media-btn').data('target', 'media')
        $('#modal-media-btn').data('variable', mediaModal)
        $('#modal-media-btn').trigger('click')
    },
});

function init_froala_editor(dom_val = '#froala-editor', html = undefined) {
    new FroalaEditor(dom_val, {
        entities: '',

        // htmlAllowComments: true,
        // useClasses: false,
        // htmlAllowedAttrs: ['.*'],   // Changed this to all tags
        // htmlAllowedTags: ['.*'],   // Changed this to all tags
        // htmlRemoveTags: [''],   // Added this
        // fullPage: true,   // Added this
        // lineBreakerTags: [''],   // Added this, not sure if it does anything yet
        // linkAlwaysBlank: true,   // Added this

        key: window.env['FROALA_LICENSE_KEY'],
        attribution: false,
        enter: FroalaEditor.ENTER_DIV,
        height: 600,
        placeholderText: false,
        zIndex: 2501,

        toolbarButtons: {
            // Key represents the more button from the toolbar.
            moreText: {
                // List of buttons used in the  group.
                buttons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting'],
                // Alignment of the group in the toolbar.
                align: 'left',
                // By default, 3 buttons are shown in the main toolbar. The rest of them are available when using the more button.
                buttonsVisible: 3
            },
            moreParagraph: {
                buttons: ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote'],
                align: 'left',
                buttonsVisible: 3
            },
            moreRich: {
                buttons: ['|', 'myButton', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR'],
                align: 'left',
                buttonsVisible: 3
            },
            moreMisc: {
                buttons: ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],
                align: 'right',
                buttonsVisible: 2
            }
        },
        quickInsertButtons: ['table', 'ol', 'ul', 'hr'],
    }, function () {
        if (html) {
            this.html.set(html);
        }
    });
}

$(document).ready(function() {
    // Initialize the editor.
    init_froala_editor()
});

