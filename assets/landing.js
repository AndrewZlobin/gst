// any CSS you import will output into a single css file (app.css in this case)
import './styles/landing.scss';

// start the Stimulus application
import './bootstrap';

//For map
import * as d3 from "d3";
// import * as Datamap from "datamaps/dist/datamaps.rus";
import * as Datamap from "./libs/datamaps.rus";

const mapSettings = {
    defaultFill: '#2D394F',
    pointColor: '#E8AB10',
    center: [100.0000, 65.0000],
    scale: 400,
    rotate: [-10, 0, 0],
};

let map = new Datamap({
    element: document.getElementById('map-container'),
    responsive: true,
    scope: 'RUS',
    fills: {
        defaultFill: mapSettings.defaultFill,
        ye100: 'url(#bubble-gradient)'
    },
    geographyConfig: {
        dataJson: require('./data/rus.topo.json'),
        popupOnHover: false,
        highlightOnHover: false
    },
    bubblesConfig: {
        borderWidth: 2,
        borderColor: 'url(#bubble-gradient)',
        radius: 10,
        popupOnHover: true,
        popupTemplate: function(geography, data) { // This function should just return a string
            // TODO Rewrite using data-attributes generated in service
            return `<div class="hoverinfo">
                        <div class="map-popup d-flex flex-column">
                            <div class="map-popup__img" style="background-image: url('${require('./img/landing_bg.png')}');"></div>
                            <h1>${data.name}</h1>
                            <span>${data.caption}</span>
                        </div>
                    </div>`;
        },
        fillOpacity: 1
    },
    setProjection: function (element) {
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

map.bubbles([
    {
        latitude: 59.909427,
        longitude: 30.255771,
        fillKey: 'ye100',
        name: 'Двинская',
        caption: 'г. Санкт-Петербург, ул. Двинская, д. 3, лит. А, оф. 408.',
    },
    {
        latitude: 55.655709,
        longitude: 37.551747,
        fillKey: 'ye100',
        name: 'На научном',
        caption: 'г. Санкт-Петербург, ул. Двинская, д. 3, лит. А, оф. 408.',
    }
]);

// Make map responsive on different screens
window.addEventListener('resize', function () {
    map.resize();
})
