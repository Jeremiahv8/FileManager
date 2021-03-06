FileManager
===================

Just copy 'FileManager' folder to a folder on your webserver.  

## Why it is good

- Single self contained package 
- Ajax based so it is fast, but doesn't break the back button
- Allows drag and drop file uploads if the folder is writable by the webserver (`chmod 777 your/folder`)
- Suits my aesthetics.  More like Dropbox, and less like Windows Explorer
- Works with Unicode file names
- The interface is usable from an iPad
- XSRF protection, and an optional password.
- Files stored in a 'public' folder
- Enable usage statistics for bandwidth usage and storage usage

## Do not allow uploads on the public web

If you allow uploads on the public web, it is only a matter of time before your server is hosting and serving very illegal content. Any of the following options will prevent this:
 - Don't make the folder writable by the webserver `chmod 775`
 - Set `$allow_upload = false`
 - Use a password `$PASSWORD = 'some password'`
 - Use a `.htaccess` file with Apache, or `auth_basic` for nginx
 - Only use this on a private network

HT: [@Jeremiahv8](https://github.com/Jeremiahv8/)

## Forks

- **Edit feature**. <NO FORKS YET>
- Storage info (Storage used, Remaining, Percentage)
- Bandwidth info (Bandwidth used, Remaining, Percentage)
- Limit uploads based on storage remaining
- Limit Bandwidth access to files (even hotlinked) if bandwidth is exceeded
- Files stored in a 'public' folder instead of the root

## Screenshot

![Screenshot](https://raw.github.com/jcampbell1/simple-file-manager/master/screenshot.png "Screenshot")
