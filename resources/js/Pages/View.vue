
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
    users: -1,
    storages: -1,
    cameras: -1,
    connected: -1,
  });

(async function() {
  let res = await axios.get(route('api.users', `${props.data.ip}:${props.data.port}`));
  const users = res.data.UserConfig.Users.User;
  if (users[0])
    store.info.users = users;
  else {
    store.info.users = []
    store.info.users[0] = users;
  }  
})();

(async function() {
  let res = await axios.get(route('api.storage', `${props.data.ip}:${props.data.port}`));
  const storages = res.data.Drive;
  if (storages[0])
    store.info.storages = res.data.Drive;
  else {
    store.info.storages = []
    store.info.storages[0] = res.data.Drive;
  }
})();

(async function() {
  let res = await axios.get(route('api.cameras', `${props.data.ip}:${props.data.port}`));
  store.info.cameras = res.data.DeviceConfig.Devices.Device;
})();

(async function() {
  let res = await axios.get(route('api.connected', `${props.data.ip}:${props.data.port}`));
  if (res.data.Users.User)
    store.info.connected = res.data.Users.User;
  else
    store.info.connected = []
})();

onMounted(() => {
    store.map.setView([props.data.lat, props.data.long], 10);
  })


</script>

<template>
  
  <div class="bg-zinc-900 min-h-screen h-full pt-2 text-white">
    <div class="px-2">
      <button onclick="history.back()" class="py-2 px-3 bg-zinc-700 rounded"><i class="fa-solid fa-arrow-left mx-1"></i> Back</button>
    </div>
    <div class="flex w-screen">
      <Map />
  
      <div class="flex justify-between flex-col my-2 mr-2 w-1/5">
        <ViewInfoBox id="users" text="Users" icon="fa-users" color="bg-amber-300" />
        <ViewInfoBox id="cameras" text="Cameras" icon="fa-camera" color="bg-rose-300"/>
        <ViewInfoBox id="storages" text="Storage Devices" icon="fa-download" color="bg-cyan-400"/>
        <ViewInfoBox id="connected" text="Connected Users" icon="fa-network-wired" color="bg-purple-400"/>
      </div>
    </div>
   

    <div class="grid grid-cols-2">
      <div v-if="typeof store.info.storages == 'object'">
        <div v-for="storage in store.info.storages">
          <StorageDevice :data="storage" />
        </div>
      </div>
      <UserTable />
    </div>
  </div>
</template>
