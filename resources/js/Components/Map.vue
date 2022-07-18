<script>
import L from 'leaflet';
import "leaflet/dist/leaflet.css";
import { useStore } from '@/Stores/cameras'
import 'leaflet.markercluster';
import "leaflet.markercluster/dist/leaflet.markercluster";
import "leaflet.markercluster/dist/MarkerCluster.css";
import "leaflet.markercluster/dist/MarkerCluster.Default.css";

export default {
  name: "LeafletMap",
  data() {
    return {
      store: useStore(),
      markers: null,
      } 

  },
  methods: {
    },
  mounted() {
    
    this.store.map =  L.map('map').setView([0, 0], 4);

    var tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
  		maxZoom: 19,
  		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>'
  	}).addTo(this.store.map);
    

    const darkIcon = new L.divIcon({
      html: `<i class="fa-solid fa-location-pin fa-2xl text-primary"></i>`,
      iconSize: [20, 20],
      className: "bg-transparent"
    });


    this.markers = L.markerClusterGroup({
        iconCreateFunction: function(cluster) {
      		return L.divIcon({ html: `<div class="bg-gray-300 font-extrabold shadow w-8 h-8 rounded-full text-center flex items-center justify-center"><span>${cluster.getChildCount()}</span></div>` });
    	  }
      });


    this.store.cameraList.forEach(el => {
      try {
        this.markers.addLayer(L.marker([el["lat"], el["long"]], {
            icon: darkIcon, 
          })
          .bindPopup(`${el["ip"]}:${el["port"]}`))
      } catch (err) {
          console.log(err)
          console.log(el)
        }
    })

    this.markers.addTo(this.store.map)
  },
}

</script>

<template>
  <div class="p-3 w-full z-30">
    <div id="map"></div>
  </div>
</template>

<style>
#map { 
  height: 75vh;
  border-radius: 10px;
  background-color: #111;
}

.fa-location-pin {
    text-shadow: 0px 0px 3px black;
  }

.leaflet-div-icon {
    background: transparent;
    border: none;
  }
</style>

