<?php
/*
 * This script gets english language xml-files and compares with language extensions.
 * Use for testing and fixing of language extensions!
 * Just set START_DIR absolute path and run it via browser
 * */
define('START_DIR', '');


#######################################
## DO NOT TOUCH CODE BELOW
#######################################

$admin_lang_files = get_all_files_dirs(START_DIR . 'admin/language/');
$sf_lang_files = get_all_files_dirs(START_DIR . 'storefront/language/');

if (!$admin_lang_files || !$sf_lang_files){
	exit('no one language file found!');
}

$not_exists = array ();

/* *
 * ADMIN SECTION
 * */
$extension_dirs = glob(START_DIR . 'extensions/*', GLOB_ONLYDIR);
foreach ($extension_dirs as $extdir){
	$extension_name = basename($extdir);

	//check is extension have type "language"
	$config = simplexml_load_file(START_DIR . 'extensions/' . $extension_name . '/config.xml');
	if (!$config){
		continue;
	}
	if ((string)$config->type != 'language'){
		continue;
	}

	//detect folder with language files (language name)
	$ldirs = glob(START_DIR . 'extensions/' . $extension_name . '/admin/language/*', GLOB_ONLYDIR);
	$language_dir = '';
	foreach ($ldirs as $ldir){
		if (strpos($ldir, 'english') !== false){
			continue;
		} else{
			$language_dir = basename($ldir);
			break;
		}
	}
	if (!$language_dir){
		echo $extension_name . ' extension was skipped. cannot recognize folder with xml-files inside admin/language directory.' . "\n";
		continue;
	}

	foreach ($admin_lang_files as $core_filename){
		if (pathinfo($core_filename, PATHINFO_EXTENSION) != 'xml'){
			continue;
		}
		$relative_path = str_replace(START_DIR . 'admin/language/english/', '', $core_filename);
		if (pathinfo($relative_path, PATHINFO_FILENAME) . '.' . pathinfo($relative_path, PATHINFO_EXTENSION) == 'english.xml'){
			$relative_path = str_replace('english.xml', $language_dir . '.xml', $relative_path);
		}
		$lang_file = START_DIR . 'extensions/' . $extension_name . '/admin/language/' . $language_dir . '/' . $relative_path;
		echo compare($core_filename, $lang_file);
	}


	foreach ($sf_lang_files as $core_filename){
		if (pathinfo($core_filename, PATHINFO_EXTENSION) != 'xml'){
			continue;
		}
		$relative_path = str_replace(START_DIR . 'storefront/language/english/', '', $core_filename);
		if (pathinfo($relative_path, PATHINFO_FILENAME) . '.' . pathinfo($relative_path, PATHINFO_EXTENSION) == 'english.xml'){
			$relative_path = str_replace('english.xml', $language_dir . '.xml', $relative_path);
		}
		$lang_file = START_DIR . 'extensions/' . $extension_name . '/storefront/language/' . $language_dir . '/' . $relative_path;
		echo compare($core_filename, $lang_file);
	}

}
echo '<ol>';
foreach ($not_exists as $line){
	echo '<li>' . $line . '</li>';
}
echo '</ol>';
exit;


// for future use. TODO:// needs to compare definitions inside extensions
/*
 * EXTENSIONS
 * */
$dirs = glob(START_DIR . 'extensions/*', GLOB_ONLYDIR);
foreach ($dirs as $extdir){
	$extension_name = pathinfo($extdir, PATHINFO_BASENAME);

	$files = glob($extdir . '/admin/language/english/' . $extension_name . '/*');
	foreach ($files as $file){
		$file2 = pathinfo($file, PATHINFO_BASENAME);
		$file2 = START_DIR . 'extensions/' . $extension_name . '/admin/language/spanish/' . $extension_name . '/' . $file2;
		echo compare($file, $file2);
	}

	$files = glob($extdir . '/storefront/language/english/' . $extension_name . '/*');
	foreach ($files as $file){
		$file2 = pathinfo($file, PATHINFO_BASENAME);
		$file2 = START_DIR . 'extensions/' . $extension_name . '/storefront/language/spanish/' . $extension_name . '/' . $file2;
		echo compare($file, $file2);
	}
}


/*******************************
 * functions
 **********************/


function compare($file1, $file2){
	global $not_exists;
	$output = '';

	if (!file_exists($file2)){
		$not_exists[] = '<p style="color: #8b0000;"> ' . str_replace(START_DIR, '', $file2) . ' is does not exists. Tried to copy.</p>';
		//try to copy
		if (!is_dir(dirname($file2))){
			mkdir(dirname($file2), 0777);
		}
		copy($file1, $file2);
		return false;
	}

	$xml1 = simplexml_load_file($file1);
	if (!$xml1){
		exit($file1 . " is corrupted!");
	}
	$xml2 = simplexml_load_file($file2);
	if (!$xml2){
		exit($file2 . " is corrupted!");
	}
	$keys1 = $keys2 = $values1 = $values2 = array ();

	foreach ($xml1->definition as $def){
		$keys1[] = (string)$def->key;
		$values1[(string)$def->key] = (string)$def->value;
	}

	foreach ($xml2->definition as $def){
		$keys2[] = (string)$def->key;
		$values2[(string)$def->key] = (string)$def->value;
	}

	$diff = array_diff($keys1, $keys2);
	if ($diff){
		$output .= "</br></br>Keys that not presents in <b>" . str_replace(START_DIR, '', $file2) . "</b> are:<br/>";
		foreach ($diff as $key){
			$slice = $xml1->xpath("definition/key[text()='" . $key . "']/parent::*");

			$definition = $xml2->addChild('definition');
			$definition->addChild('key', (string)$key);
			$v = $definition->addChild('value');
			addCData($v, '????' . (string)$slice[0]->value);

			$output .= $key . '</br>';
		}
	}

	if ($output){

		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml2->asXML());
		$string_xml = $dom->saveXML();
		$string_xml = str_replace('  ', "\t", $string_xml);

		file_put_contents($file2, $string_xml);

		$output .= "<br>";
	}


	//check non-translated items
	foreach ($keys1 as $key){
		if ($values1[$key] == $values2[$key]){
			$output .= "</br></br>Keys that seems not translated in <b>" . str_replace(START_DIR, '', $file2) . "</b> are:<br/>";
			$output .= $key . '</br>';
		}
	}

	return $output;
}

function addCData(&$xml_node, $cdata_text){
	$node = dom_import_simplexml($xml_node);
	$no = $node->ownerDocument;
	$node->appendChild($no->createCDATASection($cdata_text));
}


function get_all_files_dirs($start_dir){
	$iter = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($start_dir, RecursiveDirectoryIterator::SKIP_DOTS),
			RecursiveIteratorIterator::SELF_FIRST,
			RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
	);

	$paths = array ($start_dir);
	foreach ($iter as $path => $dir){
		if (pathinfo($path, PATHINFO_EXTENSION) != 'xml'){
			continue;
		}
		$paths[] = $path;
	}
	return $paths;
}
