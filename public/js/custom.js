/* Hungarian initialisation for the jQuery UI date picker plugin. Written by Istvan Karaszi (jquery@spam.raszi.hu). */
$.datepicker.regional['hu'] = {
    closeText: 'bezárás',
    prevText: '&laquo;&nbsp;vissza',
    nextText: 'előre&nbsp;&raquo;',
    currentText: 'ma',
    monthNames: ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'],
    monthNamesShort: ['Jan', 'Feb', 'Már', 'Ápr', 'Máj', 'Jún', 'Júl', 'Aug', 'Szep', 'Okt', 'Nov', 'Dec'],
    dayNames: ['Vasárnap', 'Hétfö', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'],
    dayNamesShort: ['Vas', 'Hét', 'Ked', 'Sze', 'Csü', 'Pén', 'Szo'],
    dayNamesMin: ['V', 'H', 'K', 'Sze', 'Cs', 'P', 'Szo'],
    weekHeader: 'Hé',
    dateFormat: 'yy.mm.dd',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['hu']);

var dateToday = new Date();
console.log(dateToday);
function pad2(number) {
    return (number < 10 ? '0' : '') + number
 }
function formattedDate(date = dateToday) {
    var year = date.getFullYear();
    var month = (date.getMonth() + 1);
    var day = date.getDate();
    var hour = date.getHours();
    var min = date.getMinutes();
    return "" + year + "." + pad2(month) + "." + pad2(day) + " " + pad2(hour) + ":" + pad2(min);
}
// $(".date").datepicker({
//     //showButtonPanel: true,
//     minDate: dateToday,
//     "option": $.datepicker.regional["hu"]
// });
var formattedToday = formattedDate();
$(".date").bootstrapMaterialDatePicker({
    format: 'YYYY.MM.DD HH:mm',
    lang: 'hu',
    weekStart: 1,
    cancelText: 'Mégsem',
    minDate: dateToday,
    //switchOnClick: true,
});

swal = swal.mixin({
    confirmButtonColor: '#28A745',
    confirmButtonText: "Rendben",
    cancelButtonColor: '#DC3545',
    cancelButtonText: "Mégsem",
});

function showSuccess(text) {
    if (text !== undefined) {
        swal({
            position: 'top-end',
            timer: 3000,
            type: 'success',
            title: 'Sikerült!',
            text: text,
        });
    }
    console.log('Success:', text);
}

function showInfo(text) {
    if (text !== undefined) {
        swal({
            type: 'info',
            title: 'Infó',
            text: text,
        });
    }
    console.log('Info:', text);
}

function showError(text) {
    if (text !== undefined) {
        swal({
            type: 'error',
            title: 'Hoppá...',
            text: text,
        });
    }
    console.log('Error:', text);
}

// function setCityAutocomplete(control, city, city_id) {
//     //console.log(control);
//     control.typeahead({
//         source: function (query, process) {
//             return $.get("{{ route('frontend.search.city') }}", {
//                 query: query
//             }, function (data) {
//                 return process(data);
//             }).fail(function (error) {
//                 console.log(error)
//             });
//         }
//     });
//     city.on('change', function (e) {
//         $.get("{{ route('frontend.city.query') }}", {
//             name: city.val()
//         }, function (data) {
//             //console.log(data);
//             if (data.length > 0) {
//                 city_id.attr('value', data[0].id);
//             }
//         }).fail(function (error) {
//             console.log(error)
//         });
//     });
// }

/* HERE inicialisation */
var platform = new H.service.Platform({
    'app_id': HERE_APP_ID,
    'app_code': HERE_APP_CODE,
    useHTTPS: true,
});

//const defaultLayers = platform.createDefaultLayers();
const pixelRatio = window.devicePixelRatio || 1;
const defaultLayers = platform.createDefaultLayers({
    tileSize: pixelRatio === 1 ? 256 : 512,
    ppi: pixelRatio === 1 ? undefined : 320
});
const mapInitCenter = {
    lat: 46.31357,
    lng: 18.24538
};

/* make Map element */
function makeMap(elementId, center) {
    var map = new H.Map(
        document.getElementById(elementId),
        defaultLayers.normal.map, {
            zoom: 12,
            center: center,
            //pixelRatio: pixelRatio,
        }
    );
    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    var ui = H.ui.UI.createDefault(map, defaultLayers); // , 'hu-HU'); //TODO use default language
    return map;
}

var svgStartPoint = new H.map.Icon('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>' +
    '<path d="M256,0C167.641,0,96,71.625,96,160c0,24.75,5.625,48.219,15.672,69.125C112.234,230.313,256,512,256,512l142.594-279.375   C409.719,210.844,416,186.156,416,160C416,71.625,344.375,0,256,0z M256,256c-53.016,0-96-43-96-96s42.984-96,96-96   c53,0,96,43,96,96S309,256,256,256z" fill="#91DC5A"/>' +
    '</g></svg>');

var svgMidPoint = new H.map.Icon('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_2" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>' +
    '<path d="M256,0C167.641,0,96,71.625,96,160c0,24.75,5.625,48.219,15.672,69.125C112.234,230.313,256,512,256,512l142.594-279.375   C409.719,210.844,416,186.156,416,160C416,71.625,344.375,0,256,0z M256,256c-53.016,0-96-43-96-96s42.984-96,96-96   c53,0,96,43,96,96S309,256,256,256z" fill="#006DF0"/>' +
    '</g></svg>');

var svgEndPoint = new H.map.Icon('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_3" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>' +
    '<path d="M256,0C167.641,0,96,71.625,96,160c0,24.75,5.625,48.219,15.672,69.125C112.234,230.313,256,512,256,512l142.594-279.375   C409.719,210.844,416,186.156,416,160C416,71.625,344.375,0,256,0z M256,256c-53.016,0-96-43-96-96s42.984-96,96-96   c53,0,96,43,96,96S309,256,256,256z" fill="#D80027"/>' +
    '</g></svg>');

// var svgCircle = new H.map.Icon('<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 438.533 438.533" style="enable-background:new 0 0 438.533 438.533;" xml:space="preserve">' +
//     '<g><path d="M409.133,109.203c-19.608-33.592-46.205-60.189-79.798-79.796C295.736,9.801,259.058,0,219.273,0' +
// 	'c-39.781,0-76.47,9.801-110.063,29.407c-33.595,19.604-60.192,46.201-79.8,79.796C9.801,142.8,0,179.489,0,219.267' +
// 	'c0,39.78,9.804,76.463,29.407,110.062c19.607,33.592,46.204,60.189,79.799,79.798c33.597,19.605,70.283,29.407,110.063,29.407' +
// 	's76.47-9.802,110.065-29.407c33.593-19.602,60.189-46.206,79.795-79.798c19.603-33.596,29.403-70.284,29.403-110.062' +
// 	'C438.533,179.485,428.732,142.795,409.133,109.203z M353.742,297.208c-13.894,23.791-32.736,42.633-56.527,56.534' +
// 	'c-23.791,13.894-49.771,20.834-77.945,20.834c-28.167,0-54.149-6.94-77.943-20.834c-23.791-13.901-42.633-32.743-56.527-56.534' +
// 	'c-13.897-23.791-20.843-49.772-20.843-77.941c0-28.171,6.949-54.152,20.843-77.943c13.891-23.791,32.738-42.637,56.527-56.53' +
// 	'c23.791-13.895,49.772-20.84,77.943-20.84c28.173,0,54.154,6.945,77.945,20.84c23.791,13.894,42.634,32.739,56.527,56.53' +
// 	'c13.895,23.791,20.838,49.772,20.838,77.943C374.58,247.436,367.637,273.417,353.742,297.208z"/></g></svg>');

var svgCircle = new H.map.Icon('<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="44.238px" height="44.238px" viewBox="0 0 44.238 44.238" style="enable-background:new 0 0 44.238 44.238;" xml:space="preserve">' +
    '<g><g><path d="M22.119,44.237C9.922,44.237,0,34.315,0,22.12C0,9.924,9.922,0.001,22.119,0.001S44.238,9.923,44.238,22.12S34.314,44.237,22.119,44.237z M22.119,1.501C10.75,1.501,1.5,10.751,1.5,22.12s9.25,20.619,20.619,20.619s20.619-9.25,20.619-20.619S33.488,1.501,22.119,1.501z"/>' +
	'<g><path d="M31.434,22.869H12.805c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h18.628c0.414,0,0.75,0.336,0.75,0.75S31.848,22.869,31.434,22.869z"/></g>' +
	'<g><path d="M22.119,32.183c-0.414,0-0.75-0.336-0.75-0.75V12.806c0-0.414,0.336-0.75,0.75-0.75s0.75,0.336,0.75,0.75v18.626C22.869,31.847,22.533,32.183,22.119,32.183z"/></g></g></g></svg>');

function delMapObjects(map) {
    var objects = map.getObjects();
    if (objects) {
        map.removeObjects(objects);
    }
}
function addMapMarker(map, x, y, svg) {
    var marker = new H.map.Marker({
        lat: x,
        lng: y
    }, {
        icon: svg
    });
    map.addObjects([marker]);
    return marker;
}
var showCalculatedRoute = function(route, map) {
    delMapObjects(map);
    var routeShape, startPoint, endPoint, linestring;
    if (route) {
        //route = result.response.route[0]; // Pick the first route from the response:
        //console.log(route);
        routeShape = route.shape; // Pick the route's shape:
        linestring = new H.geo.LineString(); // Create a linestring to use as a point source for the route line
        routeShape.forEach(function (point) { // Push all the points in the shape into the linestring:
            var parts = point.split(',');
            linestring.pushLatLngAlt(parts[0], parts[1]);
        });
        var routeLine = new H.map.Polyline(linestring, { // Create a polyline to display the route:
            style: { strokeColor: '#00A2FF', lineWidth: 5 }
        });
        map.addObjects([routeLine]); // Add the route polyline and the two markers to the map:
        var cnt = route.waypoint.length;
        for (var i = 0; i < cnt; i++) {
            var icon = svgMidPoint;
            if (i == 0) {
                icon = svgStartPoint;
            } else if (i == (cnt-1)) {
                icon = svgEndPoint;
            }
            var pt = route.waypoint[i].mappedPosition;
            addMapMarker(map, pt.latitude, pt.longitude, icon); // Create a marker for the start point:
        }
        map.setViewBounds(routeLine.getBounds(), true); // Set the map's viewport to make the whole route visible:
    }
};
var geocodingService = platform.getGeocodingService();
var routingService = platform.getRoutingService();
Number.prototype.toKM = function () {
    return Math.floor(this / 1000)  +' km';
}
Number.prototype.toMMSS = function () {
    return Math.floor(this / 3600)  +' óra ' + Math.floor((this % 3600) / 60)  +' perc';
}
function calcRoute(map, sx, sy, ex, ey, mps = [], div = null, highway=true) {
    if (sx && sy && ex && ey) {
        var params = {
            'mode': 'fastest;car' + (highway ? '' : ';motorway:-2'),
            'representation': 'display',
            'routeAttributes': 'summary',
        }
        var i = 0;
        params['waypoint'+i++] = 'geo!'+sx+','+sy;
        for (var n = 0; n < mps.length; ++n) {
            params['waypoint'+i++] = 'geo!stopOver!'+mps[n].x+','+mps[n].y;
        }
        params['waypoint'+i++] = 'geo!'+ex+','+ey;
        routingService.calculateRoute(params, function(result) {
            if (result.response.route) {
                route = result.response.route[0];
                showCalculatedRoute(route, map);
                if (div) {
                    var summary = route.summary;
                    div.empty();
                    var content = '';
                    content += '<b>Távolság</b>: ' + summary.distance.toKM()  + '&nbsp;';
                    content += '<b>Utazás ideje</b>: ' + summary.travelTime.toMMSS();
                    div.append(content);
                }
            }
        }, function(error) {
            console.log(error.message);
        });
    } else {
        delMapObjects(map);
        if (sx && sy) {
            var marker = addMapMarker(map, sx, sy, svgStartPoint); // Create a marker for the start point:
            map.setCenter({ lat: sx, lng: sy }, true);
            map.setZoom(10, true);
        }
        if (ex && ey) {
            var marker = addMapMarker(map, ex, ey, svgEndPoint); // Create a marker for the end point:
            map.setCenter({ lat: ex, lng: ey }, true);
            map.setZoom(10, true);
        }
    }
    return null;
}

$('[data-role="tags-input"]').tagsInput();

if (!Date.prototype.addMinutes) {
    Date.prototype.addMinutes = function(m) {
        this.setMinutes(this.getMinutes() + m);
        return this;
    };
}