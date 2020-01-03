function selectOptions() {
    var page = document.getElementsByName('page');
    var filename;
    for (i = 0; i < page.length; i++) {
        if (page[i].checked) {
            filename = page[i].value + ".php";
            window.location.replace(filename);
        }
    }
}