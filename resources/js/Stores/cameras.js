import { defineStore } from 'pinia'

// useStore could be anything like useUser, useCart
// the first argument is a unique id of the store across your application
export const useStore = defineStore('main', {
  state: () => {
    return {
      cameraList: [],
      map: "",
      data: null,
      info: {},
    }
  }
})

