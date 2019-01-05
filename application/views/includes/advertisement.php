                <aside>
                    <div>
                        <small style="display: block;">Publicidad</small>
                    </div>
                    <div class="advertisement">
                        <?php 
                            function aasort (&$array, $key) {
                                $sorter=array();
                                $ret=array();
                                reset($array);
                                foreach ($array as $ii => $va) {
                                    $sorter[$ii]=$va[$key];
                                }
                                asort($sorter);
                                foreach ($sorter as $ii => $va) {
                                    $ret[$ii]=$array[$ii];
                                }
                                $array=$ret;
                            }
                            aasort($advertisement,"display_order");
                            //print_r($advertisement);
                        ?>
                        <?php 
                            $dimensions = array(
                                'banner1'=>array(
                                    'width'=>"136",
                                    'height'=>"74"
                                ),
                                'banner2'=>array(
                                    'width'=>"282",
                                    'height'=>"74"
                                ),
                                'banner3'=>array(
                                    'width'=>"136",
                                    'height'=>"158"
                                ),
                                'banner4'=>array(
                                    'width'=>"282",
                                    'height'=>"158"
                                ),
                                'banner5'=>array(
                                    'width'=>"136",
                                    'height'=>"242"
                                ),
                                'banner6'=>array(
                                    'width'=>"282",
                                    'height'=>"242"
                                ),
                                'banner7'=>array(
                                    'width'=>"136",
                                    'height'=>"326"
                                ),
                                'banner8'=>array(
                                    'width'=>"282",
                                    'height'=>"326"
                                ),
                            );
                        ?>
                        <?php foreach($advertisement as $advertisement_row): ?>
                            <a href="<?php echo $advertisement_row['banner_url']; ?>">
                                <!--<img src="/anunciantes/<?php //echo "banner_".$advertisement_row['id']; ?>.png" />-->
                                <?php if($advertisement_row['banner_type'] == 8): ?>
                                    <img data-clientid="<?php echo "banner_".$advertisement_row['id']; ?>" src="http://lorempixel.com/g/<?php echo $dimensions['banner8']['width']."/".$dimensions['banner8']['height'] ?>/transport/Su-anuncio-aqui/"/>
                                <?php elseif($advertisement_row['banner_type'] == 7): ?>
                                    <img data-clientid="<?php echo "banner_".$advertisement_row['id']; ?>" src="http://lorempixel.com/g/<?php echo $dimensions['banner7']['width']."/".$dimensions['banner7']['height'] ?>/transport/Su-anuncio-aqui/"/>
                                <?php elseif($advertisement_row['banner_type'] == 6): ?>
                                    <img data-clientid="<?php echo "banner_".$advertisement_row['id']; ?>" src="http://lorempixel.com/g/<?php echo $dimensions['banner6']['width']."/".$dimensions['banner6']['height'] ?>/transport/Su-anuncio-aqui/"/>
                                <?php elseif($advertisement_row['banner_type'] == 5): ?>
                                    <img data-clientid="<?php echo "banner_".$advertisement_row['id']; ?>" src="http://lorempixel.com/g/<?php echo $dimensions['banner5']['width']."/".$dimensions['banner5']['height'] ?>/transport/Su-anuncio-aqui/"/>
                                <?php elseif($advertisement_row['banner_type'] == 4): ?>
                                    <img data-clientid="<?php echo "banner_".$advertisement_row['id']; ?>" src="http://lorempixel.com/g/<?php echo $dimensions['banner4']['width']."/".$dimensions['banner4']['height'] ?>/transport/Su-anuncio-aqui/"/>
                                <?php elseif($advertisement_row['banner_type'] == 3): ?>
                                    <img data-clientid="<?php echo "banner_".$advertisement_row['id']; ?>" src="http://lorempixel.com/g/<?php echo $dimensions['banner3']['width']."/".$dimensions['banner3']['height'] ?>/transport/Su-anuncio-aqui/"/>
                                <?php elseif($advertisement_row['banner_type'] == 2): ?>
                                    <img data-clientid="<?php echo "banner_".$advertisement_row['id']; ?>" src="http://lorempixel.com/g/<?php echo $dimensions['banner2']['width']."/".$dimensions['banner2']['height'] ?>/transport/Su-anuncio-aqui/"/>
                                <?php elseif($advertisement_row['banner_type'] == 1): ?>
                                    <img data-clientid="<?php echo "banner_".$advertisement_row['id']; ?>" src="http://lorempixel.com/g/<?php echo $dimensions['banner1']['width']."/".$dimensions['banner1']['height'] ?>/transport/Su-anuncio-aqui/"/>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </aside>