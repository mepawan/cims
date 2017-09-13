<?php
global $ci_settings;

function ci_base_url ($uri = '') {
	return rtrim(base_url(),'/') . '/' . ltrim($uri,'/');
}
function ci_site_url ($uri = '') {
	return rtrim(site_url(),'/') . '/' . ltrim($uri,'/');
}
if ( ! function_exists('ci_public')){
	function ci_public($f = ''){ 
		$asset = rtrim(base_url(), '/') . '/' . 'public/';
		if($f){
			$ext = pathinfo($f, PATHINFO_EXTENSION);
			if($ext){
				$asset .= $f;
			} else {
				$asset .= $f.'/';
			}
			
		}
		return $asset;
	}
}

if ( ! function_exists('title')){
	function title($subtitle = ''){ 
		$ci =& get_instance();
		$title = $ci->config->item('site_name');
		if(!$title){
			$title = "";
		}
		if($subtitle){
			$title = $subtitle . '::' . $title;
		}
		return $title;
	}
}


function str_is_equal($str1, $str2){
	$str1 = strtolower(str_replace(" ",'',$str1));
	$str2 = strtolower(str_replace(" ",'',$str2));
	
	return strcmp($str1,$str2) == 0;
}



function update_mysql_timezone($tz = ''){
	$ci =& get_instance();
	$ci->load->model('Util_model');
	$now = new DateTime();
	$mins = $now->getOffset() / 60;
	$sgn = ($mins < 0 ? -1 : 1);
	$mins = abs($mins);
	$hrs = floor($mins / 60);
	$mins -= $hrs * 60;
	$offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);
	$ci->Util_model->custom_query(" SET time_zone='$offset'; ", false);
}


function read_db($tbl, $where = null, $orderby = null, $order = 'asc'){
	$ci =& get_instance();
	$ci->load->model('Util_model');
	return $ci->Util_model->read($tbl,$where, $orderby, $order);
}
function update_db($tbl, $data){
	$ci =& get_instance();
	$ci->load->model('Util_model');
	return $ci->Util_model->update($tbl,$data);
}
function ci_video_duration($file){
	$ci =& get_instance();
	$ci->load->library('Getid3lib');
	$finfo = $ci->getid3lib->analyze($file);
	return $finfo['playtime_string'];
}
function ci_thumb($file){
	$ci =& get_instance();
	$ci->load->library('cithumb');
	$thumb = $ci->cithumb->generate_thumb($file);
	return $thumb;
}

function ci_readable_file_size($size,$unit="") {
  if( (!$unit && $size >= 1<<30) || $unit == "GB")
    return number_format($size/(1<<30),2)."GB";
  if( (!$unit && $size >= 1<<20) || $unit == "MB")
    return number_format($size/(1<<20),2)."MB";
  if( (!$unit && $size >= 1<<10) || $unit == "KB")
    return number_format($size/(1<<10),2)."KB";
  return number_format($size)." bytes";
}

function ci_ip() {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    }  else if(filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }
    return $ip;
}
function ci_set_session($key, $val){
	$ci =& get_instance();
	$ci->session->set_userdata($key, $val);
}
function ci_get_session($key){
	$ci =& get_instance();
	return $ci->session->userdata($key);
}
function ci_unset_session($key){
	$ci =& get_instance();
	$ci->session->unset_userdata($key);
}


//******** ci_random_code() 
if(! function_exists('ci_random_code')){
	function ci_random_code($size = 5) {
		$alpha_key1 = '';
		$keys = range('A', 'Z');
		$n = rand(0, $size);
		for ($i = 0; $i < $n; $i++) {
			$alpha_key1 .= $keys[array_rand($keys)];
		}
		$length = $size - $n;
		$key = '';
		if($length > 0){
			$keys = range(0, 9);
			$n = rand(0, $length);
			for ($i = 0; $i < $n; $i++) {
				$key .= $keys[array_rand($keys)];
			}
			$length = $length - $n;
		}
		$alpha_key2 = '';
		if($length > 0){
			$keys = range('a', 'z');
			$n = $length;
			for ($i = 0; $i < $n; $i++) {
				$alpha_key2 .= $keys[array_rand($keys)];
			}
		}
		$arr = array($alpha_key1,$key,$alpha_key2);
		shuffle($arr);
		return $arr[0] . $arr[1] . $arr[2] . substr(time(), -3);
		
	}
}

