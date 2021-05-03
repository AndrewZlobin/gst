// any CSS you import will output into a single css file (app.css in this case)
import './styles/landing.scss';

// start the Stimulus application
import './bootstrap';

//For map
import * as d3 from "d3";
import * as Datamap from "datamaps/dist/datamaps.rus";

console.log(require('./data/rus.topo.json'));

const mapSettings = {
    defaultFill: '#2D394F',
    center: [100.0000, 65.0000],
    scale: 400,
    rotate: [-10, 0, 0],
};

let map = new Datamap({
    element: document.getElementById('map-container'),
    responsive: true,
    scope: 'RUS',
    geographyConfig: {
        dataJson: require('./data/rus.topo.json')
    },
    fills: {
        defaultFill: mapSettings.defaultFill,
    },
    setProjection: function (element) {
        console.log(element.offsetWidth, element.offsetWidth / 2)
        const projection = d3.geo.mercator()
            .center(mapSettings.center)
            .scale(mapSettings.scale)
            .translate([element.offsetWidth / 2, element.offsetHeight / 2])
            .rotate(mapSettings.rotate);
        const path = d3.geo.path()
            .projection(projection);

        return {
            path: path,
            projection: projection
        };
    }
});

// Make map responsive on different screens
window.addEventListener('resize', function () {
    map.resize();
})
