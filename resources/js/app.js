import React, { Component } from "react";
import ReactDOM from "react-dom";
import Map from "./components/map"

export default class App extends Component {
    render() {
        return (
            <React.Fragment>
                <Map></Map>
            </React.Fragment>
        );
    }
}

if (document.getElementById("root")) {
    ReactDOM.render(<App />, document.getElementById("root"));
}
