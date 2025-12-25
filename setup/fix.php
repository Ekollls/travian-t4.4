<?php

## Function to set file permissions to 0644 and folder permissions to 0755

function AllDirChmod( $dir = "./", $dirModes = 0755, $fileModes = 0644 ){
   $d = new RecursiveDirectoryIterator( $dir );
   foreach( new RecursiveIteratorIterator( $d, 1 ) as $path ){
      if( $path->isDir() ) chmod( $path, $dirModes );
      else if( is_file( $path ) ) chmod( $path, $fileModes );
  }
}

## Function to clean out the contents of specified directory

function cleandir($dir) {

    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..' && is_file($dir.'/'.$file)) {
                if (unlink($dir.'/'.$file)) { }
                else { echo $dir . '/' . $file . ' (file) NOT deleted!<br />'; }
            }
            else if ($file != '.' && $file != '..' && is_dir($dir.'/'.$file)) {
                cleandir($dir.'/'.$file);
                if (rmdir($dir.'/'.$file)) { }
                else { echo $dir . '/' . $file . ' (directory) NOT deleted!<br />'; }
            }
        }
        closedir($handle);
    }

}

function isDirEmpty($dir){
     return (($files = @scandir($dir)) && count($files) <= 2);
}

echo "----------------------- CLEANUP START -------------------------<br/>";
$start = (float) array_sum(explode(' ',microtime()));
echo "<br/>*************** SETTING PERMISSIONS ***************<br/>";
echo "Setting all folder permissions to 755<br/>";
echo "Setting all file permissions to 644<br/>";
AllDirChmod( "." );

$end = (float) array_sum(explode(' ',microtime()));
echo "<br/>------------------- CLEANUP COMPLETED in:". sprintf("%.4f", ($end-$start))." seconds ------------------<br/>";
?>