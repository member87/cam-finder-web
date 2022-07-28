<script setup>
import axios from "axios";
import { useStore } from "@/Stores/cameras";
import { ref, defineProps } from "vue";
import Spinner from "@/Components/Spinner.vue";

const store = useStore();

let props = defineProps({
  data: Object,
});

let imgData = ref("");
let modalOpen = ref(0);
let opening = ref(0);
let openingId = ref(0);

async function makeRequest(id) {
  return await axios.post(
    route("api.snapshot", {
      host: `${props.data.ip}:${props.data.port}`,
      path: `Media/Snapshot?deviceid=${id}&resolution=1920x1080&streamid=1`,
    })
  );
}

async function getSnapshot(id) {
  imgData.value = "";
  opening.value = 1;
  openingId.value = id;
  let resp;
  try {
    resp = await makeRequest(id);
    imgData.value = `data:image/jpeg;base64, ${resp.data}`;
  } finally {
    modalOpen.value = 1;
    opening.value = 0;
  }
}
</script>

<template>
  <div
    class="overflow-x-auto relative m-2 rounded ml-2"
    v-if="store.info.cameras[0]">
    <table class="w-full text-sm text-left text-zinc-800">
      <thead class="text-xs text-gray-300 uppercase bg-zinc-800">
        <tr>
          <th class="py-3 px-6">Name</th>
          <th class="py-3 px-6">Serial Number</th>
          <th class="py-3 px-6">Snapshot</th>
        </tr>
      </thead>
      <tbody v-if="typeof store.info.cameras == 'object'">
        <tr
          class="bg-neutral-600/50 border-b border-neutral-600 text-white"
          v-for="cam in store.info.cameras">
          <td class="py-4 px-6">
            {{ cam.Name }}
          </td>
          <td class="py-4 px-6">
            {{ cam.SerialNumber }}
          </td>
          <td class="py-4 px-6">
            <Spinner color="#eee" v-if="opening && openingId == cam.id" />
            <button
              @click="getSnapshot(cam.id)"
              v-if="!opening || openingId != cam.id">
              <i class="fa-solid fa-eye"></i> view
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <div
      class="z-50 bg-zinc-900/90 fixed top-0 left-0 w-screen h-screen flex flex-col justify-center items-center"
      v-if="modalOpen">
      <div class="w-3/4 relative">
        <img :src="imgData" alt="No work :(" />
        <button
          @click="modalOpen = 0"
          class="bg-primary text-xl px-4 py-2 rounded shadow absolute right-0 m-2">
          <i class="fa-solid fa-xmark mr-1"></i> close
        </button>
      </div>
    </div>
  </div>
</template>
