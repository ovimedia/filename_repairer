
<?php

scan_files("./wp-content/uploads/");

function scan_files($dir)
{
    
    $bad_chars = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,ü");
    $good_chars = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,&uuml;");

    if (is_dir($dir)) 
    {
        if ($data = opendir($dir)) 
        {

            while (($file = readdir($data)) !== false) 
            {
                if (is_dir($dir . $file) && $file != "." && $file != "..") 
                {
                    scan_files($dir . $file . "/");
                } 
                elseif (is_file($dir . $file) && $file != "." && $file != "..") 
                {
                    rename($dir . $file, $dir . str_replace($bad_chars, $good_chars, $file));
                }
            }

            closedir($data);

        }
    }
}

echo "Proceso terminado.";

  ?>