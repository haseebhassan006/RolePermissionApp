<template>
  <div>
      <vs-button  :color="this.$root.primary_color"  @click="activemodal">
        <i :class="icon" style="margin-right: 10px;" v-if="icon"></i>
         {{label}}
      </vs-button>
  </div>
</template>

<script>
export default {
    props:['icon','label',"modal_ID"],

    methods:{
        activemodal(){
            return this.$emit("activemodal", true);
            // return true;
            //  $(`#${this.modal_ID}`).modal('show');
        },
    }
}
</script>

<style>
/* .vs-button__content {
    width: 130px;
    height: 49px;
} */
</style>
