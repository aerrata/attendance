<template>
  <form @submit.prevent="generate" class="card card-md">
    <div class="card-body text-center">
        <div class="card-title fw-bold">New QR Code</div>
        <div class="text-secondary">Generate new attendee QR code.</div>
    </div>
    <div class="card-body">
      <div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" v-model="form.user_id" />
          <label for="floating-input">User ID</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">
          <i class="ti ti-qrcode icon"></i>
          Generate
        </button>
      </div>
    </div>
    <div class="card-body text-center" v-if="user">
      <div class="row">
        <div class="col">
          <div class="text-truncate">{{ user.name }}</div>
          <div class="text-secondary">{{ user.email }}</div>
        </div>
      </div>
      <img :src="user.qr_code" alt="QR Code" class="mt-3" />
    </div>
  </form>
</template>

<script setup>
import { ref } from 'vue'

const user = ref()
const form = ref({
  user_id: '',
})

const generate = () => {
  if (!form.value.user_id.trim()) return

  axios
    .post('/api/generate', form.value)
    .then((response) => {
      form.value.user_id = ''
      user.value = response.data.user
    })
    .catch((error) => {
      alert(error)
    })
}
</script>
