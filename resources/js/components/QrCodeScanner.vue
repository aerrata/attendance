<template>
  <div class="video-container video-default">
    <video ref="videoRef"></video>
  </div>
  <teleport to="body">
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvas" style="--tblr-offcanvas-height: none">
      <div class="offcanvas-header">
        <div class="d-flex align-items-center space-x-2">
          <h2 class="offcanvas-title" id="offcanvasBottomLabel">Verify Attendance</h2>
          <span class="status status-success">
            <span class="status-dot status-dot-animated"></span>
            {{ result?.session_id }}
          </span>
        </div>

        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="row">
          <div class="col-auto">
            <span class="avatar"><i class="ti ti-mood-smile icon"></i></span>
          </div>
          <div class="col">
            <div class="text-truncate">{{ result?.user?.name }}</div>
            <div class="text-secondary">{{ result?.user?.email }}</div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <button class="btn w-100" type="button" @click="cancel">Cancel</button>
          </div>
          <div class="col">
            <button class="btn btn-primary w-100" type="button" @click="approve">Approve</button>
          </div>
        </div>
      </div>
    </div>
  </teleport>
</template>

<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue'
import QrScanner from 'qr-scanner'

const videoRef = ref(null)
const scanner = ref(null)
const offcanvas = ref(null)
const result = ref({})
const scanned = ref(false)

const onScan = (data) => {
  if (scanned.value) return
  if (!data) return
  result.value = JSON.parse(data)
  scanned.value = true
}

const approve = () => {
  if (!result.value) return
  axios
    .post('/api/attendances', result.value)
    .then((response) => {
      alert(response.data.status)
      offcanvas.value.hide()
    })
    .catch((error) => {
      alert(error)
    })
}

const cancel = () => {
  offcanvas.value.hide()
}

watch(result, (value) => {
  if (value && Object.keys(value).length > 0) {
    offcanvas.value.show()
  }
})

onMounted(() => {
  scanner.value = new QrScanner(videoRef.value, ({ data }) => onScan(data), {
    onDecodeError: (error) => {},
    highlightScanRegion: true,
    highlightCodeOutline: true,
    returnDetailedScanResult: true,
    preferredCamera: 'environment',
  })

  scanner.value.start()
  scanner.value.setInversionMode('both')
})

onMounted(() => {
  offcanvas.value = new bootstrap.Offcanvas('#offcanvas', {
    backdrop: 'static',
    keyboard: false,
    scroll: false,
  })

  offcanvas.value._element.addEventListener('hidden.bs.offcanvas', () => {
    result.value = {}
    scanned.value = false
  })
})

onUnmounted(() => {
  scanner.value.destroy()
})
</script>

<style>
.video-default {
  position: relative;
}

.video-default video {
  width: 100%;
  height: 100%;
  display: block;
}

.video-default .scan-region-highlight .scan-region-highlight-svg {
  stroke: #fbbf24 !important;
  stroke-width: 3 !important;
}

.video-default .scan-region-highlight .code-outline-highlight {
  stroke: #fbbf24 !important;
  stroke-width: 4 !important;
  stroke-dasharray: 0 !important;
}
</style>
