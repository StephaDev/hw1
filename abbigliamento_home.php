<?php
    //UNSPLASH
    $key="tj_lfqsCZ4nyb2HXoV9qF_qrjEMk4EukvMuWyMq_L3w";

    $url="https://api.unsplash.com/search/photos?page=1&query=clothing&client_id=". $key;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    echo $result;
?>