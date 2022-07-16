<script setup>
import L from 'leaflet';
import { useStore } from '@/Stores/cameras'
const store = useStore()

const props = defineProps({
  data: Object
  });


function showOnMap(lat, long) {
    store.map.flyTo(new L.LatLng(lat, long), 13, {
        duration: 1.5
      })
  }

</script>

<template>

      <td class="px-6 py-4">
        {{data.id}}
      </td>
      <td class="px-6 py-4">
        {{data.ip}}:{{data.port}}
      </td>
      <td class="px-6 py-4">
        {{data.count}}
      </td>
      <td class="px-6 py-4">
        {{data.source}}
      </td>
      <td class="px-6 py-4">
        {{data.code}}
      </td>
      <td class="px-6 py-4 text-right">
        <div class="rounded">
          <a :href="route('view.camera', data.id)" class="text-white bg-primary rounded focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm px-2 py-1 text-center"><i class="fa-solid fa-circle-info"></i></a>
          <button type="button" class="text-white bg-amber-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm px-2 py-1 text-center ml-1" @click="showOnMap(data.lat, data.long)"><i class="fa-solid fa-map-location"></i></button>
        </div>
      </td>
  </template>

  <style>
  .leaflet-popup-content-wrapper, .leaflet-popup-tip {
    background-color: #111 !important;
color: #fff !important;
  }
</style>
