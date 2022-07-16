<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import CameraList from '@/Components/CameraList.vue';
import Map from '@/Components/Map.vue';
import { useStore } from '@/Stores/cameras'

const store = useStore()
const props = defineProps({
  data: Object,
});

console.log(props.data);
store.cameraList = props.data["data"];
store.data = props.data;


</script>

<template>
    <Head title="Welcome" />
  
    
    <div class="bg-zinc-900">
      <Map />

      <CameraList />
    </div>
</template>
