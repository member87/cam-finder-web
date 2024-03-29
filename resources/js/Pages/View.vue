<script setup>
import axios from "axios";
import ViewInfoBox from "@/Components/ViewInfoBox.vue";
import OnlineUserTable from "@/Components/OnlineUserTable.vue";
import Map from "@/Components/Map.vue";
import UserTable from "@/Components/UserTable.vue";
import StorageDevice from "@/Components/StorageDevice.vue";
import CameraDeviceList from "@/Components/CameraDeviceList.vue";
import Layout from "@/Layouts/Layout.vue";
import { useStore } from "@/Stores/cameras";
import { reactive, onMounted } from "vue";

const store = useStore();

const props = defineProps({
  data: Object,
});

store.cameraList.push(props.data);

store.info = reactive({
  users: -1,
  storages: -1,
  cameras: -1,
  connected: -1,
});

async function xmlToJson(xmlString) {
  return await axios.post(route("api.xml2json"), {
    xml: xmlString,
  });
}

async function makeRequest(url) {
  return await axios.post(
    route("api.request", {
      host: `${props.data.ip}:${props.data.port}`,
      path: url,
    })
  );
}

(async function () {
  let res = await makeRequest("Media/UserGroup/getUser?response_format=json");
  const users = res.data.UserConfig.Users.User;
  if (users[0]) store.info.users = users;
  else {
    store.info.users = [];
    store.info.users[0] = users;
  }
})();

(async function () {
  let res = await makeRequest("Media/Storage/getDrive");
  res = await xmlToJson(res.data);
  const storages = res.data.Drive;
  if (storages[0]) store.info.storages = res.data.Drive;
  else {
    store.info.storages = [];
    store.info.storages[0] = res.data.Drive;
  }
})();

(async function () {
  let res = await makeRequest(`Media/Device/getDevice?response_format=json`);
  store.info.cameras = res.data.DeviceConfig.Devices.Device;
})();

(async function () {
  let res = await makeRequest("Media/UserGroup/getOnlineUserList");
  res = await xmlToJson(res.data);
  const connected = res.data.Users.User;
  if (connected && connected[0]) store.info.connected = res.data.Users.User;
  else {
    store.info.connected = [];
    store.info.connected[0] = res.data.Users.User;
  }
})();

onMounted(() => {
  store.map.setView([props.data.lat, props.data.long], 10);
});
</script>

<template>
  <Layout>
    <div class="px-2 flex">
      <button
        :onclick="`document.referrer.startsWith(window.location.origin) ? history.back() : window.location.href = '${route(
          'index'
        )}'`"
        class="py-2 px-3 bg-zinc-700 rounded">
        <i class="fa-solid fa-arrow-left mx-1"></i> Back
      </button>
      <div class="ml-5 pt-1.5 text-2xl tracking-wide">
        {{ props.data.ip }}:{{ props.data.port }}
      </div>
    </div>
    <div class="flex flex-col w-full lg:flex-row">
      <Map />

      <div class="flex justify-between flex-col my-2 mx-1 w-auto lg:w-1/5">
        <ViewInfoBox
          id="users"
          text="Users"
          icon="fa-users"
          color="bg-amber-300" />
        <ViewInfoBox
          id="cameras"
          text="Cameras"
          icon="fa-camera"
          color="bg-rose-300" />
        <ViewInfoBox
          id="storages"
          text="Storage Devices"
          icon="fa-download"
          color="bg-cyan-400" />
        <ViewInfoBox
          id="connected"
          text="Connected Users"
          icon="fa-network-wired"
          color="bg-purple-400">
          <template v-slot:default="{ close }">
            <div
              class="z-50 bg-zinc-900/90 fixed top-0 left-0 w-screen h-screen flex flex-col justify-center items-center">
              <div class="w-3/4 relative">
                <OnlineUserTable class="shadow" />
                <button
                  @click="close"
                  class="bg-primary text-xl px-4 py-2 rounded shadow absolute right-0 m-2">
                  <i class="fa-solid fa-xmark mr-1"></i> close
                </button>
              </div>
            </div>
          </template>
        </ViewInfoBox>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2">
      <div>
        <div v-if="typeof store.info.storages == 'object'">
          <div v-for="storage in store.info.storages">
            <StorageDevice :data="storage" />
          </div>
        </div>
        <CameraDeviceList :data="data" />
      </div>
      <div>
        <UserTable />
      </div>
    </div>
  </Layout>
</template>
