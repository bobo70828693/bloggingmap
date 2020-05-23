import Container from '@material-ui/core/Container';
import mapboxgl from 'mapbox-gl';
import React, { Component } from "react";

mapboxgl.accessToken = process.env.MIX_MAP_BOX_KEY;

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
            style: 'mapbox://styles/leexiao/ckac62oej5du01jn22cjbkalj',
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
    }

    render() {
        const { lng, lat, zoom } = this.state;

        return (
            <Container fixed>
                <div className='sidebarStyle'>
                    <div>{`Longitude: ${lng} Latitude: ${lat} Zoom: ${zoom}`}</div>
                </div>
                <div ref={this.mapRef} className='mapContainer' />

            </Container>
        );
    }
}
