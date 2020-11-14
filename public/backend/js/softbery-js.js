/*
* @Author: Softbery Group
* @Date:   2020-10-29 15:50:22
* @Last Modified by:   Softbery Group
* @Last Modified time: 2020-10-29 19:57:10
*/

/**
 * @brief Change
 * @details [long description]
 * 
 * @param  path to file
 * @return link to style
 */
function change(path)
{
	url = '';
	url = url.concat('http://',location.hostname,path.concat('/css/'));
	if (document.getElementById('style').href != url.concat('style-dark.css')) {
		document.getElementById('style').href = url.concat('style-dark.css');
	}else{
		document.getElementById('style').href = url.concat('style.css');
	}
}