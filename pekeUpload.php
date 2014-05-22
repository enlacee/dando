<?php
session_start();
//echo 1;
//echo realpath();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

upload($id);


// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

function upload($id = '')
{
    $urlBase = url();
    $urlCreate = str_replace('/pekeUpload.php', '', $urlBase);
    
    // images tmp (imagenes temporales)
    $tmpPath = realpath(__DIR__ ."/images/productos/tmp/");
    $tmpUrl = $urlCreate. "/images/productos/tmp/";
        
    $path = $tmpPath;
    $url = $tmpUrl;        

    if (!empty($path) && !empty($url)) {            
        $targetFolder = $path;
        if (!empty($_FILES)) {                
            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = uniqueFileName($_FILES['file']['name']);

            $targetFile = rtrim($targetFolder,'/') . '/' . $fileName;
            $targetFileUrl = rtrim($url,'/') .'/'.$fileName;
            // Validate the file type
            $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
            $fileParts = pathinfo($_FILES['file']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile,$targetFile);
                uploadSave($id, $fileName, $targetFile, $targetFileUrl);
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }        
}

function uploadSave($id, $fileName, $path, $url)
{
    //$dataSession['banner']['img_tmp'];
    $dataSession = isset($_SESSION['productos']) ? $_SESSION['productos'] : array();    
    $dataSession[]['img_tmp'] =  array(
        'id' => $id,
        'name' => $fileName,
        'path' =>  $path,
        'url' => $url
    );    
    $_SESSION['productos'] = $dataSession; //echo "<pre>"; print_r($_SESSION);
} 


/// ayuda
    /**
     * Soport file extension (2,3 or 4 char)
     * ejem: $targetFileUrl('.py')
     * @param String $fileName
     * @return string
     */
    function uniqueFileName($fileName)
    {   
        $rs = false;
        if(strlen($fileName) >= 3) {
            for ($i = 3; $i <= 5; $i++) { 
                $extension =  substr($fileName, (strlen($fileName)-$i));
                if(strpos($extension, '.') !== false) {
                    $rs = time().$extension;
                    break;
                }
            }            
        }
        return $rs;
    }
    
/**
 * 
 * @return Construye URL local
 */    
function url(){
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['HTTP_HOST'],
    $_SERVER['REQUEST_URI']
  );
}    