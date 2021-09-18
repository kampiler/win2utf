<?
  $filez4dir=array();
  $dir_inp='C:\www\home\local\www';
  $dir_out='C:\1\www4utf\2ftp';
  $filez = dir2arr($dir_inp);
  #evd_var_dump($filez);

  foreach($filez as $file_id=>$fn)
    {
     if(is_need($fn))
       {
        $fnout=str_replace($dir_inp,$dir_out,$fn);
        echo "$fn - $fnout\n";
        @mkdir(evd_fn_dir($fnout),0777,true);

        $s=file_get_contents($fn);
        $s1=win2utf($s);
        file_put_contents($fnout, $s1);
        $t0=filectime($fn);
        touch($fnout,$t0);

       }
    }

  
  function win2utf($str)
    {
     if($str!='') return @iconv("CP1251", "UTF-8", $str);
     else return '';
    }

  function is_need($fn)
    {
     $r=false;
     $ext=evd_fn_ext($fn);
     if(($ext=='php')or($ext=='htm')or($ext=='html')or($ext=='txt')) $r=true;
     return($r);
    }
  
  function evd_fn_dir($fn)
    {
     $z = pathinfo($fn);
     return($z['dirname']);
    }
  
  function evd_fn_ext($fn)
    {
     #return strtolower(end(explode(".", $fn)));
     $pinfo=pathinfo($fn);
     return $pinfo['extension'];
    }
   
  $filez4dir=array();
  #$f4c=0; $f4max=1550;
  function dir2arr($dir)
    { 
     $r=array(); 
     global $filez4dir;

     $cdir=scandir($dir); 
     foreach($cdir as $key=>$value) 
       { 
        if(!in_array($value,array(".",".."))) 
          { 
           if(is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
             { 
              //$filez4dir[$value] =
              dir2arr($dir.DIRECTORY_SEPARATOR.$value); 
             } 
           else 
             { 
              if(is_need($value))
                {
                 $filez4dir[]=$dir.DIRECTORY_SEPARATOR.$value;
                }
             } 
          } 
        #if($f4c>$f4max) break;
       } 
     
     return $filez4dir;
    } 

?>