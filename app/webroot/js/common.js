var geocoder;
var map;
var markers = new Array();
var infoWindows = new Array();

(function ($) {
// load the Google API Script
loadGoogleScript();
// deal with Star Ratings
if($('.star-rating').length) {
$('.star-rating').show();
$('.star-rating').parent().find('select').hide();
$('.star-rating a').click(function(){
var selected = $(this).attr('class');
$('.star-rating').removeClass('one-star');
$('.star-rating').removeClass('two-stars');
$('.star-rating').removeClass('three-stars');
$('.star-rating').removeClass('four-stars');
$('.star-rating').removeClass('five-stars');
$('.star-rating').addClass(selected);
if(selected=='one-star') {
$('#ReviewStars').val(1);
} else if(selected=='two-stars') {
$('#ReviewStars').val(2);
} else if(selected=='three-stars') {
$('#ReviewStars').val(3);
} else if(selected=='four-stars') {
$('#ReviewStars').val(4);
} else if(selected=='five-stars') {
$('#ReviewStars').val(5);
}
return false;
});
}
// main Stores page
if($('#StoreIndexForm').length) {
$('#StoreIndexForm').submit(function(){
// get form values
var address = $('#StoreAddress').val();
var distance = $('#StoreDistance').val();
var distance_unit = $('#StoreDefaultDistances').val();
var zoom = 12;
// change zoom based on distance
if(distance == 5) {
zoom = 11;
} else if(distance == 10) {
zoom = 10;
} else if(distance == 15) {
zoom = 10;
} else if(distance == 20) {
zoom = 9;
} else if(distance == 30) {
zoom = 8;
}
// ensure address is entered
if(address != '') {
// do geo-coding
geocoder.geocode( { 'address': address}, function(results, status) {
// success
if (status == google.maps.GeocoderStatus.OK) {
// set form lat/lng values
$('#StoreLat').val(results[0].geometry.location.lat());
$('#StoreLng').val(results[0].geometry.location.lng());
// set center of Map
map.setCenter(results[0].geometry.location);
map.setZoom(zoom);
// add Marker
var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location,
title: 'Your searched address',
icon: 'http://www.google.com/mapfiles/arrow.png'
});
// clear all markers
$.each(markers,function(k,v){
v.setMap(null);
});
// do search
search_for_nearby_stores($('#StoreIndexForm').attr('action'), $('#StoreLat').val(), $('#StoreLng').val(), $('#StoreDistance').val(), $('#StoreCategory').val());

// something went wrong
} else {
alert("Geocode was not successful for the following reason: " + status);
}
});
// no address was entered
} else {
alert('Please enter an Address');
}
return false;
});
}
// An Address has been added and user has moved focus away
if($('#StoreAddForm').length) {
$('#StoreAddress').blur(function(){
// get value of address
var address = $(this).val();
// load the address and pass to Google Geocoder
if(address != '') {
geocoder.geocode( { 'address': address}, function(results, status) {
// success
if (status == google.maps.GeocoderStatus.OK) {

// set form lat/lng values
$('#StoreLat').val(results[0].geometry.location.lat());
$('#StoreLng').val(results[0].geometry.location.lng());

// set center of Map
map.setCenter(results[0].geometry.location);
map.setZoom(14);

// add Marker
var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location
});

// something went wrong
} else {
alert("Geocode was not successful for the following reason: " + status);
}
});
}
});
}
})(jQuery);

/**
 * Load Google Maps API
 */
function loadGoogleScript() {
// only load script if the map canvas id is present
if($('#map_canvas').length) {
var script = document.createElement("script");
script.type = "text/javascript";
script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDIj6sbOMlCWwPc7tKcaTIYjTa50eco47k&sensor=false&callback=initialize";
document.body.appendChild(script);
}
}

/**
 * Initialise & display the Map
 */
