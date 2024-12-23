function get_curr_setup_file_path(setup, file_name) {
    let month_year_folder = ''
    let sub_dir = ''

    if (setup['SubDir']) {
        sub_dir = setup['BrandCode'] + '/'
    }

    const now = new Date()
    const month = now.getMonth() + 1

    if (setup['DateFolderType'] === '0') {
        month_year_folder = `/${now.getFullYear()}/` + ('00' + month.toString()).slice(-2)
    } else if (setup['DateFolderType'] === '1') {
        const day = now.getDate()
        month_year_folder = `/${now.getFullYear()}/` + ('00' + month.toString()).slice(-2) + '/' + ('00' + day.toString()).slice(-2)
    }

    return `/uploads${month_year_folder}/${sub_dir}` + file_name
}


function msset(src) {
    return window.env['MEDIA_URL'] + src
}
