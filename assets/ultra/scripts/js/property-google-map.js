/**
 * Javascript to handle google map for property single page.
 */
(function ($) {
    "use strict";

	var mapContainer = document.getElementById("property_map");

	if ( typeof propertyMapData !== "undefined" && mapContainer !== null ) {

		if ( propertyMapData.lat && propertyMapData.lng ) {

			var iconURL = propertyMapData.icon;
			var iconSize = new google.maps.Size( 42, 57 );
			var mapZoom = 15;

			// zoom
			if( propertyMapData.zoom > 0 ) {
				mapZoom = parseInt( propertyMapData.zoom );
			}

			// retina
			if( window.devicePixelRatio > 1.5 ) {
				if( propertyMapData.retinaIcon ) {
					iconURL = propertyMapData.retinaIcon;
					iconSize = new google.maps.Size( 83, 113 );
				}
			}

			if ( propertyMapData.marker_type === 'circle' ) {
				var markerIcon = {
					path: google.maps.SymbolPath.CIRCLE,
					scale: 30,
					fillColor: propertyMapData.marker_color,
					strokeColor: propertyMapData.marker_color,
					fillOpacity: 0.5,
					strokeWeight: 0.6
				}
			} else {
				var markerIcon = {
					url : iconURL,
					size : iconSize,
					scaledSize : new google.maps.Size( 42, 57 ),
					origin : new google.maps.Point( 0, 0 ),
					anchor : new google.maps.Point( 21, 56 )
				};
			}

			var propertyLocation = new google.maps.LatLng( propertyMapData.lat, propertyMapData.lng );
			var propertyMapOptions = {
				center : propertyLocation,
				zoom : mapZoom,
				scrollwheel : false
			};

			// Map Styles
			if (undefined !== propertyMapData.styles) {
				propertyMapOptions.styles = JSON.parse(propertyMapData.styles);
			}

			// Setting Google Map Type
			switch (propertyMapData.type) {
				case 'satellite':
					propertyMapOptions.mapTypeId = google.maps.MapTypeId.SATELLITE;
					break;
				case 'hybrid':
					propertyMapOptions.mapTypeId = google.maps.MapTypeId.HYBRID;
					break;
				case 'terrain':
					propertyMapOptions.mapTypeId = google.maps.MapTypeId.TERRAIN;
					break;
				default:
					propertyMapOptions.mapTypeId = google.maps.MapTypeId.ROADMAP;
			}

			var propertyMap = new google.maps.Map( mapContainer, propertyMapOptions );

			var propertyMarker = new google.maps.Marker( {
				position : propertyLocation,
				map : propertyMap,
				icon : markerIcon
			} );

			var boxText = document.createElement( "div" );
			boxText.className = 'map-info-window';
			var innerHTML = "";
			if( propertyMapData.thumb ) {
				innerHTML += '<span class="thumb-link"><img class="prop-thumb" src="' + propertyMapData.thumb + '" alt="' + propertyMapData.title + '"/></span>';
			}
			innerHTML += '<div class="rh-gm-thumb-detail">';

			innerHTML += '<h5 class="prop-title">' + propertyMapData.title + '</h5>';
			innerHTML += '<div>'
			if (propertyMapData.propertyType) {
				innerHTML += '<span class="type">' + propertyMapData.propertyType + '</span>';
			}
			if( propertyMapData.price ) {
				innerHTML += '<p><span class="price">' + propertyMapData.price + '</span></p>';
			}
			innerHTML += '</div>'
			innerHTML += '<div class="arrow-down"></div>';
			boxText.innerHTML = '<div class="rh-ultra-info-window">'+ innerHTML + '</div>';

			// info window close icon URL
			var closeIconURL = "";
			if ( ( typeof mapStuff !== "undefined" ) && mapStuff.closeIcon ) {
				closeIconURL = mapStuff.closeIcon;
			}

            var pixelOffset = -70;
            if (propertyMapData.marker_type === 'circle') {
                pixelOffset = -22;
            }

			var infoWindowOptions = {
				content : boxText,
				disableAutoPan : true,
				maxWidth : 450,
				alignBottom : true,
				pixelOffset : new google.maps.Size( -225, pixelOffset ),
				zIndex : null,
				closeBoxMargin : "8px 8px -24px -16px",
				closeBoxURL : closeIconURL,
				infoBoxClearance : new google.maps.Size( 1, 1 ),
				isHidden : false,
				pane : "floatPane",
				enableEventPropagation : false
			};

			var infoBox = new InfoBox( infoWindowOptions );

			google.maps.event.addListener( propertyMarker, 'click', function() {
				var scale = Math.pow( 2, propertyMap.getZoom() );
				var offsety = ( (150 / scale) || 0 );
				var projection = propertyMap.getProjection();
				var markerPosition = propertyMarker.getPosition();
				var markerScreenPosition = projection.fromLatLngToPoint( markerPosition );
				var pointHalfScreenAbove = new google.maps.Point( markerScreenPosition.x, markerScreenPosition.y - offsety );
				var aboveMarkerLatLng = projection.fromPointToLatLng( pointHalfScreenAbove );
				propertyMap.setCenter( aboveMarkerLatLng );
				infoBox.open( propertyMap, propertyMarker );
			} );

		}

	}

})(jQuery);
