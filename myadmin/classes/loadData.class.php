<?php
session_start();
include_once '../includes/autoloader.inc.php';
class loadData extends Dbh {
    public function load_data($limit,$start){

        if(isset($_POST['limit'], $_POST['start']))
    {
        
        $obj = new getData();
        $datas=$obj->getLoadData();

        foreach($datas as $key=>$data){
        echo '<div class="col-lg-4 col-md-6 col-sm-12 item">
                        <div class="property-listing property-2">

                            <div class="listing-img-wrapper">
                                <div class="list-img-slide">
                                    <div class="click">'.
                                        '<div><a href="property.php?pid='.$data[$key]['uuid'].'"><img
                                                    src="../myadmin/upload/'.$data[$key]['image'].'" class="img-fluid mx-auto"
                                                    alt="" /></a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="listing-detail-wrapper">
                                <div class="listing-short-detail-wrap">
                                    <div class="listing-short-detail">
                                        <h4 class="listing-name verified"><a href="property.php?pid='.$data[$key]['uuid'].'">'.$data[$key]['apartment_name'].'</a></h4>
                                        <span class="prt-types ">Status: '.
                                                    $data[$key]['sell_status'].'
                                                </span>
                                    </div>
                                    <div class="listing-short-detail-flex">
                                        <h6 class="listing-card-info-price">Price On Request</h6>
                                    </div>
                                    </div>
                                    </div>

<div class="listing-detail-footer">
    <div class="footer-first ">
        <div class="foot-location "><i
                class="fas fa-map-marker-alt align-self-center mr-2"></i>'.$data[$key]['addr_full'].'
        </div>
    </div>
    <div class="footer-flex">
        <a href="property.php?pid='.$data[$key]['uuid'].'" class="prt-view">View</a>
    </div>
</div>
</div>
</div>';
}
}
}
}