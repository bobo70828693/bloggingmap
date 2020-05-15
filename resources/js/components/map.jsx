import React, { Component } from "react";
import mapboxgl from 'mapbox-gl';
import Container from '@material-ui/core/Container';
import MapboxLanguage from '@mapbox/mapbox-gl-language';

mapboxgl.accessToken = 'pk.eyJ1IjoibGVleGlhbyIsImEiOiJja2E1NGI4MzAxOTFsM2dtZXpieGdtdm55In0._w9lZwJsiFO8fRptodekUQ';

export default class Map extends Component {
    mapRef = React.createRef();

    constructor(props) {
        super(props);
        this.state = {
            lng: 121.564099,
            lat: 25.033408,
            zoom: 17
        };
    }

    componentDidMount() {
        const { lng, lat, zoom } = this.state;

        const map = new mapboxgl.Map({
            container: this.mapRef.current,
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [lng, lat],
            zoom
        });

        map.on('move', () => {
            const { lng, lat } = map.getCenter();

            this.setState({
                lng: lng.toFixed(4),
                lat: lat.toFixed(4),
                zoom: map.getZoom().toFixed(2)
            });
        });

        // language

        //map.setRTLTextPlugin('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.1.0/mapbox-gl-rtl-text.js');
        map.addControl(new MapboxLanguage({ defaultLanguage: 'zh' }));
    }

    render() {
        const { lng, lat, zoom } = this.state;

        return (
            <Container fixed>
                <div className='sidebarStyle'>
                    <div>{`Longitude: ${lng} Latitude: ${lat} Zoom: ${zoom}`}</div>
                </div>
                <div ref={this.mapRef} style={{ height: '100%' }} className='mapContainer' />
            </Container>
        );
    }
}
