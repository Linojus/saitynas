<!-- template for the modal component -->
<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div v-if="$slots.header" class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div v-if="$slots.body" class="modal-body">
            <slot name="body">
              default body
            </slot>
          </div>

          <div class="modal-footer">
            <slot v-if="$slots.footer" name="footer">
              default footer
            </slot>
            <button class="btn btn-success" @click="$emit('close')">
              OK
            </button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>