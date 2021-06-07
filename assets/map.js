//For map
import * as d3 from "d3";
// import * as Datamap from "datamaps/dist/datamaps.rus";
import * as Datamap from "./libs/datamaps.rus";

const mapSettings = {
    defaultFill: '#2D394F',
    pointColor: '#E8AB10',
    center: [100.0000, 65.0000],
    scale: 400,
    rotate: [-7, 0, 0],
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
            return `<div class="hoverinfo">
                        <div class="map-popup d-flex flex-column">
                            <div class="map-popup__img mb-6" style="background-image: url('${data.imagesource}');"></div>
                            <h1 class="map-popup__name mb-6 px-6 font-weight-semi-bold">${data.name}</h1>
                            <span class="map-popup__caption mb-6 px-6 font-weight-extra-light">${data.caption}</span>
                        </div>
                    </div>`;
        },
        fillOpacity: 1,
        highlightOnHover: false,
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

let bubblesData = [];

let bubblesContainer = document.querySelector('[data-mapsdata="true"]');

for (const bubble of bubblesContainer.children) {
    let bubbleObj = Object.assign({}, bubble.dataset);
    bubbleObj.imagesource = require('./img/' + bubbleObj.imagefilename + '.jpeg');
    bubbleObj.fillKey = 'ye100';
    bubblesData.push(bubbleObj);
}

map.bubbles(bubblesData);

// Make map responsive on different screens
window.addEventListener('resize', function () {
    map.resize();
})
