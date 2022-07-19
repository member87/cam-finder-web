<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import CameraList from '@/Components/CameraList.vue';
import Map from '@/Components/Map.vue';
import Layout from '@/Layouts/Layout.vue'
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
  
    
    <Layout>
      <Map />

      <CameraList />
    </Layout>
</template>
