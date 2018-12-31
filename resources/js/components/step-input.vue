<template>
  <div class="card">
    <div class="card-header">
      <form :action="route" method="POST">
        <input type="hidden" name="_token" :value="token">
        <div class="form-group">
          <label v-if="!newStep">要完成当前任务，需要哪些步骤？</label>
          <input name="name" type="text" v-model="newStep" class="form-control">
          <span class="text-danger">{{errors}}</span>
        </div>
        <button class="btn btn-sm btn-success pull-right" v-if="newStep" type="submit">添加步骤</button>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      route: String,
      errors: String,
    },
    data () {
      return {
        newStep: '',
        token: document.head.querySelector('meta[name="csrf-token"]').content
      }
    },
  }
</script>