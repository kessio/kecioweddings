$("#map_extended").gMap({
	markers: [{
        address: "",
        html: '<div class="vendor-single-popup new"><img src="assets/images/vendors/vendo-map.jpg" alt=""><h5>Matrimony Wedding Photography</h5><span class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><small>19</small></span><a href="javascript:" class="btn btn-primary btn-block" data-toggle="modal" data-target="#request_quote">Request Pricing</a></div>',
        latitude: -33.87695388579145,
        longitude: 151.22183918952942,
        icon: {
            image: "https://wporganic.com/html/weddingdir/assets/images/pin.png",
            iconsize: [35, 48],
            iconanchor: [17, 48]
        }
    }],
    icon: {
        image: "images/pin.png",
        iconsize: [35, 48],
        iconanchor: [17, 48]
    },
    latitude: -33.87695388579145,
    longitude: 151.22183918952942,
    zoom: 16
});