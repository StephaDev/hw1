<?php
    //SERPAPI
    $key="e2cbde8799c652e93a6fecdf879e82530e01c5b533eb71587bd3111fdf261736";

    $url="https://serpapi.com/search.json?location=italy&engine=google&q=".urlencode($_GET["cerca"])."&tbm=shop&hl=it&gl=it&lr=it&google_domain=google.it&api_key=".$key;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    $result = curl_exec($curl);

    curl_close($curl);
    echo $result;

?>