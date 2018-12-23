<template>
  <div class="card mb-4" v-if="steps.length">
    <slot></slot>
    <div class="card-body">
      <ul class="list-group">
        <li class="list-group-item" v-for="step in steps">
          <span @dblclick="edit(step)">{{ step.name }}</span>
          <span class="pull-right">
            <i class="fa fa-check" @click="toggle(step)"></i>
            <i class="fa fa-close" @click="remove(step)"></i>
          </span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  import {Hub} from '../event-bus'

  export default {
    props: {
      steps: Array,
      route: String,
    },
    methods: {
      toggle(step) {
        axios.patch(`${this.route}/${step.id}`, {completion: !step.completion}).then((res) => {
          window.location.reload()
        }).catch((err) => {

        })
      },
      remove(step, success) {
        axios.delete(`${this.route}/${step.id}`).then((res) => {
          window.location.reload()
        })
      },
      edit(step) {
        // 删除当前step
        this.remove(step)
        // 在输入框显示当前step的name
        Hub.$emit('edit', step)
      },
    }
  }
</script>