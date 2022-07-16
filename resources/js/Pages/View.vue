
<script setup>
import axios from 'axios'
import ViewInfoBox from '@/Components/ViewInfoBox.vue'
import Map from '@/Components/Map.vue'
import UserTable from '@/Components/UserTable.vue'
import StorageDevice from '@/Components/StorageDevice.vue'
import { useStore } from '@/Stores/cameras'
import { reactive, onMounted } from 'vue';

const store = useStore();

const props = defineProps({
  data: Object,
});

store.cameraList.push(props.data)

store.info = reactive({
    users: [],
    storages: [],
    cameras: []
  });

(async function() {
  let res = await axios.get(route('api.users', `${props.data.ip}:${props.data.port}`));
  store.info.users = res.data.UserConfig.Users.User;
})();

(async function() {
  let res = await axios.get(route('api.storage', `${props.data.ip}:${props.data.port}`));
  store.info.storages = res.data.Drive;
})();

(async function() {
  let res = await axios.get(route('api.cameras', `${props.data.ip}:${props.data.port}`));
  store.info.cameras = res.data.DeviceConfig.Devices.Device;
})();

onMounted(() => {
    store.map.setView([props.data.lat, props.data.long], 10);
  })

</script>

<template>
  
  <div class="bg-zinc-900 min-h-screen h-full">
    <div class="flex w-screen">
      <Map />
  
      <div class="flex justify-between flex-col my-2 mr-2 w-1/5">
        <ViewInfoBox id="users" text="Users" icon="fa-users" color="bg-amber-300" />
        <ViewInfoBox id="cameras" text="Cameras" icon="fa-camera" color="bg-rose-300"/>
        <ViewInfoBox id="storages" text="Storage Devices" icon="fa-download" color="bg-cyan-400"/>
        <ViewInfoBox id="storages" text="Storage Devices" icon="fa-download" color="bg-purple-400"/>
      </div>
    </div>
   

    <div class="grid grid-cols-2">
      <div v-if="store.info.storages[0]">
        <div v-for="storage in store.info.storages">
          <StorageDevice :data="storage" />
        </div>
      </div>
      <div v-else>
        <StorageDevice v-if="store.info.storages.CodeName" :data="store.info.storages" />
      </div>
      <UserTable />
    </div>
  </div>
</template>
