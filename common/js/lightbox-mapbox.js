/**
 * Javascript to handle mapbox for Lightbox popup.
 */
( function ( $ ) {
    "use strict";

    function rhMapBoxInitLightbox() {

        $( 'body' ).on( 'click', '.rhea_trigger_map', function ( event ) {
            event.preventDefault();

            const propertyMapBoxContainer = $( this ).attr( 'data-rhea-map-source' ),
                  location                = $( this ).attr( 'data-rhea-map-location' ),
                  locSplit                = location.split( "," ),
                  lat                     = locSplit[0],
                  lng                     = locSplit[1],
                  zoom                    = locSplit[2],
                  title                   = $( this ).data( 'rhea-map-title' ),
                  price                   = $( this ).data( 'rhea-map-price' ),
                  thumbNail               = $( this ).data( 'rhea-map-thumb' );


            $.fancybox.open(
                {
                    src   : '<div class="rhea_map_lightbox_content" id="' + propertyMapBoxContainer + '"></div>',
                    type  : 'html',
                    touch : false
                }
            );

            setTimeout( function () {

                if ( typeof propertyMapData !== "undefined" && propertyMapBoxContainer !== null ) {

                    let mapboxAPI = propertyMapData.mapboxAPI;
                    if ( mapboxAPI !== null && $( 'body #' + propertyMapBoxContainer )
                    .hasClass( 'fancybox-content' ) && lat && lng ) {

                        const mapCenter   = L.latLng( lat, lng ),
                              mapboxStyle = propertyMapData.mapboxStyle;

                        let mapZoom = 16;

                        // zoom
                        if ( zoom > 0 ) {
                            mapZoom = parseInt( zoom );
                        }

                        mapboxgl.accessToken = mapboxAPI;
                        const propertyMap    = new mapboxgl.Map( {
                            attributionControl : false,
                            container          : propertyMapBoxContainer,
                            style              : mapboxStyle,
                            center             : mapCenter,
                            zoom               : mapZoom
                        } ).addControl( new mapboxgl.AttributionControl( {} ) );

                        // Marker popup
                        let popupContentWrapper = document.createElement( "div" );

                        // create the popup
                        const popup = new mapboxgl.Popup( { offset : 25 } )
                        .setHTML( popupContentWrapper.innerHTML );

                        // create DOM element for the marker
                        const marker_icon     = document.createElement( 'div' );
                        marker_icon.className = 'mapbox-marker';

                        const marker_icon_img = document.createElement( 'img' );
                        marker_icon_img.src   = propertyMapData.icon;
                        marker_icon_img.alt   = propertyMapData.title;
                        marker_icon.append( marker_icon_img );

                        const propertyMarker = new mapboxgl.Marker( marker_icon )
                        .setLngLat( mapCenter )
                        .addTo( propertyMap );
                    }

                }

            }, 1000 );
        } );

    }

    rhMapBoxInitLightbox();


} )( jQuery );