function initialize() {
// setup Map options
var myOptions = {
zoom: 8,
center: new google.maps.LatLng(default_latitude, default_longitude),
mapTypeId: google.maps.MapTypeId.ROADMAP
}
// load the GeoCoder
geocoder = new google.maps.Geocoder();
// load the Map
map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
// do browser geolocation
if(browser_geolocation && $('#StoreIndexForm').length) {
// if geolocation is available
if(navigator.geolocation) {
// get current position
navigator.geolocation.getCurrentPosition(function(position) {
center_map_and_add_marker(position.coords.latitude, position.coords.longitude, 11);
// do search
search_for_nearby_stores($('#StoreIndexForm').attr('action'), position.coords.latitude, position.coords.longitude, 5, $('#StoreCategory').val());
});
}
}
// error on add page is being displayed so show marker for Store
if($('#StoreAddForm .error-message').length) {
// get form lat/lng values
var lat = $('#StoreLat').val();
var lng = $('#StoreLng').val();
center_map_and_add_marker(lat, lng, 14);
}
}

/**
 * Center the map and add a Marker from Latitude & Longitude
 * @param int lat
 * @param int lng
 */
function center_map_and_add_marker(lat, lng, zoom) {
if(lat != '' && lng != '') {
var latlng = new google.maps.LatLng(lat, lng);

// set center of Map
map.setCenter(latlng);
map.setZoom(zoom);

// add Marker
var marker = new google.maps.Marker({
map: map,
position: latlng
});
}
}

/**
 * Search for stores
 * @param string action
 * @param int lat
 * @param int lng
 * @param int distance
 * @param int category
 */
function search_for_nearby_stores(action, lat, lng, distance, category) {
$.ajax({
type:"POST",
url: action,
data: "data[Store][lat]="+lat+"&data[Store][lng]="+lng+"&data[Store][distance]="+distance+"&data[Store][category]="+category,
dataType:"json",
error: function(jqXHR, textStatus, errorThrown){
// display message
$('p.error').hide();
$('h2').after('<p class="error">An error has occured ('+textStatus+'), please try again or contact support</p>');
},
success: function(msg){
if(msg.success && msg.stores) {
// display message
$('p.success').hide();
var display_text = (msg.stores.length==1) ? 'Store has' : 'Stores have';
$('h2').after('<p class="message success">'+msg.stores.length+' '+display_text+' been found</p>');

$.each(msg.stores,function(k,v){
// Marker Options
var marker_options = {
map: map,
position: new google.maps.LatLng(v.Store.lat,v.Store.lng),
title: v.Store.name
};

// add Category Marker
//if(v.Category.icon) {
//marker_options.icon = 'img/icons/' + v.Category.icon;
//}

var marker = new google.maps.Marker(marker_options);

// add to markers
markers.push(marker);

// build content string
var content_string = buildInfoWindow(v.Store);

// create new info window
var infowindow = new google.maps.InfoWindow({
//maxWidth: "400",
content: content_string
});

// add to global array
infoWindows.push(infowindow);

// attach popup to click event
google.maps.event.addListener(marker, 'click', function() {
// close info windows
jQuery.each(infoWindows,function(k,v){
v.close();
});
infowindow.open(map,marker);
});
});

// display Table
$('#stores_table').hide();
if(msg.table) {
$('#map_canvas').after(msg.table);
}
} else {
// display message
$('p.error').hide();
$('h2').after('<p class="error">An error has occured, please try again or contact support</p>');
}
}
});
}

/**
 * Build Store InfoWindow
 * @param array store
 * @return string
 */
function buildInfoWindow(store) {
// build content string
var content_string = "<div class='maps_popup'>";

// include image
if(store.image) {
content_string += "<img class='img' src='"+store.image+"' alt='Store Image' />";
}

// include title & address
content_string += "<h1>"+store.name+"</h1><h2>"+store.address+"</h2>";

// include additional info
if(store.telephone_number != '') {
content_string += "<p class='tel'>Telephone: "+store.telephone_number+"</p>";
}
if(store.email_address != '') {
content_string += "<p class='email'>Email: <a href='mailto:"+store.email_address+"'>"+store.email_address+"</a></p>";
}
if(store.url != '') {
content_string += "<p class='web'>Website: <a href='"+store.url+"'>"+store.url+"</a></p>";
}
if(store.description != '') {
content_string += "<p class='desc'>"+store.description+"</p>";
}
content_string += "</div>";

return content_string;
}