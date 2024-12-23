function calc_my_app_height() {
    //find the height of the internal page
    // myapp_wrapper
    const the_height=
        document.getElementById('the_iframe').contentWindow.$('.my-app .myapp_wrapper').height()

    //change the height of the iframe
    document.getElementById('the_iframe').height=
        the_height;

    document.getElementById('the_iframe').style.overflow = "hidden";
}
