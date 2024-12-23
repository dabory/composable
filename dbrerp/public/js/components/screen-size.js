function get_screen_size(width = screen.width, height = screen.height) {
    const expiry = new Date();
    expiry.setTime( expiry.getTime()+(3600*60*1000) );
    document.cookie='screenWidth='+width+'; expires='+ expiry.toGMTString() + ';path=/';
    document.cookie='screenHeight='+height+'; expires='+ expiry.toGMTString() + ';path=/';

    location.reload();
}
