<?php

function getBreadcrumb($subPage,$secondPage)
{
    if($secondPage) {

    echo '<section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="'.base_url_back().'">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="../">'.$subPage.'</a></li>
                            <li class="breadcrumb-item active">'.$secondPage.'</li>
                        </ol>
                    </div>
                </div>
            </div>
       </section>';
    } else {
        echo '<section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="'.base_url_back().'">Anasayfa</a></li>
                            <li class="breadcrumb-item active">'.$subPage.'</li>
                        </ol>
                    </div>
                </div>
            </div>
       </section>';
    }

}

?>
