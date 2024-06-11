export function editor() {
    tinymce.init({
        selector: ".editor",
        plugins: "file-manager table link lists code fullscreen",
        Flmngr: {
            apiKey: "FLMNFLMN",
            urlFileManager: '/flmngr',
            urlFiles: '/storage/upload/files'
        },
        relative_urls: false,
        extended_valid_elements: "*[*]",
        height: "500px",
        toolbar: [
            "bold italic underline | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link blockquote table | code ",
        ],
        contextmenu: "undo redo | cut copy paste | inserttable",
        promotion: false,
        language: "ru",
    });
};