<?php
function cdn( $asset ){
    if( !Config::get('app.cdn') )
      return asset( $asset );

      $cdns = Config::get('app.cdn');
      $assetName = basename( $asset );

      $assetName = explode("?", $assetName);
      $assetName = $assetName[0];

      foreach( $cdns as $cdn => $types ) {
          if( preg_match('/^.*\.(' . $types . ')$/i', $assetName) )
              return cdnPath($cdn, $asset);
      }

      end($cdns);
      return cdnPath( key( $cdns ) , $asset);
}

function cdnPath($cdn, $asset) {
    return  "//" . rtrim($cdn, "/") . "/" . ltrim( $asset, "/");
}
