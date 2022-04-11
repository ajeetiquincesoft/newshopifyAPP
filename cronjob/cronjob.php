<?php
include("connection.php");
$path='/public/csv/barcode.csv';

        $header="";
        if(file_exists($path))
        {
            $file= new \SplFileObject($path);
            $file->setFlags(\SplFileObject::READ_CSV);
            $count=1;
            foreach ($file as $key => $value) {
                if(empty($header))
                {
                    $header="1";
                }
                else
                {
                    $style=$value[0];
                    $color=$value[1];
                    $size=$value[2];
                    $barcode=$value[3];
                    $price=$value[4];
                    $ETA=$value[6];
                    $WIP=$value[7];
                    echo $barcode;
                    if(!empty($barcode))
                    {
                      //$productDetails= Products::where(['barcode'=>$barcode])->first();
                       $productDetails= mysql_query('select * from `products` where (`barcode` ='.$barcode.') limit 1');
                       if(!empty($productDetails))
                       {
                        mysql_query("update `products` set `ETA` = '".$ETA."', `WIP` = '".$WIP."' where (`barcode` = '".$barcode."')");
                           //Products::where(['barcode'=>$barcode])->update(['ETA'=>$ETA,'WIP'=>$WIP]); 
                       } 
                       else
                       {
                        mysql_query("insert into `products` (`style`, `color`, `size`, `barcode`, `price`, `ETA`, `WIP`) values ('".$style."', '".$color."', '".$size."', '".$barcode."', '".$price."', '".$ETA."', '".$WIP."')");
                           // Products::create(['style'=>$style,'color'=>$color,'size'=>$size,'barcode'=>$barcode,'price'=>$price,'ETA'=>$ETA,'WIP'=>$WIP]);
                       }
                    }

                
                }
                // if($count==750)
                //     {
                //       echo $style;
                //         break;  
                //     }
                    $count++;
                   
              
            }
            
        }



        ?>