//******** ci_meta_tags() 
if(! function_exists('ci_meta_tags')){
    function ci_meta_tags($enable = array('general' => true, 'og'=> true, 'twitter'=> true, 'robot'=> true), $title = '', $desc = '', $imgurl ='', $url = ''){
        global $ci_settings;
        $output = '';
        //uses default set in seo_config.php
        if($title == '' && isset($ci_settings['site_name'])){
            $title = $ci_settings['site_name'];
        }
        if($desc == '' && isset($ci_settings['site_description'])){
            $desc = $ci_settings['site_description'];;
        }
        if($imgurl == '' && isset($ci_settings['site_logo'])){
            $imgurl = $ci_settings['site_logo'];;
        }
        if($url == ''){
            $url = ci_base_url();
        }
        if($enable['general']){
            $output .= '<meta name="description" content="'.$desc.'" />';
        }
        if($enable['robot']){
            $output .= '<meta name="robots" content="index,follow"/>';
        } else {
            $output .= '<meta name="robots" content="noindex,nofollow"/>';
        }
        //open graph
        if($enable['og']){
            $output .= '<meta property="og:title" content="'.$title.'"/>'
                .'<meta property="og:type" content="'.$desc.'"/>'
                .'<meta property="og:image" content="'.$imgurl.'"/>'
                .'<meta property="og:url" content="'.$url.'"/>';
        }
        //twitter card
        if($enable['twitter']){
            $output .= '<meta name="twitter:card" content="summary"/>'
                .'<meta name="twitter:title" content="'.$title.'"/>'
                .'<meta name="twitter:url" content="'.$url.'"/>'
                .'<meta name="twitter:description" content="'.$desc.'"/>'
                .'<meta name="twitter:image" content="'.$imgurl.'"/>';
        }
        echo $output;
	}
}
if(! function_exists('is_mobile')){
	function is_mobile() {
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		return TRUE;
	}
}


/**
 * Is Ajax
 *
 * Returns true if is a ajax request, false if not
 * 
 * @return boolean
 */
if ( ! function_exists('is_ajax')) {
	function is_ajax() {
		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
	}
}

// Export to CSV
// 
// This method generates a csv file and then returns the generated content
if (!function_exists('arrayToCSV')) {
    function arrayToCSV($query, $fields, $filename = "CSV")
    {
        if (count($query) == 0) {
            return "The query is empty. It doesn't have any data.";
        } else {
            $headers = rowCSV($fields);
            $data = "";
            foreach ($query as $row) {
                $line = rowCSV($row);
                $data .= trim($line) . "\n";
            }
            $data = str_replace("\r", "", $data);
            $content = $headers . "\n" . $data;
            $filename = date('YmdHis') . "_export_{$filename}.csv";
            header("Content-Description: File Transfer");
            header("Content-type: application/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename={$filename}");
            header("Content-Transfer-Encoding: binary");
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Pragma: public");
            header("Content-Length: " . strlen($content));
            return $content;
        }
    }
}
if (!function_exists('rowCSV')) {
    function rowCSV($fields)
    {
        $output = '';
        $separator = '';
        foreach ($fields as $field) {
            if (preg_match('/\\r|\\n|,|"/', $field)) {
                $field = '"' . str_replace('"', '""', $field) . '"';
            }
            $output .= $separator . $field;
            $separator = ',';
        }
        return $output . "\r\n";
    }
}