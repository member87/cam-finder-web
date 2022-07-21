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
  computed: {
    cameraList() {
        return this.store.cameraList
      }
    },
  watch: {
    cameraList: function() {
      this.populateMakers()
      }
    },
  methods: {
    populateMakers: function() {

    this.markers.clearLayers();
    this.store.cameraList.forEach(el => {
      try {
        this.markers.addLayer(L.marker([el["lat"], el["long"]], {
            icon: this.darkIcon, 
          })
          .bindPopup(`<a href="${route('view.camera', el.id)}">${el["ip"]}:${el["port"]}</a>`))
      } catch (err) {
          console.log(err)
          console.log(el)
        }
    })

    this.markers.addTo(this.store.map)
      }
    },
  mounted() {
    
    this.store.map =  L.map('map').setView([0, 0], 2);

    var tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
  		maxZoom: 19,
  		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>'
  	}).addTo(this.store.map);
    

    this.darkIcon = new L.divIcon({
      html: `<i class="fa-solid fa-location-pin fa-2xl text-primary"></i>`,
      iconSize: [20, 20],
      className: "bg-transparent"
    });


    this.markers = L.markerClusterGroup({
        iconCreateFunction: function(cluster) {
      		return L.divIcon({ html: `<div class="bg-gray-300 font-extrabold shadow w-8 h-8 rounded-full text-center flex items-center justify-center"><span>${cluster.getChildCount()}</span></div>` });
    	  }
      });

    this.populateMakers()


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

